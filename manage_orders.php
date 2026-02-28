<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// Update order status
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn->query("UPDATE orders SET order_status='Processed' WHERE id='$id'");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Orders</title>
</head>

<body>

<h2>Customer Orders</h2>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Customer</th>
<th>Product ID</th>
<th>Quantity</th>
<th>Total Price</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['customer_name']."</td>";
    echo "<td>".$row['product_id']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['total_price']."</td>";
    echo "<td>".$row['order_status']."</td>";
    echo "<td><a href='manage_orders.php?id=".$row['id']."'>Process</a></td>";
    echo "<td>
<a href='manage_orders.php?id=".$row['id']."'>Process</a> |
<a href='bill.php?id=".$row['id']."'>View Bill</a>
</td>";

    echo "</tr>";
}
?>

</table>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
