<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: admin_users.php");
    exit();
}

$user_id = intval($_GET['id']);


$query = "DELETE FROM users WHERE id = $user_id";

if (mysqli_query($conn, $query)) {
    echo "<script>
            alert('Përdoruesi u fshi me sukses!');
            window.location = 'admin_users.php';
          </script>";
} else {
    echo "<script>
            alert('Gabim gjatë fshirjes së përdoruesit!');
            window.location = 'admin_users.php';
          </script>";
}
?>
