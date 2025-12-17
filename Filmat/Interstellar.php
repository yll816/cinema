<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Interstellar</title>
  <link rel="stylesheet" href="style2.css">

  <style>
    .hidden {
      display: none;
    }
  </style>
</head>
<body>

<header>
  <div class="header-container">
    <div class="logo">
      <img src="../img/cineplex.png" alt="Cineplexx Logo">
    </div>

    <nav class="main-nav">
      <a href="../index.html">FILMA</a>
      <a href="#">EVENTE</a>
      <a href="#">KINEMATË</a>
    </nav>

    <div class="account-nav">
      <a href="../login.php"><img src="../img/kyquni.png" alt="Kyçuni"></a>
      <a href="../signup.php"><img src="../img/regjistrohuni.png" alt="Regjistrohuni"></a>
    </div>
  </div>
</header>

<section class="movie-detail">

  <!-- LEFT -->
  <div class="movie-left">
    <img src="../img/interstellarr.png" alt="Interstellar Poster">

    <!-- TICKET BOX -->
    <div class="ticket-box">
      <h3>Buy Ticket</h3>

      <div class="ticket-controls">
        <button class="quantity-btn" id="minus" type="button">-</button>
        <input type="text" id="quantity" value="1" readonly>
        <button class="quantity-btn" id="plus" type="button">+</button>
      </div>

      <p>Price: <span class="sale-price">$6.00</span></p>
      <p id="stock-warning" style="color:red; display:none;"></p>

      <!-- FORM -->
      <form action="save_ticket.php" method="POST">
        <label>Choose Time</label>
        <select name="show_time" required>
          <option value="14:00">14:00</option>
          <option value="17:30">17:30</option>
          <option value="20:45">20:45</option>
        </select>

        <label>Ticket Name</label>
        <input type="text" name="ticket_name" required>

        <input type="hidden" name="movie_title" value="Interstellar">
        <input type="hidden" name="quantity" id="hiddenQuantity" value="1">

        <button type="submit" class="buy-btn">Add to Cart</button>
      </form>
    </div>
  </div>

  <!-- RIGHT -->
  <div class="movie-right">
    <h2>Interstellar</h2>
    <p class="movie-date">Release date: 18.09.2025</p>

    <iframe width="100%" height="315"
      src="https://www.youtube.com/embed/zSWdZVtXT7E"
      title="YouTube trailer"
      frameborder="0"
      allowfullscreen>
    </iframe>

    <p class="movie-desc" id="description">
      With our time on Earth coming to an end, a team of explorers undertakes the most important mission in human history.
    </p>

    <div id="full-description" class="hidden">
      <p>
        With our time on Earth coming to an end, a team of explorers undertakes the most important mission in human history:
        traveling beyond this galaxy to discover whether mankind has a future among the stars.
      </p>
    </div>

    <button class="toggle-desc" id="show-more-btn">Trego më shumë</button>

    <div class="movie-details">
      <h3>Detajet e filmit</h3>
      <p><strong>Titulli origjinal:</strong> Interstellar</p>
      <p><strong>Filmi fillon:</strong> 18.09.2025</p>
      <p><strong>Kohëzgjatja:</strong> 2h 46m</p>
      <p><strong>Regjisori:</strong> Christopher Nolan</p>
    </div>
  </div>

</section>

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
</footer>

<div class="footer-bottom">
  <p>© Cineplexx Kosovo L.L.C</p>
</div>

<!-- JS -->
<script>
document.addEventListener("DOMContentLoaded", () => {

  const qty = document.getElementById("quantity");
  const hiddenQty = document.getElementById("hiddenQuantity");
  const price = document.querySelector(".sale-price");
  const warning = document.getElementById("stock-warning");

  const unitPrice = 6;

  function update() {
    price.textContent = `$${(unitPrice * qty.value).toFixed(2)}`;
    hiddenQty.value = qty.value;
  }

  document.getElementById("minus").onclick = () => {
    if (qty.value > 1) {
      qty.value--;
      update();
    }
    warning.style.display = "none";
  };

  document.getElementById("plus").onclick = () => {
    if (qty.value < 5) {
      qty.value++;
      update();
    } else {
      warning.style.display = "block";
      warning.textContent = "Maksimumi i lejuar është 5";
    }
  };

  const btn = document.getElementById("show-more-btn");
  const full = document.getElementById("full-description");

  btn.onclick = () => {
    full.classList.toggle("hidden");
    btn.textContent = full.classList.contains("hidden")
      ? "Trego më shumë"
      : "Trego më pak";
  };
});
</script>

</body>
</html>
