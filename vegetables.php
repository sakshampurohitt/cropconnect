<?php
session_start();
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vegetables | CropConnect</title>
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <link rel="stylesheet" href="styles2.css">
  <style>
      .product-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      margin-top: 20px;
    }

    .product-card {
      width: 300px;
      margin-bottom: 20px;
      padding: 10px;
      background-color: rgba(255, 255, 255, 0.6);
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(10, 10, 10, 0.1);
      text-align: center;
    }

    .product-image {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 8px;
    }

    .product-link {
      text-decoration: none;
      color: inherit;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <div class="navbar">
    <a href="index.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
    <a href="index.php">Home</a>
    <a href="cart.php">Cart</a>

    <a href="categories.php">Categories</a>
    <a class="active" href="vegetables.php">Vegetables</a>

    <div class="login-container">
      <?php

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

  <!-- Container for vegetables -->
  <div class="container">
    <h1>Vegetables</h1>

    <!-- Display Vegetables -->
    <div class="product-container">
      <?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "farmermarket";

      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
      // Fetch Vegetables from the database
      $sql_vegetables = "SELECT 
        Product.ProductID, 
        Product.ProductName, 
        Product.Price, 
        Product.Quantity_avail, 
        Product.FarmerID, 
        Product.Image,
        Users.Name AS FarmerName,
        Users.Location AS FarmerLocation
        FROM product
        JOIN Users ON Product.FarmerID = Users.ID
        WHERE Product.CatID = (SELECT CatID FROM category WHERE Category = 'Vegetables')";

      $result_vegetables = $conn->query($sql_vegetables);

      if ($result_vegetables->num_rows > 0) {
        while ($row_vegetables = $result_vegetables->fetch_assoc()) {
          echo '<a href="product_details.php?productID=' . $row_vegetables["ProductID"] . '" class="product-link">';
          echo '<div class="product-card">';
          echo '<img class="product-image" src="' . $row_vegetables["Image"] . '" alt="' . $row_vegetables["ProductName"] . '">';
          echo '<p><strong>' . $row_vegetables["ProductName"] . '</strong></p>';
          echo '<p><strong>Price:</strong> ₹' . $row_vegetables["Price"] . ' per kg</p>';
          echo '<p><strong>Available Quantity:</strong> ' . $row_vegetables["Quantity_avail"] . ' kg</p>';
          echo '<p><strong>Farmer:</strong> ' . $row_vegetables["FarmerName"] . '</p>';
          echo '<p><strong>Location:</strong> ' . $row_vegetables["FarmerLocation"] . '</p>';
          echo '</div>';
          echo '</a>';
        }
      } else {
        echo '<p>No vegetables available.</p>';
      }

      ?>
    </div>
  </div>
  <footer>
  <br><br><br><br><br><br><br>
  <br><br><br><br><br><br>
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
  </footer>

</body>

</html>