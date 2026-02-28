<?php
session_start();

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
</head>

<body>

<h2>Welcome Admin</h2>

<a href="add_product.php">Add Product</a><br><br>
<a href="manage_products.php">Manage Products</a><br><br>
<a href="manage_orders.php">Manage Orders</a><br><br>
<a href="view_feedback.php">View Feedback</a><br><br>
<a href="logout.php">Logout</a>

</body>
</html>
