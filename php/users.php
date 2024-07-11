<?php
session_start();
include "db.php";

$outgoing_id = $_SESSION['user_id'];
$sql_form = "
    SELECT f.*
    FROM form f
    WHERE f.id != {$outgoing_id}
    ORDER BY f.status DESC, f.id DESC
";
$query_form = mysqli_query($con, $sql_form);
$form_data = [];
while ($row = mysqli_fetch_assoc($query_form)) {
    $form_data[$row['id']] = $row;
}
foreach ($form_data as $user_id => &$user_data) {
    $sql_messages = "
        SELECT msg, datames, outgoing_msg_id
        FROM messages
        WHERE (incoming_msg_id = {$user_id} OR outgoing_msg_id = {$user_id}) 
        AND (outgoing_msg_id = {$outgoing_id} OR incoming_msg_id = {$outgoing_id})
        ORDER BY datames DESC
        LIMIT 1
    ";
    $query_messages = mysqli_query($con3, $sql_messages);
    if ($row_message = mysqli_fetch_assoc($query_messages)) {
        $user_data['last_message'] = $row_message['msg'];
        $user_data['last_message_time'] = $row_message['datames'];
        $user_data['you'] = $row_message['outgoing_msg_id'] == $outgoing_id ? "You: " : "";
    } else {
        $user_data['last_message'] = "Nici un mesaj disponibil.";
        $user_data['last_message_time'] = null;
        $user_data['you'] = "";
    }
}

usort($form_data, function ($a, $b) {
    if ($a['last_message_time'] == $b['last_message_time']) {
        if ($a['status'] == $b['status']) {
            return $b['id'] - $a['id'];
        }
        return strcmp($b['status'], $a['status']);
    }
    if ($a['last_message_time'] === null)
        return 1;
    if ($b['last_message_time'] === null)
        return -1;

    return strtotime($b['last_message_time']) - strtotime($a['last_message_time']);
});

$output = "";
if (empty($form_data)) {
    $output .= "Nici un utilizator disponibil.";
} else {
    foreach ($form_data as $user) {
        $profileImage = $user['image'];
        $imageSrc = !empty($profileImage) ? 'data:image/jpeg;base64,' . base64_encode($profileImage) : 'imagini/profile.jpg';
        $msg = strlen($user['last_message']) > 28 ? substr($user['last_message'], 0, 28) . '...' : $user['last_message'];
        $offline = $user['status'] == "Offline" ? "offline" : "";
        $hid_me = $outgoing_id == $user['id'] ? "hide" : "";
        $output .= '<a href="chat.php?user_id=' . $user['id'] . '">
                        <div class="content">
                        <img src="' . $imageSrc . '" alt="Profile Image">
                        <div class="details">
                            <div>' . $user['name'] . '</div>
                            <p style="margin-top:5px;">' . $user['you'] . $msg . '</p>
                        </div>
                        </div>
                        <div class="status-dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                    </a>';
    }
}
echo $output;
?>