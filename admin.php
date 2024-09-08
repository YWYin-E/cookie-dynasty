<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <h2>Payments Management</h2>
    <a href="index.html">Back</a>
    <table>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Card Number</th>
            <th>Expiry Month</th>
            <th>Expiry Year</th>
            <th>CVV</th>
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "nikestore";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT name, phone, address, card_number, expiry_month, expiry_year, cvv FROM payments";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $serialNumber = 1;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$serialNumber."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["phone"]."</td>";
                echo "<td>".$row["address"]."</td>";
                echo "<td>".$row["card_number"]."</td>";
                echo "<td>".$row["expiry_month"]."</td>";
                echo "<td>".$row["expiry_year"]."</td>";
                echo "<td>".$row["cvv"]."</td>";
                echo "</tr>";
                $serialNumber++;
            }
        } else {
            echo "<tr><td colspan='8'>No payments found</td></tr>";
        }
        $conn->close();
    ?>
    </table>
</body>
</html>