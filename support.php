<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support | CropConnect</title>
    <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
    <link rel="stylesheet" href="styles2.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea,
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: #ff0000;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <a href="farmer_portal.php" class="logo"><img src="cropconnect.png" alt="Company Logo"></a>
        <a href="farmer_portal.php">Home</a>
        <a href="my_products.php">My Products</a>
        <a href="transactions.php">Transactions</a>
        <a class="active" href="support.php">Support</a>
        <div class="login-container">
            <?php
            echo '<div class="login-name">Welcome ' . $_SESSION['firstName'] . '</div>';
            ?>
            <a href="logout.php">Logout</a>
        </div>

    </div>

    <div class="container">
        <h1>Support</h1>

        <form id="contactForm" method="post" action="mailto: 22103030@mail.jiit.ac.in">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="number">Phone Number:</label>
            <input type="tel" name="number" id="number" pattern="[0-9]{10}" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="query">Query:</label>
            <textarea name="query" id="query" rows="4" required></textarea>

            <button type="button" onclick="submitForm()">Submit</button>
        </form>

        <div id="errorDisplay" class="error-message"></div>

        <script>
            function submitForm() {
                var name = document.getElementById('name').value.trim();
                var number = document.getElementById('number').value.trim();
                var email = document.getElementById('email').value.trim();
                var query = document.getElementById('query').value.trim();

                var errorDisplay = document.getElementById('errorDisplay');
                errorDisplay.innerHTML = '';

                // Basic form validation
                if (name === '' || number === '' || email === '' || query === '') {
                    errorDisplay.innerHTML = 'All fields are required';
                } else if (!isValidPhoneNumber(number)) {
                    errorDisplay.innerHTML = 'Invalid phone number';
                } else {
                    alert('Query submitted successfully!');

                }
            }

            function isValidPhoneNumber(number) {
                // Basic phone number validation (10 digits)
                var regex = /^[0-9]{10}$/;
                return regex.test(number);
            }
        </script>
    </div>
    <br><br><br><br><br><br><br><br>
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