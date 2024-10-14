<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

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

// Check if the token is set in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Check if the token exists in the database
    $sql = "SELECT * FROM user WHERE reset_token='$token'";
    $result = $conn->query($sql);
    
    // If token is valid
    if ($result->num_rows > 0) {
        // If the new password form is submitted
        if (isset($_POST['new_password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT); // Hash the new password
            
            // Update the password and clear the reset token
            $sql = "UPDATE user SET password='$new_password', reset_token=NULL WHERE reset_token='$token'";
            if ($conn->query($sql) === TRUE) {
                echo "Password has been reset successfully.";
                
                // Redirect to login page after a few seconds
                header("Location: ../extend_html/login.html"); // Adjust the path as needed
                exit(); // Make sure to call exit after header
            } else {
                echo "Error updating password: " . $conn->error;
            }
        } else {
            // If the form is not yet submitted, show the reset password form
            echo '
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Reset Password</title>
                <style>
                    body {
                        font-family: "Lato", sans-serif;
                        background-image: url("../img/admin_background.png");
                        background-color: #C4A484;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                    }

                    .reset-container {
                        background-color: #aaaaaa;
                        padding: 20px;
                        border: 1px solid rgb(104, 96, 0);
                        width: 300px;
                        box-shadow: 0px 0px 13px 2px rgba(0, 0, 0, 0.3);
                        border-radius: 10px;
                    }

                    input[type="password"],
                    button {
                        width: 100%;
                        padding: 10px;
                        margin: 10px 0;
                        border: 1px solid #ccc;
                        box-sizing: border-box;
                    }

                    button {
                        background-color: #4CAF50;
                        color: white;
                        padding: 10px;
                        border: none;
                        cursor: pointer;
                        width: 100%;
                    }

                    button:hover {
                        opacity: 0.8;

                    }
                </style>
            </head>
            <body>
                <div class="reset-container">
                    <h2>Reset Your Password</h2>
                    <form action="" method="POST">
                        <label for="new_password">New Password:</label><br>
                        <input type="password" id="new_password" name="new_password" required><br>
                        <button type="submit">Reset Password</button>
                    </form>
                </div>
            </body>
            </html>
            ';
        }
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}

// Close the database connection
$conn->close();
?>
