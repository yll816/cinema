<?php
// delete_ticket.php
include 'db.php'; // Your existing DB connection

if (isset($_GET['id'])) {
    $ticket_id = intval($_GET['id']);
    
    $stmt = $conn->prepare("DELETE FROM tickets WHERE id = ?");
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $stmt->close();
}

// Redirect back to admin panel or tickets list
header("Location: admin_users.php");
exit();
?>
