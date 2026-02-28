<?php
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT orders.*, products.product_name 
        FROM orders 
        JOIN products ON orders.product_id = products.id
        WHERE orders.id='$id'";

$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<title>Bill</title>
</head>

<body>

<h2>Invoice / Bill</h2>

<p><b>Customer Name:</b> <?php echo $row['customer_name']; ?></p>
<p><b>Product:</b> <?php echo $row['product_name']; ?></p>
<p><b>Quantity:</b> <?php echo $row['quantity']; ?></p>
<p><b>Total Price:</b> ₹<?php echo $row['total_price']; ?></p>
<p><b>Status:</b> <?php echo $row['order_status']; ?></p>

<br>
<a href="manage_orders.php">Back</a>

</body>
</html>
