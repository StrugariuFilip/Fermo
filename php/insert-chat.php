<?php
session_start();
if (isset($_SESSION['user_id'])) {
    include "db.php";

    // Ensure user inputs are sanitized and validated
    $outgoing_id = intval($_SESSION['user_id']); // Convert to integer
    $incoming_id = intval(mysqli_real_escape_string($con3, $_POST['incoming_id'])); // Convert to integer and sanitize
    $message = mysqli_real_escape_string($con3, $_POST['message']); // Sanitize message input
    
    date_default_timezone_set("Europe/Bucharest");
    $currentDateTime = date('Y-m-d H:i:s');
    
    if (!empty($message)) {
        // Use prepared statements for better security and error handling
        $stmt = $con3->prepare("INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, datames) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iiss", $incoming_id, $outgoing_id, $message, $currentDateTime);
            if ($stmt->execute()) {
                // Successfully executed the query
                echo "Message sent successfully.";
            } else {
                // Error executing the query
                echo "Error: Could not execute the query.";
            }
            $stmt->close();
        } else {
            // Error preparing the statement
            echo "Error: Could not prepare the SQL statement.";
        }
    } else {
        // Handle empty message
        echo "Error: Message cannot be empty.";
    }
} else {
    // Handle session not set
    echo "Error: User not logged in.";
}
?>
