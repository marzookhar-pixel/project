<?php
session_start();
include 'db.php';
if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    if(isset($_SESSION['cart'][$product_id])){
        $_SESSION['cart'][$product_id]['quantity'] += 1;
    } else {
        $_SESSION['cart'][$product_id] = [
            "id" => $product_id,
            "name" => $name,
            "price" => $price,
            "quantity" => 1
        ];
    }

    $message = "Product added successfully!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Hishana Enterprises</title>

<style>
    .container {
    padding: 20px;
}

.products {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
}

.product-card {
    border: 1px solid #ddd;
    padding: 15px;
    text-align: center;
    background: #fff;
    border-radius: 8px;
    transition: 0.3s;
}

.product-card:hover {
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transform: scale(1.03);
}

.product-card img {
    width: 150px;
    height: 150px;
    object-fit: cover;
}

.price {
    color: green;
    font-weight: bold;
}

.product-card a {
    text-decoration: none;
    color: black;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: red;
    color: white;
    padding: 15px;
}

header h2 {
    margin: 0;
}

.nav {
    float: right;
}

.nav a {
    color: white;
    text-decoration: none;
    margin-left: 15px;
    font-weight: bold;
}

.nav a:hover {
    text-decoration: underline;
}

.container {
    padding: 20px;
}
</style>

</head>

<body>
<header>
    <h2>Hishana Enterprises - Product Catalogue</h2>

    <div class="nav">
        <a href="cart.php">🛒 Cart 
        (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
        </a>
    </div>
</header>

<div class="container">
    <div class="products">


<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

    <div class="product-card">
    <a href="product_details.php?id=<?php echo $row['id']; ?>">
        <img src="images/<?php echo $row['image']; ?>">
        <h4><?php echo $row['product_name']; ?></h4>
        <p class="price">₹ <?php echo $row['price']; ?></p>
    </a>

    <form method="post" >
    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
    <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>">
    <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
    <button type="submit" name="add_to_cart">Add to Cart</button>
</form>
</div>


<?php
}
?>

</div>


</div>

</body>
</html>
