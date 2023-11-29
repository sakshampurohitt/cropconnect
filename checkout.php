<?php
session_start();

if (!isset($_SESSION['user_id'])) {
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
    <title>Checkout | CropConnect</title>
    <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
    <link rel="stylesheet" href="styles2.css">
    <style>
        .checkout-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .delivery-address-form {
            width: 60%;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(10, 10, 10, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        .delivery-address-form label {
            display: block;
            margin-bottom: 10px;
        }

        .delivery-address-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .payment-button {
            width: 60%;
            padding: 20px;
            background-color: #2E8B57;
            border-radius: 10px;
            color: white;
            text-align: center;
            cursor: pointer;
            margin: auto;
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
            if (isset($_SESSION['user_id'])) {
                echo '<div class="login-name">Welcome ' . $_SESSION['firstName'] . '</div>';
                echo '<a href="logout.php">Logout</a>';
            } else {
                echo '<a href="login.php">Login/Register</a>';
            }
            ?>
        </div>
    </div>
    <div class="checkout-container">
        <h1>Checkout</h1>

        <div class="delivery-address-form">
            <form action="checkout.php" method="post">
                <label for="delivery-address">Delivery Address:</label>
                <input type="text" id="delivery-address" name="delivery_address" required>
                <button type="submit" class="payment-button" name="submit">Proceed to Payment</button>
            </form>
        </div>

        <h2>Your Order Details</h2>
        <?php
        $totalAmount = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<p>';
                echo 'Product: ' . $row['ProductName'] . '<br>';
                if (isset($row['Price'])) {
                    echo 'Price: ₹' . $row['Price'] . '<br>';
                } else {
                    echo 'Price not available<br>';
                }
                echo 'Quantity: ' . $row['Quantity'] . '<br>';
                echo 'Subtotal: ₹' . ($row['Price'] * $row['Quantity']) . '<br>';
                echo '</p>';

                $totalAmount += $row['Price'] * $row['Quantity'];
            }
        } else {
            echo '<p>Your cart is empty.</p>';
        }
        ?>

        <p>Total Amount: ₹<?php echo $totalAmount; ?></p>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $deliveryAddress = $conn->real_escape_string($_POST['delivery_address']);

        // Insert order into the 'orders' table
        $orderDate = date("Y-m-d H:i:s");
        $insertOrderSQL = "INSERT INTO orders (OrderDate, CustID) VALUES ('$orderDate', $customerID)";
        $conn->query($insertOrderSQL);

        // Retrieve the OrderID of the newly inserted order
        $orderID = $conn->insert_id;

        // Update 'orderproducts' table
        $result = $conn->query("SELECT * FROM Cart WHERE CustomerID = $customerID");

        while ($row = $result->fetch_assoc()) {
            $productID = $row['ProductID'];
            $quantity = $row['Quantity'];

            // Retrieve product details including the price from the 'Product' table
            $productDetailsSQL = "SELECT * FROM Product WHERE ProductID = $productID";
            $productDetailsResult = $conn->query($productDetailsSQL);

            if ($productDetailsResult->num_rows > 0) {
                $productDetails = $productDetailsResult->fetch_assoc();
                $price = $productDetails['Price'];

                $amount = $price * $quantity;

                // Insert order details into 'orderproducts' table
                $insertOrderProductSQL = "INSERT INTO orderproducts (OrderID, ProductID, Quantity, Amount) 
                                    VALUES ($orderID, $productID, $quantity, $amount)";
                $conn->query($insertOrderProductSQL);
            } else {
                echo 'Skipping product without details<br>';
            }
        }

        // Clear the user's cart after placing the order
        // VVV Important
        $conn->query("DELETE FROM Cart WHERE CustomerID = $customerID");
        header("Location: payment.php");
      exit();
    }
    ?>

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

</body>

</html>