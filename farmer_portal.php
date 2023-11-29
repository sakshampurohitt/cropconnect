<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Farmer Portal | CropConnect</title>
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <link rel="stylesheet" href="styles2.css">
  <style>
    body{
      background: url("images/background.jpg");
      background-repeat: no-repeat;
      background-size: cover;
    }
    .opacity {
      background-color: rgba(255,255,255,0.3);

    }
    .portal-container {
      text-align: center;
    }

    .photo-links {
      display: flex;
      justify-content: space-around;
      margin-top: 20px;
    }

    .photo-link {
      flex: 1;
      margin: 0 10px;
    }
  </style>
</head>

<body>

  <div class="navbar">
    <a href="farmer_portal.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
    <a class="active" href="farmer_portal.php">Home</a>
    <a href="my_products.php">My Products</a>
    <a href="transactions.php">Transactions</a>
    <a href="support.php">Support</a>
    <div class="login-container">
      <?php
      echo '<div class="login-name">Welcome ' . $_SESSION['firstName'] . '</div>';
      ?>
      <a href="logout.php">Logout</a>
    </div>

  </div>
<div class="opacity">
  <div class="container portal-container">
    <h1>Welcome to Your Farmer Portal</h1>

    <div class="photo-links">
      <div class="photo-link">
        <a href="my_products.php">
          <img src="images/myproduct.jpg" alt="Photo 1" width="300" height="200">
        </a>
        <br>
        <strong>My Products</strong>
      </div>
      <div class="photo-link">
        <a href="transactions.php">
          <img src="images/transaction.jpg" alt="Photo 2" width="300" height="200">
        </a>
        <br>
        <strong>Transactions</strong>
      </div>
      <div class="photo-link">
        <a href="add_product.php">
          <img src="images/addproduct.jpg" alt="Photo 3" width="300" height="200">
        </a>
        <br>
        <strong>Add Products</strong>
      </div>
    </div>
  </div>
  <br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br>

  <br><br><br><br><br><br><br><br><br>
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
</div>
</body>

</html>