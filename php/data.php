<?php
while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages 
             WHERE (incoming_msg_id = {$row['id']} OR outgoing_msg_id = {$row['id']}) 
             AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id}) 
             ORDER BY msg_id DESC 
             LIMIT 1";
    $query2 = mysqli_query($con3, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    $result = (mysqli_num_rows($query2) > 0) ? $row2['msg'] : "Nici un mesaj disponibil.";
    $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;
    
    $you = isset($row2['outgoing_msg_id']) && $outgoing_id == $row2['outgoing_msg_id'] ? "You: " : "";
    
    $offline = ($row['status'] == "Offline") ? "offline" : "";
    
    $hid_me = ($outgoing_id == $row['id']) ? "hide" : "";

    $profileImage = $row['image'];
    $imageSrc = !empty($profileImage) ? 'data:image/jpeg;base64,' . base64_encode($profileImage) : 'imagini/profile.png';
    
    $output .= '<a href="chat.php?user_id=' . $row['id'] . '">
                    <div class="content">
                        <img src="' . $imageSrc . '" alt="Profile Image">
                        <div class="details">
                            <div>' . htmlspecialchars($row['name']) . '</div>
                            <p style="margin-top:5px;">' . $you . htmlspecialchars($msg) . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                </a>';
}
?>
