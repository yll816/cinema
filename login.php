<?php
require "db.php";
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: admin.php");
                exit;
            } else {
                header("Location: index.html");
                exit;
            }

        } else {
            echo "<script>alert('Incorrect password!');</script>";
        }
    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kyquni</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<header>
  <div class="header-container">

    <div class="logo">
      <img src="img/cineplex.png" alt="Cineplexx Logo">
    </div>

    <nav class="main-nav">
      <a href="index.html">FILMA</a>
      <a href="#">EVENTE</a>
      <a href="#">KINEMATË</a>
    </nav>

    <div class="account-nav">
      <a href="login.php"><img src="img/kyquni.png" alt="Kyçuni"></a>
      <a href="signup.php"><img src="img/regjistrohuni.png" alt="Regjistrohuni"></a>
    </div>

  </div>
</header>

<form method="post" action="login.php" id="loginForm">
    <div class="login-block">
        <h1>Kyquni</h1>

        <input type="text" placeholder="Emri Perdoruesit" name="username" required/> 
        <input type="password" placeholder="Fjalekalimi" name="password" required/>

        <button type="submit">Kyqu</button>

        <br/><br/>
        <a href="signup.php">SignUp?</a>
    </div>
</form>

<footer>
    <div>
        <h3>About Cineplexx</h3>
        <a href="#">Careers</a>
        <a href="#">Corporate Social Responsibility</a>
    </div>
    <div>
        <h3>Filma</h3>
        <a href="#">Top Film</a>
        <a href="#">Tani ne kinema</a>
        <a href="#">Vijne se shpejti</a>
    </div>
    <div>
        <h3>Cineplexx details</h3>
        <a href="#">Order details</a>
        <a href="#">Returns & exchanges</a>
        <a href="#">FAQ</a>
    </div>
    <div>
        <h3>Support</h3>
        <a href="#">Cineplex</a>
        <a href="#">Cineplex Account</a>
        <a href="#">Other systems</a>
        <a href="#">Repairs</a>
    </div>
    <div>
        <h3>Get in Touch</h3>
        <p>Email:<a href="#">cineplexx@gmail.com</a></p>
        <p>Contact Number<a href="#">044-601-173</a></p>
    </div>
    <div>
        <h3>Community</h3>
        <a href="#">Community guidelines</a>
        <a href="#">Online safety principles</a>
    </div>
    <div>
        <h3>Privacy</h3>
        <a href="#">Privacy policy</a>
        <a href="#">Cookies and interest-based ads</a>
    </div>
</footer>

<div class="footer-bottom">
    <p>© Cineplexx Kosovo L.L.C   Politika e Privatësisë Informacion LigjorRreth nesh Na kontaktoni</p>
    <p>
        <a href="#">Website feedback</a> | 
        <a href="#">Terms of Use</a> | 
        <a href="#">Documents & Policies</a>
    </p>
    <p>
        <a href="#">English (United States)</a>
        <img src="img/ersb.png" alt="ESRB">
    </p>
</div>

</body>
</html>
