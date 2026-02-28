<?php
session_start();
include 'db.php';

$customer_name = $_SESSION['customer'];

$stmt = $conn->prepare("
    SELECT orders.*, products.product_name, products.image 
    FROM orders
    LEFT JOIN products ON orders.product_id = products.id
    WHERE orders.customer_name = ?
    ORDER BY orders.id DESC
");

$stmt->bind_param("s", $customer_name);
$stmt->execute();
$result = $stmt->get_result();
if(!$result){
    die("Query Failed: " . $conn->error);
}
?>
<style>
body {
    background: #f1f3f6;
    font-family: Arial;
}

.order-card {
    display: flex;
    background: #fff;
    padding: 15px;
    margin-bottom: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.order-card img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    margin-right: 20px;
}

.status {
    font-weight: bold;
}
</style>
<h2>Your Orders</h2>
<?php
if($result->num_rows == 0){
    echo "<p>No orders found.</p>";
}
?>
<?php
 while($row = $result->fetch_assoc()) { ?>
    <div class="order-card">
        <img src="images/<?php echo $row['image']; ?>" alt="Product">

        <div>
            <h3><?php echo $row['product_name']; ?></h3>
            <p>Order ID: <?php echo $row['id']; ?></p>
            <p>₹ <?php echo $row['total_amount']; ?></p>
            <p>Date: <?php echo $row['order_date']; ?></p>
            <p class="status">Status: <?php echo $row['order_status']; ?></p>
        </div>
    </div>
<?php } ?>