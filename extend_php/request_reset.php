<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cookie dynasty";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get username from the request
if (isset($_POST['username'])) {
    $username = $conn->real_escape_string($_POST['username']);
    
    // Check if the user exists
    $sql = "SELECT * FROM user WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Generate a token
        $token = bin2hex(random_bytes(50)); // Generate secure token

        // Store the token in the database
        $sql = "UPDATE user SET reset_token='$token' WHERE username='$username'";
        if ($conn->query($sql) === TRUE) {
            // Create the reset link
            $reset_link = "http://localhost/CookieDynasty/extend_php/reset_password.php?token=$token";

            // Automatically open the reset link
            echo "<script>
                    window.location.href = '$reset_link';
                  </script>";
        } else {
            echo "Error: " . $conn->error;
        }
    } else {
        echo "No user found with that username.";
    }
}

$conn->close();
?>
