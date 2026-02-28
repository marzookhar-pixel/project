
<?php
session_start();
include 'db.php';

/* ADD TO CART */
if(isset($_POST['add_to_cart'])){

    $product_id = $_POST['product_id'];
    $name = $_POST['product_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

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

    /* RETURN TO SAME CATEGORY */
    header("Location: products.php?category=".$category);
    exit();
}
?>
<a href="cart.php">
🛒 Cart (
<?php
echo isset($_SESSION['cart'])
? array_sum(array_column($_SESSION['cart'],'quantity'))
: 0;
?>
)
</a>
<h2>Products</h2>

<a href="products.php?category=All">All</a>
<a href="products.php?category=Pan">Pan</a> |
<a href="products.php?category=ladder">ladder</a> |
<a href="products.php?category=Stove">Stove</a>

<hr>

<div style="display:grid; grid-template-columns: repeat(4,1fr); gap:20px;">
<?php while($row = $result->fetch_assoc()) { ?>

<div style="
border:1px solid #ddd;
padding:15px;
border-radius:8px;
background:#fff;
text-align:center;
box-shadow:0 2px 8px rgba(0,0,0,0.1);
">

    <img src="images/<?php echo $row['image']; ?>"
         style="width:150px;height:150px;object-fit:cover;">

    <h3><?php echo $row['product_name']; ?></h3>

    <p style="color:green;font-weight:bold;">
        ₹ <?php echo $row['price']; ?>
    </p>

    <!-- ADD TO CART BUTTON -->
    <form action="checkout.php" method="POST">
    
    <input type="hidden"
           name="product_id"
           value="<?php echo $row['id']; ?>">

    <button type="submit"
    style="
    background:#ff9f00;
    color:white;
    border:none;
    padding:10px;
    border-radius:5px;
    cursor:pointer;">
        Add to Cart
    </button>

</form>
<?php } ?>

</div>