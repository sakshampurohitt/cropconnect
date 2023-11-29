<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | CropConnect</title>
  <style>
    body {
      background-image: url('https://c4.wallpaperflare.com/wallpaper/910/11/748/background-fruit-vegetables-cuts-hd-wallpaper-preview.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: rgba(250, 255, 255, 0.3);
      padding: 20px;
      box-shadow: 0 2px 5px rgba(10, 10, 10, 0.1);
      border-radius: 10px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
    }

    .form-box {
      background-color: rgba(255, 255, 255, 0.6);
      padding: 30px;
      border-radius: 10px;
      position: relative;
      left: 20px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
      width: 100%;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      margin-top: 15px;
    }

    input {
      margin: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 90%;
      padding: 10px;
      border-radius: 3px;
      border: 2px solid yellow;
    }

    .form-group label {
      display: inline;
      margin-right: 10px;
    }

    .user-type-radio {
      display: flex;
      align-items: center;
    }

    input[type="radio"] {
      margin-right: 5px;
      margin-top: 15px;
    }

    button {
      padding: 10px 20px;
      align-items: center;
      background-color: green;
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    button:hover {
      background-color: orange;
    }

    p {
      color: white;
    }

    a {
      color: orange;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="form-box">
      <h1>Login</h1>
      <form id="loginForm" action="login_process.php" method="post">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="form-group">
          <label>Login as:</label>
          <div class="user-type-radio">
            <input type="radio" id="farmer" name="user_type" value="F">
            <label for="farmer">Farmer</label>
            <input type="radio" id="vendor" name="user_type" value="V">
            <label for="vendor">Vendor</label>
            <input type="radio" id="consumer" name="user_type" value="C">
            <label for="consumer">Consumer</label>
          </div>
        </div>
        <button type="submit">Login</button>
      </form>
    </div>
    <p>Don't have an account? <a href="registration.php">Register here</a></p>
  </div>

  <script src="script.js"></script>
</body>

</html>
<?php

?>