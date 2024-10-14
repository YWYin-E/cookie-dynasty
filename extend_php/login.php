<?php
// Database connection details
$servername = "localhost"; // Your server name
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password (usually empty)
$dbname = "cookie dynasty"; // Make sure this matches your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the data from the request
$username = $_POST['username'];
$password = $_POST['password'];

// Sanitize the input to prevent SQL injection
$username = $conn->real_escape_string($username);

// Create SQL query
$sql = "SELECT password FROM user WHERE username = '$username'";
$result = $conn->query($sql);

// Prepare response array
$response = array();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc(); // Fetch the result as an associative array
    $hashed_password = $row['password'];

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        $response['status'] = 'success'; // Login successful
    } else {
        $response['status'] = 'error'; // Invalid password
        $response['message'] = 'Invalid password.';
    }
} else {
    $response['status'] = 'error'; // No user found
    $response['message'] = 'No user found with that username.';
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the connection
$conn->close();
?>
