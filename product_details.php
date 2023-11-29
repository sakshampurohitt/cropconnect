<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CropConnect</title>
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

    .container {
      padding: 20px;
    }

    .product-card {
      display: flex;
      align-items: center;
    }

    .product-image {
      max-width: 40%;
      margin-right: 20px;
      border-radius: 5%;
    }

    .product-details {
      max-width: 60%;
    }

    form {
      width: 100%;
    }

    label,
    select,
    input {
      display: block;
      margin-bottom: 10px;
    }

    button {
      background-color: #4caf50;
      color: white;
      padding: 10px;
      border: none;
      cursor: pointer;
      width: 45%;
      margin-right: 5%;
    }

    button:hover {
      background-color: #45a049;
    }

    footer {
      background-color: #2E8B57;
      padding: 20px;
      text-align: center;
      position: fixed;
      bottom: 0;
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: white;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      width: 100%;
      flex-wrap: wrap;
    }

    .footer-section {
      margin-bottom: 10px;
      margin-left: 70px;
      margin-right: 100px;
    }

    .footer-menu p,
    .footer-contact p {
      margin: 0;
    }

    .footer-content a {
      color: #ffffff;
      text-decoration: none;
      position: relative;
    }

    .footer-content a:after {
      content: '';
      display: block;
      width: 0;
      height: 1px;
      background-color: #0000FF;
      position: absolute;
      bottom: -2px;
      transition: width 0.3s;
    }

    img {
      border-radius: 5%;
    }

    .footer-content a:hover:after {
      width: 100%;
    }

    .footer-content a[href="terms.php"]:before {
      content: ' ';
      display: inline-block;
      margin-right: 20px;
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
      if (isset($_SESSION['username'])) {
        echo 'Welcome' . $_SESSION['firstName'];
        echo '<a href="logout.php">Logout</a>';
      } else {
        echo '<a href="login.php">Login/Register</a>';
      }
      ?>
    </div>
  </div>

  <div class="container">
    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "farmermarket";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['productID'])) {
      $productID = $_GET['productID'];

      $sql_product_details = "SELECT 
                Product.ProductID, 
                Product.ProductName, 
                Product.Price, 
                Product.Quantity_avail, 
                Product.FarmerID, 
                Product.Image,
                Users.Name AS FarmerName,
                Users.Location AS FarmerLocation,
                category.Category AS ProductCategory
                FROM product
                JOIN Users ON Product.FarmerID = Users.ID
                JOIN category ON Product.CatID = category.CatID
                WHERE Product.ProductID = $productID";

      $result_product_details = $conn->query($sql_product_details);

      if ($result_product_details->num_rows > 0) {
        $row_product_details = $result_product_details->fetch_assoc();

        echo '<div class="product-card">';
        echo '<img class="product-image" src="' . $row_product_details["Image"] . '" alt="' . $row_product_details["ProductName"] . '">';
        echo '<p>' . $row_product_details["ProductName"] . '</p>';
        echo '<p>Category: ' . $row_product_details["ProductCategory"] . '</p>';
        echo '<p>Price: $' . $row_product_details["Price"] . ' per kg</p>';
        echo '<p>Available Quantity: ' . $row_product_details["Quantity_avail"] . ' kg</p>';
        echo '<p>Farmer: ' . $row_product_details["FarmerName"] . '</p>';
        echo '<p>Location: ' . $row_product_details["FarmerLocation"] . '</p>';

        echo '<form action="process_cart.php" method="post">';
        echo '<label for="quantity">Quantity:</label>';
        echo '<input type="number" name="quantity" id="quantity" min="1" max="' . $row_product_details["Quantity_avail"] . '" required>';
        echo '<input type="hidden" name="productID" value="' . $row_product_details["ProductID"] . '">';
        echo '<button type="submit" name="add_to_cart">Add to Cart</button>';
        echo '</form>';

        echo '</div>';
      } else {
        echo '<p>Product not found.</p>';
      }
    } else {
      echo '<p>Invalid product details request.</p>';
    }

    $conn->close();
    ?>
  </div>

  <footer>
    <div class="footer-content">
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
    </div>
  </footer>
</body>
</html>