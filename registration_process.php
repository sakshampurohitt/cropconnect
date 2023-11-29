<?php
session_start();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Connect to the database
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
  $name = $_POST["name"];
  $contact = $_POST["contact"];
  $email = $_POST["email"];
  $location = $_POST["location"];

  $sql = "INSERT INTO Users (Username, Password, Type, Name, Contact, Email, Location) 
          VALUES ('$username', '$password', '$userType', '$name', '$contact', '$email', '$location')";

  if ($conn->query($sql) === TRUE) {
    $sql2 = "SELECT * FROM Users WHERE Username='$username' AND Password='$password' AND Type='$userType'";
    $result = $conn->query($sql2);
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
    } else {
      echo "Registration Unsuccessful";
    }
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    session_destroy();
  }

  // Close the database connection
  $conn->close();
}
