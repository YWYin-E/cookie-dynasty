<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$database = "cookie dynasty";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the request
$username = $_POST['username'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security

// Prepare and bind
$sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";

// Execute the statement
if ($conn->query($sql) === TRUE) {

    header("Location: http://localhost/cookiedynasty/");
    exit();     
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}



?>
