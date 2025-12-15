<?php
include 'db.php';

$id = intval($_POST['id']);
$emri = $_POST['emri'];
$mbiemri = $_POST['mbiemri'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$username = $_POST['username'];
$role = $_POST['role'];

$query = "UPDATE users SET 
    emri='$emri',
    mbiemri='$mbiemri',
    email='$email',
    tel='$tel',
    username='$username',
    role='$role'
    WHERE id=$id";

if (mysqli_query($conn, $query)) {
    header("Location: admin_users.php?updated=1");
    exit();
} else {
    echo "Error updating user: " . mysqli_error($conn);
}
