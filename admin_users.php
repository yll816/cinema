<?php
session_start();
include 'db.php';

/* USERS */
$usersQuery = "SELECT id, emri, mbiemri, email, tel, username, role, created_at 
               FROM users ORDER BY id DESC";
$usersResult = mysqli_query($conn, $usersQuery);

/* MOVIES */
$moviesQuery = "SELECT * FROM movies ORDER BY id DESC";
$moviesResult = mysqli_query($conn, $moviesQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel – Users & Movies</title>

    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">

    <style>
        .users-table {
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
            font-size: 16px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #333;
        }

        tr:hover {
            background: #1b1b1b;
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

        .edit-btn {
            background: #004c99;
            color: white;
            padding: 6px 10px;
            border-radius: 6px;
            text-decoration: none;
            margin-right: 5px;
        }

        .edit-btn:hover {
            background: #007bff;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <div class="details">Admin Panel</div>

    <ul class="nav-links">
        <li>
            <a href="admin.php">
                <i class='bx bx-add-to-queue'></i> Shto Film
            </a>
        </li>

        <li>
            <a href="admin_users.php" style="background:#df0000; color:black;">
                <i class='bx bx-user'></i> Dashboard
            </a>
        </li>

        <li>
            <a href="login.php">
                <i class='bx bx-log-out'></i> Log out
            </a>
        </li>
    </ul>
</div>

<div class="home">

    <!-- USERS -->
    <h1>Lista e Përdoruesve</h1>

    <div class="users-table">
        <table>
            <tr>
                <th>ID</th>
                <th>Emri</th>
                <th>Mbiemri</th>
                <th>Email</th>
                <th>Telefoni</th>
                <th>Username</th>
                <th>Roli</th>
                <th>Data</th>
                <th>Veprime</th>
            </tr>

            <?php while($user = mysqli_fetch_assoc($usersResult)) { ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['emri'] ?></td>
                    <td><?= $user['mbiemri'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['tel'] ?></td>
                    <td><?= $user['username'] ?></td>
                    <td><?= $user['role'] ?></td>
                    <td><?= $user['created_at'] ?></td>
                    <td>
                        <a class="edit-btn" href="edit_user.php?id=<?= $user['id'] ?>">Edit</a>
                        <a class="delete-btn" href="delete_user.php?id=<?= $user['id'] ?>">Fshi</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- MOVIES -->
    <h1 style="margin-top:60px;">Lista e Biletave</h1>

<div class="users-table">
    <table>
        <tr>
            <th>ID</th>
            <th>Emri Bilete</th>
            <th>Filmi</th>
            <th>Ora e Shfaqjes</th>
            <th>Sasia</th>
            <th>Çmimi Total</th>
            <th>Data e Blerjes</th>
            <th>Veprime</th>
        </tr>

        <?php
        // Assuming $conn is your mysqli connection
        $ticketsResult = mysqli_query($conn, "SELECT * FROM tickets ORDER BY created_at DESC");

        while($ticket = mysqli_fetch_assoc($ticketsResult)) { ?>
            <tr>
                <td><?= $ticket['id'] ?></td>
                <td><?= htmlspecialchars($ticket['ticket_name']) ?></td>
                <td><?= htmlspecialchars($ticket['movie_title']) ?></td>
                <td><?= htmlspecialchars($ticket['show_time']) ?></td>
                <td><?= $ticket['quantity'] ?></td>
                <td><?= $ticket['total_price'] ?> €</td>
                <td><?= $ticket['created_at'] ?></td>
                <td>
                    <a class="delete-btn" href="delete_ticket.php?id=<?= $ticket['id'] ?>">
                        Fshi
                    </a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>
