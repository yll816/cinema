<?php
session_start();
include 'db.php';

$query = "SELECT * FROM movies ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin – Filmat</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin.css">

    <style>
        .movies-table {
            margin-top: 30px;
            width: 95%;
            background: #191919;
            padding: 20px;
            border-radius: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            color: #f2f2f2;
        }
        th {
            background: #df0000;
            padding: 12px;
        }
        td {
            padding: 10px;
            border-bottom: 1px solid #333;
        }
        img {
            width: 80px;
            border-radius: 6px;
        }
        .delete-btn {
            background: #a30000;
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            text-decoration: none;
        }
        .delete-btn:hover {
            background: #ff1a1a;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div class="details">Admin Panel</div>
    <ul class="nav-links">
        <li><a href="admin_movies.php" style="background:#df0000"><i class='bx bx-film'></i> Filmat</a></li>
        <li><a href="admin_add_movie.php"><i class='bx bx-add-to-queue'></i> Shto Film</a></li>
        <li><a href="admin_users.php"><i class='bx bx-user'></i> Përdoruesit</a></li>
        <li><a href="login.php"><i class='bx bx-log-out'></i> Log out</a></li>
    </ul>
</div>

<div class="home">
    <h1>Lista e Filmave</h1>

    <div class="movies-table">
        <table>
            <tr>
                <th>ID</th>
                <th>Poster</th>
                <th>Titulli</th>
                <th>Çmimi</th>
                <th>Data</th>
                <th>Veprime</th>
            </tr>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><img src="<?= $row['image_path'] ?>"></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['price'] ?> €</td>
                <td><?= $row['created_at'] ?></td>
                <td>
                    <a class="delete-btn" href="delete_movie.php?id=<?= $row['id'] ?>">Fshi</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
