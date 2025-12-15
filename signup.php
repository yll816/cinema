<?php
require "db.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $first = $_POST['emri'];
    $last = $_POST['mbiemri'];
    $address = $_POST['adresa'];
    $email = $_POST['email'];
    $phone = $_POST['tel'];
    $username = $_POST['emriPerdoruesit'];
    $password = password_hash($_POST['fjalekalimi'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (emri, mbiemri, adresa, email, tel, username, password)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "<script>alert('Error preparing SQL statement!');</script>";
        exit;
    }

    $stmt->bind_param("sssssss", $first, $last, $address, $email, $phone, $username, $password);

    if ($stmt->execute()) {
        echo "<script>
        alert('Registration successful!');
        window.location.href = 'index.html';
      </script>";
        exit;
    } else {
        echo "<script>alert('Username or Email already exists!');</script>";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrohu</title>
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

<form method="post" action="signup.php">
    <div class="login-block">
        <h1>Sign Up</h1>

        <input type="text" placeholder="Emri" name="emri" required/> 
        <input type="text" placeholder="Mbiemri" name="mbiemri" required/> 
        <input type="text" placeholder="Adresa" name="adresa" required/> 
        <input type="email" placeholder="Email" name="email" required/> 
        <input type="text" placeholder="Telefoni" name="tel" required/>
        <input type="text" placeholder="Emri Perdoruesit" name="emriPerdoruesit" required/> 
        <input type="password" placeholder="Fjalekalimi" name="fjalekalimi" required/>

        <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>

        <button type="submit">Regjistro</button>
        <br/><br/>
        <a href="login.php">Login?</a>
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
    <p>© Cineplexx Kosovo L.L.C   Politika e Privatësisë Informacion Ligjor Rreth nesh Na kontaktoni</p>
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

<script src="js/signup.js"></script>

</body>
</html>
