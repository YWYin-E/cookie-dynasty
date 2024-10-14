<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <h2>Orders Management</h2>
    <a href="../extend_html/admin.html"><button class="back" onclick="document.location='../extend_html/admin.html'">Back</button></a>
    <table>
        <tr>
            <th>No.</th>
            <th>ProductTitle</th>
            <th>Productprice</th>
            <th>ProductImg</th>
            <th>ProductWeight</th>
            <th>ProductColor</th>
 
        </tr>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cookie dynasty";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT product_title, product_price, product_img, product_weight, product_color FROM orders";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $serialNumber = 1;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$serialNumber."</td>";
                echo "<td>".$row["product_title"]."</td>";
                echo "<td>".$row["product_price"]."</td>";
                echo "<td><img src='".$row["product_img"]."' alt='Product Image' width='100'></td>";

                echo "<td>".$row["product_weight"]."</td>";
                echo "<td>".$row["product_color"]."</td>";
                echo "</tr>";
                $serialNumber++;
            }
        } else {
            echo "<tr><td colspan='8'>No orders found</td></tr>";
        }
        $conn->close();
    ?>
    </table>
</body>
</html>