<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <title>Search | CropConnect</title>
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
    .navbar a, .login-name {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 20px 20px;
  text-decoration: none;
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

  <!-- Container for search -->
  <div class="container">
    <h1>Search Result</h1>

    <!-- Display search -->
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
      if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // Get the search query from the form
        $searchQuery = $_GET["search"];
        $sql_search = "SELECT 
                            Product.ProductID, 
                            Product.ProductName, 
                            Product.Price, 
                            Product.Quantity_avail, 
                            Product.Image,
                            Users.Name AS FarmerName,
                            Users.Location AS FarmerLocation
                          FROM product
                          JOIN Users ON Product.FarmerID = Users.ID
                          WHERE Product.ProductName LIKE '%$searchQuery%'";

        $result_search = $conn->query($sql_search);

        if ($result_search->num_rows > 0) {
          while ($row_search = $result_search->fetch_assoc()) {
            echo '<a href="product_details.php?productID=' . $row_search["ProductID"] . '" class="product-link">';
            echo '<div class="product-card">';
            echo '<img class="product-image" src="' . $row_search["Image"] . '" alt="' . $row_search["ProductName"] . '">';
            echo '<p><strong>' . $row_search["ProductName"] . '</strong></p>';
            echo '<p><strong>Price:</strong>₹' . $row_search["Price"] . ' per kg</p>';
            echo '<p><strong>Available Quantity:</strong> ' . $row_search["Quantity_avail"] . ' kg</p>';
            echo '<p><strong>Farmer:</strong> ' . $row_search["FarmerName"] . '</p>';
            echo '<p><strong>Location:</strong> ' . $row_search["FarmerLocation"] . '</p>';
            echo '</div>';
            echo '</a>';
          }
        } else {
          echo '<p>No search available.</p>';
        }
      }

      $conn->close();
      ?>
    </div>
  </div>
<br><br><br><br><br><br><br>
<br><br><br><br><br>
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
        A-10, Sector-62, Noida-201 309,
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