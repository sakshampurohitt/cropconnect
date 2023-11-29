<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registration | CropConnect</title>
    <link rel="icon" type="image/x-icon" href="images/cropconnect-favicon-color.ico">
    <link rel="stylesheet" href="styles.css">
    <script>
        function validateForm() {
            // Check if all fields are filled
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var userType = document.querySelector('input[name="user_type"]:checked');
            var name = document.getElementById("name").value;
            var contact = document.getElementById("contact").value;
            var email = document.getElementById("email").value;
            var location = document.getElementById("location").value;

            if (!username || !password || !userType || !name || !contact || !email || !location) {
                alert("Please fill in all fields.");
                return false;
            }

            // Password validation: Check for capital letter, number, and symbol
            var passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d]).{8,}$/;
            if (!passwordRegex.test(password)) {
                alert("Password must contain at least one capital letter, one number, and one symbol. Minimum length is 8 characters.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="form-box">
            <h1>Registration Form</h1>
            <form action="registration_process.php" method="post" onsubmit="return validateForm()">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label>User Type:</label>
                    <div class="options">
                        <input type="radio" id="farmer" name="user_type" value="F" required>
                        <label for="farmer">Farmer</label>
                        <input type="radio" id="vendor" name="user_type" value="V" required>
                        <label for="vendor">Vendor</label>
                        <input type="radio" id="consumer" name="user_type" value="C" required>
                        <label for="consumer">Consumer</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="contact">Contact:</label>
                    <input type="text" id="contact" name="contact" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <select id="location" name="location" required>
                        <option value="North West Delhi">North West Delhi</option>
                        <option value="North Delhi">North Delhi</option>
                        <option value="North East Delhi">North East Delhi</option>
                        <option value="Central Delhi">Central Delhi</option>
                        <option value="New Delhi">New Delhi</option>
                        <option value="East Delhi">East Delhi</option>
                        <option value="South Delhi">South Delhi</option>
                        <option value="South East Delhi">South East Delhi</option>
                        <option value="South West Delhi">South West Delhi</option>
                        <option value="West Delhi">West Delhi</option>
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit">Register</button>
                </div>
            </form>
        </div>
        <p><b>Already have an account? <a href="login.php">Login here</a></b></p>
    </div>
</body>

</html>