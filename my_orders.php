<?php
session_start();
include "db_connect.php";   // your database connection file

// check login
if(!isset($_SESSION['email'])){
    header("Location: customer_login.php");
    exit();
}

$email = $_SESSION['email'];

// get only this customer's orders
$sql = "SELECT * FROM orders WHERE email='$email'";
$result = mysqli_query($conn,$sql);
?>

<h2>My Orders</h2>

<table border="1" cellpadding="10">
<tr>
    <th>Order ID</th>
    <th>Product</th>
    <th>Quantity</th>
    <th>Status</th>
</tr>

<?php
while($row = mysqli_fetch_assoc($result)){
    echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['product_name']."</td>
        <td>".$row['quantity']."</td>
        <td>".$row['status']."</td>
    </tr>";
}
?>

</table>

<br>
<a href="index.php">Back to Home</a>
