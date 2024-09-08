<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "cookie dynasty";

    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];

    // Insert data into database
    $sql = "INSERT INTO subscribe (email)
    VALUES ('$email')";

    if ($conn->query($sql) === TRUE) {


        echo "<script>window.setTimeout(function(){ window.location.href = '../index.html'; }, 1000);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>