<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CropConnect Home</title>
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <link rel="stylesheet" href="styles2.css">
  <style>
    .navbar input[type=text] {
      padding: 6px;
      margin-top: 8px;
      font-size: 17px;
      border: none;
    }

    .navbar #search-container button {
      float: right;
      padding: 6px;
      margin-top: 8px;
      margin-right: 16px;
      background: #ddd;
      font-size: 17px;
      border: none;
      cursor: pointer;
    }

    .navbar #search-container button:hover {
      background: #ccc;
    }

    @media screen and (max-width: 600px) {
      .navbar #search-container {
        float: none;
      }

      .navbar a,
      .navbar input[type=text],
      .navbar #search-container button {
        float: none;
        display: block;
        text-align: left;
        width: 100%;
        margin: 0;
        padding: 14px;
      }

      .navbar input[type=text] {
        border: 1px solid #ccc;
      }
    }
    .banner img {
      border-radius: 0%;
    }
  </style>
</head>

<body>

  <div class="navbar">
    <a href="index.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
    <a class="active" href="index.php">Home</a>
    <a href="cart.php">Cart</a>
    <a href="categories.php">Categories</a>

    <div class="login-container">
      <?php
      //
      if (isset($_SESSION['username'])) {
        echo '<div class="login-name">Welcome ' . $_SESSION['firstName'] . '</div>';
        echo '<a href="logout.php">Logout</a>';
      } else {
        // Session has not started show login/ registration option
        echo '<a href="login.php">Login/Register</a>';
      }
      ?>
    </div>

    <div id="search-container">
      <form action="search.php" method="GET">
        <input type="text" placeholder="Search for products..." name="search">
        <button type="submit">Search</button>
      </form>
    </div>
  </div>

  <div class="container">
    <h1>Welcome to Farmer Market</h1>
    <div class="banner">
    <img src="images/indexbanner1.jpg" alt="Banner1" width="1600px" height="400px">
    </div>
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
  <br><br>
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