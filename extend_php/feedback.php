<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cookie dynasty";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $feedback = $_POST['feedback'];

    // Combine the country code and phone number

    // Use a prepared statement to prevent SQL injection
    $sql = "INSERT INTO feedback (firstname, lastname, email, rating, feedback)
    VALUES ('$firstname', '$lastname', '$email', '$rating', '$feedback')";

    // Execute the statement

    if ($conn->query($sql) === TRUE) {

        echo "<script>window.setTimeout(function(){ window.location.href = '../index.html'; }, 1000);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    
    ?>

