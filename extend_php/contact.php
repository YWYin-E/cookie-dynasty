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
    $country = $_POST['country'];
    $countrycode = $_POST['countryCode'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];

    // Combine the country code and phone number
    $fullPhoneNumber = $countrycode . $phone;

    // Use a prepared statement to prevent SQL injection
    $sql = "INSERT INTO contacts (firstname, lastname, country, phone, subject)
    VALUES ('$firstname', '$lastname', '$country', '$fullPhoneNumber', '$subject')";

    // Execute the statement

    if ($conn->query($sql) === TRUE) {


        echo "<script>window.setTimeout(function(){ window.location.href = '../index.html'; }, 1000);</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    
    ?>

