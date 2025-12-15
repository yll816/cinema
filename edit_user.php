<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("User ID is missing.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    die("User not found.");
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body {
            
            background: #111;
            color: white;
            font-family: Arial;
        }
        .container {
            
            width: 400px;
            margin: 50px auto;
            background: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
        }
        input, select {
            
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            background: #222;
            border: none;
            color: white;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #df0000;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 6px;
            margin-top: 10px;
        }
        button:hover {
            background: #ff1a1a;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit User</h2>

    <form action="update_user.php" method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <label>Emri:</label>
        <input type="text" name="emri" value="<?= $user['emri'] ?>" required>

        <label>Mbiemri:</label>
        <input type="text" name="mbiemri" value="<?= $user['mbiemri'] ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= $user['email'] ?>" required>

        <label>Telefoni:</label>
        <input type="text" name="tel" value="<?= $user['tel'] ?>" required>

        <label>Username:</label>
        <input type="text" name="username" value="<?= $user['username'] ?>" required>

        <label>Roli:</label>
        <select name="role">
            <option value="user" <?= $user['role'] == 'user' ? 'selected' : '' ?>>User</option>
            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>

        <button type="submit">Save Changes</button>
    </form>

</div>

</body>
</html>
