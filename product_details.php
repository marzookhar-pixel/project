<?php
session_start();
include 'db.php';

$id = intval($_GET['id']);
$sql = "SELECT * FROM products WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if(!$row){
    echo "Product not found";
    exit();
}

echo "<pre>";
print_r($_SESSION['cart']);
echo "</pre>";
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $row['product_name']; ?></title>
</head>
<body>
    <a href="cart.php" style="float:right; text-decoration:none; font-weight:bold;">
    🛒 Cart (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
</a>

<div class="details">
    <img src="images/<?php echo $row['image']; ?>">

    <h2><?php echo $row['product_name']; ?></h2>
    <p>₹ <?php echo $row['price']; ?></p>

    <!-- DESCRIPTION -->
    <p><?php echo $row['description']; ?></p>

    <!-- ADD TO CART BUTTON -->
    <form method="post" action="cart.php">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
<?php if($message != ""){ ?>
    <p style="color:green;"><?php echo $message; ?></p>
    <a href="cart.php" style="background:blue; color:white; padding:10px 20px; text-decoration:none;">
    View Cart
    </a>
<?php
 } 
?>

</div>

</body>
</html>