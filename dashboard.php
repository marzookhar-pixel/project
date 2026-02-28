
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
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            "id"=>$product_id,
            "name"=>$name,
            "price"=>$price,
            "quantity"=>1
        ];
    }

    $message = "✅ Product added to cart!";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard - Hishana Enterprises</title>

<style>
body {
    margin: 0;
    font-family: Arial;
}

.sidebar {
    width: 220px;
    height: 100vh;
    background: #2c3e50;
    position: fixed;
    padding-top: 20px;
}

.sidebar a {
    display: block;
    color: white;
    padding: 12px;
    text-decoration: none;
}

.sidebar a:hover {
    background: #34495e;
}

.content {
    
    margin-left: 220px;
    padding: 20px;
    
}

.products{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:20px;
    margin-top:20px;
}

.product-card{
    background:white;
    border:1px solid #ddd;
    border-radius:8px;
    padding:15px;
    text-align:center;
    transition:0.3s;
}

.product-card:hover{
    box-shadow:0 4px 12px rgba(0,0,0,0.2);
    transform:scale(1.03);
}

.product-card img{
    width:150px;
    height:150px;
    object-fit:cover;
}

.price{
    color:green;
    font-weight:bold;
    margin:10px 0;
}

.product-card button{
    background:#2874f0;
    color:white;
    border:none;
    padding:8px 15px;
    border-radius:5px;
    cursor:pointer;
}

.product-card button:hover{
    background:#0b5ed7;
}
.topbar{
    background:#2874f0;
    color:white;
    padding:15px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.logo{
    margin:0;
}

.nav-right a{
    color:white;
    text-decoration:none;
    font-weight:bold;
    margin-left:20px;
}

.cart{
    background:yellow;
    color:black;
    padding:6px 12px;
    border-radius:5px;
}
.success{
    background:#d4edda;
    color:#155724;
    padding:10px;
    margin-bottom:15px;
    border-radius:5px;
}
</style>

</head>

<body>
    <header class="topbar">

    <h2 class="logo">Hishana Enterprises</h2>

    <div class="nav-right">
        Welcome <?php echo $_SESSION['customer'] ?? 'Guest'; ?>

        <a href="cart.php" class="cart">
            🛒 Cart
            (<?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>)
        </a>
    </div>

</header>

<div class="sidebar">
    <h3 style="color:white; text-align:center;">Dashboard</h3>
    <h4 style="color:white;padding-left:12px;">Categories</h4>

<a href="dashboard.php">🛍 All Products</a>
<a href="dashboard.php?category=pan">🍳 Pans</a>
<a href="dashboard.php?category=tawa">🔥 Tawa</a>
<a href="dashboard.php?category=machine">🥤 Juice Machine</a>
<a href="dashboard.php?category=ladder">ladder</a>
<a href="dashboard.php?category=biryani pot">biryani pot</a>


    <a href="dashboard.php">🏠 Home</a>
    <a href="order_history.php">📦 Order History</a>
    <a href="products.php">🛍 Products</a>
    <a href="about.php">ℹ About Us</a>
    <a href="customer_care.php">☎ Customer Care</a>
    <a href="logout.php">🚪 Logout</a>
</div>
<div class="content">

<h2>Welcome <?php echo $_SESSION['customer'] ?? 'Guest'; ?></h2>

<!-- ✅ PRODUCT GRID START -->
<div class="products">

<?php
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()){
?>

<div class="product-card">

    <img src="images/<?php echo $row['image']; ?>">
    <h4><?php echo $row['product_name']; ?></h4>
    <p class="price">₹ <?php echo $row['price']; ?></p>

    <form method="post">
        <input type="hidden" name="product_id"
        value="<?php echo $row['id']; ?>">

        <input type="hidden" name="product_name"
        value="<?php echo $row['product_name']; ?>">

        <input type="hidden" name="price"
        value="<?php echo $row['price']; ?>">

        <button type="submit" name="add_to_cart">
            Add to Cart
        </button>
    </form>

</div>

<?php } ?>

</div>
<!-- ✅ PRODUCT GRID END -->

</div>
</button>
</form>

</div>



</div>


</body>
</html>