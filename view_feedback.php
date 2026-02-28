<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>View Feedback</title>
</head>

<body>

<h2>Customer Feedback</h2>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Name</th>
<th>Message</th>
<th>Rating</th>
</tr>

<?php
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['customer_name']."</td>";
    echo "<td>".$row['message']."</td>";
    echo "<td>".$row['rating']."</td>";
    echo "</tr>";
}
?>

</table>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
