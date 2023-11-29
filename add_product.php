<?php
session_start();

$Products = array(
    'Vegetables' => array('Carrot', 'Tomato', 'Broccoli', 'Spinach', 'Bell Pepper'),
    'Fruits' => array('Apple', 'Banana', 'Orange', 'Grapes', 'Strawberry'),
    'Dry Fruits' => array('Almonds', 'Cashews', 'Raisins', 'Walnuts', 'Pistachios')
);

function getCategories()
{
    return array('Vegetables', 'Fruits', 'Dry Fruits');
}

function getProductsByCategory($category)
{
    return isset($Products[$category]) ? $Products[$category] : array();
}

function addProduct($productName, $category, $price, $quantity)
{
    return "Product added successfully!";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    $resultMessage = addProduct($productName, $category, $price, $quantity);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product | CropConnect</title>
    <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
    <link rel="stylesheet" href="styles2.css">
    <style>
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input,
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
            padding: 12px;
            font-size: 16px;
            border-radius: 4px;
        }

        button:hover {
            background-color: #45a049;
        }

        .result-message {
            font-weight: bold;
            color: green;
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
        <a href="farmer_portal.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
        <a href="farmer_portal.php">Home</a>
        <a href="my_products.php">My Products</a>
        <a href="transactions.php">Transactions</a>
        <a href="support.php">Support</a>
        <a class="active" href="add_product.php">Add Products</a>

        <div class="login-container">
            <?php
            echo '<div class="login-name">Welcome ' . $_SESSION['firstName'] . '</div>';
            ?>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <h1>Add Your Product</h1>

        <?php
        if (isset($resultMessage)) {
            echo '<p class="result-message">' . $resultMessage . '</p>';
        }
        ?>

        <div class="options">
            <form action="add_product.php" method="post">
                <div class="form-group">
                    <label for="category">Select Category:</label>
                    <select id="category" name="category" required>
                        <?php
                        $categories = getCategories();
                        foreach ($categories as $cat) {
                            echo '<option value="' . $cat . '">' . $cat . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="product">Select Product:</label>
                    <select id="product" name="productName" required>
                    </select>
                </div>

                <div class="form-group">
                    <label for="price">Price:</label>
                    <input type="number" id="price" name="price" required>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity Available:</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>

                <button type="submit">Add Product</button>
            </form>
        </div>
    </div>

    <script>
        // JavaScript to dynamically populate product dropdown based on selected category
        document.getElementById('category').addEventListener('change', function() {
            var category = this.value;
            var products = <?php echo json_encode($Products); ?>;
            var productDropdown = document.getElementById('product');

            // Clear existing options
            productDropdown.innerHTML = '<option value="" disabled selected>Select a product</option>';

            // Populate options based on selected category
            for (var i = 0; i < products[category].length; i++) {
                var option = document.createElement('option');
                option.value = products[category][i];
                option.text = products[category][i];
                productDropdown.appendChild(option);
            }
        });
    </script>
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