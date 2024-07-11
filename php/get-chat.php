<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include "db.php";
    $outgoing_id = $_SESSION['user_id'];
    $incoming_id = mysqli_real_escape_string($con3, $_POST['incoming_id']);
    $output = "";
    $sql = "SELECT * FROM messages
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})
            ORDER BY msg_id ASC";
    $query = mysqli_query($con3, $sql);
    
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            $datames = $row['datames'];
            $formattedTime = date('H:i', strtotime($datames));
            
            if ($row['outgoing_msg_id'] == $outgoing_id) {
    $output .= '<div class="chat outgoing">
                    <div class="details">
                        <p>' . htmlspecialchars($row['msg'], ENT_QUOTES, 'UTF-8') . '</p>
                        <div class="data">' . $formattedTime . '</div>
                    </div>
                </div>';
} else {
    $outid = $row['outgoing_msg_id'];
    $sql2 = "SELECT image FROM form WHERE id = $outid";
    $result = mysqli_query($con, $sql2);
    $user = mysqli_fetch_assoc($result);
    $profileImage = $user['image'];
    $imageSrc = !empty($profileImage) ? 'data:image/jpeg;base64,' . base64_encode($profileImage) : 'imagini/profile.jpg';
    $output .= '<div class="chat incoming">
                <img src="' . htmlspecialchars($imageSrc, ENT_QUOTES, 'UTF-8') . '" alt="profile image">
                <div class="details">
                    <p>' . htmlspecialchars($row['msg'], ENT_QUOTES, 'UTF-8') . '</p>
                    <div class="data">' . $formattedTime . '</div>
                </div>
            </div>';
}
        }
    } else {
        $output .= '<div class="text">Nici un mesaj disponibil. După trimiterea unui mesaj îl vei vedea aici.</div>';
    }
    
    echo $output;
}
?>
