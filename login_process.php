<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "farmermarket";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $username = $_POST["username"];
  $password = $_POST["password"];
  $userType = $_POST["user_type"];

  $sql = "SELECT * FROM Users WHERE Username='$username' AND Password='$password' AND Type='$userType'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {

    $userRow = $result->fetch_assoc();

    $_SESSION['user_id'] = $userRow['ID'];
    $_SESSION['username'] = $userRow['Username'];
    $_SESSION['user_type'] = $userRow['Type'];
    $_SESSION['firstName'] = $userRow['Name'];
    $_SESSION['email'] = $userRow['Email'];
    $_SESSION['contact'] = $userRow['Contact'];
    $_SESSION['location'] = $userRow['Location'];

    if ($userType == "F") {
      header("Location: farmer_portal.php");
      exit();
    }
    elseif ($userType == "C" || $userType == "V") {
      header("Location: index.php");
      exit();
    }
  } else {
    session_destroy();
    echo "Invalid username or password";
    exit();
  }

  $conn->close();
}
