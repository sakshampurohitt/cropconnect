<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Categories | CropConnect</title>
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <link rel="stylesheet" href="styles2.css">
</head>

<body>

  <div class="navbar">
    <a href="index.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
    <a href="index.php">Home</a>
    <a href="cart.php">Cart</a>
    <a class="active" href="categories.php">Categories</a>
    <div class="login-container">
      <?php
      if (isset($_SESSION['username'])) {
        echo '<div class="login-name">Welcome ' . $_SESSION['firstName'] . '</div>';
        echo '<a href="logout.php">Logout</a>';
      } else {
        echo '<a href="login.php">Login/Register</a>';
      }
      ?>
    </div>
  </div>

  <div class="container">
    <h1>Welcome to Farmer Market</h1>

    <div class="options-container">
      <a href="vegetables.php">
        <img src="images/vegetables.jpeg" alt="Vegetables" width="300" height="200">
        <p>Vegetables</p>
      </a>

      <a href="fruits.php">
        <img src="images/fruits.jpg" alt="Fruits" width="300" height="200">
        <p>Fruits</p>
      </a>

      <a href="dryfruits.php">
        <img src="images/dryfruits.jpg" alt="Dry Fruits" width="300" height="200">
        <p>Dry Fruits</p>
      </a>

    </div>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br><br><br><br>

  <div class="footer-content">
    <div class="footer-section"></div>
    <div class="footer-section">
      <h4>Navigation</h4>
      <p><a href="index.php">Home</a></p>
      <p><a href="cart.php">Cart</a></p>
      <p><a href="categories.php">Categories</a></p>
      <p><a href="contact.php">Contact Us</a></p>
    </div>

    <div class="footer-section">
      <h4>Address</h4>
      <p>Jaypee Institute Of Information And Technology<br>
        A-10, Sector-62, ,Noida-201 309,
        Uttar Pradesh, India.
      </p>
    </div>
    <div class="footer-section">
      <h4>Contact</h4>
      <p>Phone: +91 120-2400973</p>
    </div>
    <div class="footer-section">
      <h4>Legal</h4>
      <p><a href="terms.php">Terms and Conditions</a></p>
    </div>
    <div class="footer-section"></div>
  </div>
</body>

</html>