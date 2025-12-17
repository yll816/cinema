<?php
session_start();
require "../db.php";

$user_id = $_SESSION['user_id'] ?? 1;

$movie_title = $_POST['movie_title'];
$show_time   = $_POST['show_time'];
$ticket_name = $_POST['ticket_name'];
$quantity    = (int)$_POST['quantity'];

$price_per_ticket = 6.00;
$total_price = $price_per_ticket * $quantity;

$stmt = $conn->prepare("
    INSERT INTO tickets 
    (user_id, movie_title, show_time, ticket_name, quantity, total_price)
    VALUES (?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "isssid",
    $user_id,
    $movie_title,
    $show_time,
    $ticket_name,
    $quantity,
    $total_price
);

$stmt->execute();

echo "<script>
  alert('Ticket saved successfully!');
  window.history.back();
</script>";
exit;
