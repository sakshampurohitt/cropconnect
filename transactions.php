<?php
session_start();

// Database Connection
$host = 'localhost';
$db = 'farmermarket';
$user = 'root';
$pass = '';

try {
  $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  exit();
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}

// Fetch the logged-in user's information
$loggedInUserID = $_SESSION['user_id']; 

$sql = "SELECT o.OrderID, o.OrderDate, op.ProductID, p.ProductName, p.Price, op.Quantity, op.Amount, 
        u.Username AS CustomerUsername, u.Name AS CustomerName, u.Contact AS CustomerContact
        FROM orders o
        JOIN orderproducts op ON o.OrderID = op.OrderID
        JOIN product p ON op.ProductID = p.ProductID
        JOIN users u ON o.CustID = u.ID
        WHERE p.FarmerID = :loggedInUserID
        ORDER BY o.OrderDate DESC";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':loggedInUserID', $loggedInUserID);
$stmt->execute();

$transactions = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transaction Details | CropConnect</title>
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <link rel="stylesheet" href="styles2.css">
  <style>
    .transaction-table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
    }

    .transaction-table th,
    .transaction-table td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    .transaction-table th {
      background-color: #f2f2f2;
    }
  </style>
</head>

<body>

  <div class="navbar">
    <a href="farmer_portal.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
    <a href="farmer_portal.php">Home</a>
    <a href="my_products.php">My Products</a>
    <a class="active" href="transactions.php">Transactions</a>
    <a href="support.php">Support</a>

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

  <div class="container portal-container">
    <h1>Transaction Details</h1>

    <?php if ($transactions) : ?>
      <table class="transaction-table">
        <tr>
          <th>Order ID</th>
          <th>Order Date</th>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Amount</th>
          <th>Customer Username</th>
          <th>Customer Name</th>
          <th>Customer Contact</th>
        </tr>
        <?php foreach ($transactions as $transaction) : ?>
          <tr>
            <td><?= $transaction['OrderID'] ?></td>
            <td><?= $transaction['OrderDate'] ?></td>
            <td><?= $transaction['ProductID'] ?></td>
            <td><?= $transaction['ProductName'] ?></td>
            <td>₹<?= $transaction['Price'] ?></td>
            <td><?= $transaction['Quantity'] ?></td>
            <td>₹<?= $transaction['Amount'] ?></td>
            <td><?= $transaction['CustomerUsername'] ?></td>
            <td><?= $transaction['CustomerName'] ?></td>
            <td><?= $transaction['CustomerContact'] ?></td>
          </tr>
        <?php endforeach; ?>
      </table>
    <?php else : ?>
      <p>No transactions found.</p>
    <?php endif; ?>
  </div>
  <br><br><br><br><br><br><br><br><br><br><br>
  
  <!-- Footer Section -->
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