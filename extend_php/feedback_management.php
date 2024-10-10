<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Management</title>
    <link rel="stylesheet" href="../admin.css">
</head>
<body>
    <h2>Feedback Management</h2>
    <a href="../extend_html/admin.html"><button class="back" onclick="document.location='../extend_html/admin.html'">Back</button></a>
    <table>
        <tr>
            <th>No.</th>
            <th>FirstName</th>
            <th>LastName</th>
            <th>Email</th>
            <th>Rating</th>
            <th>Feedback</th>
 
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

        $sql = "SELECT firstname, lastname, email, rating, feedback FROM feedback";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }
        $serialNumber = 1;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$serialNumber."</td>";
                echo "<td>".$row["firstname"]."</td>";
                echo "<td>".$row["lastname"]."</td>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["rating"]."</td>";
                echo "<td>".$row["feedback"]."</td>";
                echo "</tr>";
                $serialNumber++;
            }
        } else {
            echo "<tr><td colspan='8'>No feedback found</td></tr>";
        }
        $conn->close();
    ?>
    </table>
</body>
</html>