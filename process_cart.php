<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_to_cart"])) {
    $customerID = $_SESSION['user_id'];
    $productID = $_POST['productID'];
    $quantity = $_POST['quantity'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "farmermarket";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $check_cart_sql = "SELECT * FROM Cart WHERE CustomerID = $customerID AND ProductID = $productID";
    $check_cart_result = $conn->query($check_cart_sql);

    if ($check_cart_result->num_rows > 0) {
        $update_cart_sql = "UPDATE Cart SET Quantity = Quantity + $quantity WHERE CustomerID = $customerID AND ProductID = $productID";
        $conn->query($update_cart_sql);
    } else {
        $insert_cart_sql = "INSERT INTO Cart (CustomerID, ProductID, Quantity) VALUES ($customerID, $productID, $quantity)";
        $conn->query($insert_cart_sql);
    }

    $conn->close();
}
ob_start();

header("Location: cart.php");
exit();
