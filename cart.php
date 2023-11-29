<?php
session_start();

if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmermarket";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$customerID = $_SESSION['user_id'];
$sql = "SELECT Product.*, ProductImages.Image, Cart.Quantity 
        FROM Cart
        JOIN Product ON Cart.ProductID = Product.ProductID
        JOIN ProductImages ON Product.ProductName = ProductImages.ProductName
        WHERE Cart.CustomerID = $customerID";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopping Cart | CropConnect</title>
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <link rel="stylesheet" href="styles2.css">
  <style>
    .navbar {
      overflow: hidden;
      background-color: #333;
    }

    .navbar .login-container,
    #search-container {
      float: right;
    }

    .navbar a {
      float: left;
      display: block;
      color: white;
      text-align: center;
      padding: 20px 20px;
      text-decoration: none;
    }

    .navbar #search-container {
      float: right;
    }

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

    .active {
      background-color: MediumSeaGreen;
    }

    .navbar a:hover {
      background-color: #ddd;
      color: black;
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

    .cart-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 20px;
    }

    .cart-item {
      width: 80%;
      padding: 10px;
      margin-bottom: 20px;
      background-color: rgba(255, 255, 255, 0.6);
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(10, 10, 10, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .product-details {
      display: flex;
      align-items: center;
    }

    .product-details img {
      width: 80px;
      height: 80px;
      margin-right: 10px;
      border-radius: 8px;
    }

    .checkout {
      width: 80%;
      padding: 20px;
      background-color: #2E8B57;
      border-radius: 10px;
      color: white;
      text-align: center;
      cursor: pointer;
      color: #ffffff;
      text-decoration: none;
      position: relative;
    }
  </style>
</head>

<body>

  <div class="navbar">
    <a href="index.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
    <a href="index.php">Home</a>
    <a class="active" href="cart.php">Cart</a>
    <a href="categories.php">Categories</a>

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

    <div id="search-container">
      <form action="search.php" method="GET">
        <input type="text" placeholder="Search for products..." name="search">
        <button type="submit">Search</button>
      </form>
    </div>
  </div>

  <div class="cart-container">
    <h1>Your Shopping Cart</h1>

    <?php
    $totalAmount = 0;

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="cart-item">';
        echo '<div class="product-details">';
        echo '<img src="' . $row['Image'] . '" alt="' . $row['ProductName'] . '">';
        echo '<p>' . $row['ProductName'] . '</p>';
        echo '</div>';
        echo '<p>Price: ₹' . $row['Price'] . '</p>';
        echo '<p>Quantity: ' . $row['Quantity'] . '</p>';
        echo '<p>Subtotal: ₹' . ($row['Price'] * $row['Quantity']) . '</p>';
        echo '</div>';

        $totalAmount += $row['Price'] * $row['Quantity'];
      }
    } else {
      echo '<p>Your cart is empty.</p>';
    }
    ?>

    <div class="checkout">
      <p>Total Amount: ₹<?php echo $totalAmount; ?></p>
      <a href="checkout.php">Checkout</a>
    </div>
  </div>
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