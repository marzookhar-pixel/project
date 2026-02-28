<?php
session_start();
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// DELETE PRODUCT
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id='$id'");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Products</title>
</head>

<body>

<h2>Manage Products</h2>

<table border="1" cellpadding="10">
<tr>
<th>ID</th>
<th>Name</th>
<th>Price</th>
<th>Stock</th>
<th>Action</th>
</tr>

<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['product_name']."</td>";
    echo "<td>".$row['price']."</td>";
    echo "<td>".$row['stock']."</td>";
    echo "<td>
    <a href='edit_product.php?id=".$row['id']."'>Edit</a> |
    <a href='manage_products.php?delete=".$row['id']."'>Delete</a>
    </td>";
    echo "</tr>";
}
?>

</table>

<br>
<a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
