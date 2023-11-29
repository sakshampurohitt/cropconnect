<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | CropConnect</title>
    <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
    <link rel="stylesheet" href="styles.css">
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
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
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
    </div>

    <div class="container">
        <h1>Contact Us</h1>

        <form id="contactForm" method="post">
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

                if (name === '' || number === '' || email === '' || query === '') {
                    errorDisplay.innerHTML = 'All fields are required';
                } else if (!isValidPhoneNumber(number)) {
                    errorDisplay.innerHTML = 'Invalid phone number';
                } else {
                    alert('Query submitted successfully!'); 
                }
            }

            function isValidPhoneNumber(number) {
                var regex = /^[0-9]{10}$/;
                return regex.test(number);
            }
        </script>
    </div>

</body>

</html>