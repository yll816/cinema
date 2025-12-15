<?php
session_start();
include 'db.php';

if (isset($_POST['submit'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];

    // Image upload
    $imageName = $_FILES['image']['name'];
    $tmpName = $_FILES['image']['tmp_name'];
    $imagePath = "img/" . $imageName;

    if (!empty($imageName)) {
        move_uploaded_file($tmpName, $imagePath);
    } else {
        $imagePath = "img/placeholder.png";
    }

    $sql = "INSERT INTO movies (title, description, image_path, price)
            VALUES ('$title', '$description', '$imagePath', '$price')";

    mysqli_query($conn, $sql);

    header("Location: admin_movies.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel – Shto Film</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">

    <style>
        html, body {
            height: 100%;
            overflow: hidden;
        }

        .home {
            margin-left: 260px;
            padding: 40px 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: calc(100% - 260px);
        }

        .home h1 {
            color: #df0000;
            font-size: 32px;
            margin-top: 100px;
        }

        .product-form {
            background: #191919;
            padding: 25px;
            border-radius: 15px;
            width: 650px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.6);
        }

        .product-form input {
            width: 96%;
            height: 45px;
            margin-bottom: 15px;
            border: 2px solid #333;
            background: #191919;
            color: #f2f2f2;
            border-radius: 8px;
            padding: 0 12px;
        }

        .product-form input[type="file"] {
            border: none;
        }

        .product-form button {
            width: 100%;
            height: 45px;
            background: #df0000;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .product-form button:hover {
            background: #ff1a1a;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div class="details">Admin Panel</div>

    <ul class="nav-links">
        <li><a href="admin_movies.php"><i class='bx bx-film'></i> Filmat</a></li>
        <li><a href="admin.php" style="background:#df0000" class="active">
            <i class='bx bx-add-to-queue'></i> Shto Film</a>
        </li>
        <li><a href="admin_users.php"><i class='bx bx-user'></i> Përdoruesit</a></li>
        <li><a href="login.php"><i class='bx bx-log-out'></i> Log out</a></li>
    </ul>
</div>

<div class="home">
    <h1>Shto Film</h1>

    <form class="product-form" method="POST" enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titulli i filmit" required>
        <input type="text" name="description" placeholder="Përshkrimi" required>
        <input type="number" step="0.01" name="price" placeholder="Çmimi (€)" required>
        <input type="file" name="image" required>
        <button type="submit" name="submit">Ruaj Filmin</button>
    </form>
</div>

</body>
</html>
