<!-- my_products.php -->
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Products | CropConnect</title>
  <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
  <link rel="stylesheet" href="styles2.css">
  <style>
    .product-container {
      margin-top: 20px;
      text-align: center;
    }

    table {
      width: 80%;
      margin: 20px auto;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .add-product-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      font-size: 18px;
      text-decoration: none;
      color: #4CAF50;
    }
  </style>
</head>

<body>

  <div class="navbar">
    <a href="farmer_portal.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
    <a href="farmer_portal.php">Home</a>
    <a class="active" href="my_products.php">My Products</a>
    <a href="transactions.php">Transactions</a>
    <a href="support.php">Support</a>
    <div class="login-container">
      <?php
        echo '<div class="login-name">Welcome ' . $_SESSION['firstName'] . '</div>';
      ?>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <div class="container product-container">
    <h1>My Products</h1>

    <a href="add_product.php" class="add-product-link">Add a New Product</a>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "farmermarket";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Product WHERE FarmerID = {$_SESSION['user_id']}";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "<table>
                <tr>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                </tr>";
      while ($row = $result->fetch_assoc()) {
        echo "<tr>
                    <td>{$row['ProductName']}</td>
                    <td>{$row['CatID']}</td>
                    <td>₹{$row['Price']}</td>
                    <td>{$row['Quantity_avail']}</td>
                  </tr>";
      }
      echo "</table>";
    } else {
      echo "You have no products listed.";
    }

    $conn->close();
    ?>
  </div>
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
</body>

</html>