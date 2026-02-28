<?php
session_start();

/* INCREASE QUANTITY */
if(isset($_GET['increase'])){
    $id = $_GET['increase'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity'] += 1;
    }

    header("Location: cart.php");
    exit();
}

/* DECREASE QUANTITY */
if(isset($_GET['decrease'])){
    $id = $_GET['decrease'];

    if(isset($_SESSION['cart'][$id])){

        $_SESSION['cart'][$id]['quantity'] -= 1;

        // If quantity becomes 0 → remove item
        if($_SESSION['cart'][$id]['quantity'] <= 0){
            unset($_SESSION['cart'][$id]);
        }
    }
    header("Location: cart.php");
exit();

    
}
// REMOVE ITEM
if(isset($_GET['remove'])){
    $product_id = $_GET['remove'];

    if(isset($_SESSION['cart'][$product_id])){
        unset($_SESSION['cart'][$product_id]);
    }

    header("Location: cart.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Your Cart</title>
</head>
<body>

<h2>Your Cart</h2>
<?php if(isset($message)) 
    { 
        ?>
    <p style="color:green; text-align:center;">
        <?php
         echo $message;
          ?>
    </p>
<?php 
}
 ?>
<style>
body{
    font-family: Arial, sans-serif;
    background:#f1f3f6;
}

.cart-container{
    width: 80%;
    margin: 30px auto;
    display: flex;
    gap: 20px;
}

.cart-items{
    flex: 3;
}

.cart-card{
    background:white;
    padding:20px;
    margin-bottom:15px;
    display:flex;
    align-items:center;
    border-radius:6px;
}

.cart-card img{
    width:120px;
    height:120px;
    object-fit:cover;
    margin-right:20px;
}

.item-details{
    flex:2;
}

.quantity-box a{
    padding:5px 10px;
    background:#2874f0;
    color:white;
    text-decoration:none;
    margin:0 5px;
    border-radius:4px;
}

.remove-btn{
    color:red;
    text-decoration:none;
}

.price-box{
    font-weight:bold;
    font-size:18px;
}

.summary{
    flex:1;
    background:white;
    padding:20px;
    border-radius:6px;
    height: fit-content;
}
</style>
<div class="cart-container">

<div class="cart-items">

<?php
$total = 0;

if(!empty($_SESSION['cart'])){

    foreach($_SESSION['cart'] as $value){

        $subtotal = $value['price'] * $value['quantity'];
        $total += $subtotal;
?>

<div class="cart-card">

    <div class="item-details">
        <h3><?php echo $value['name']; ?></h3>
        <p>₹ <?php echo $value['price']; ?></p>

        <div class="quantity-box">
            <a href="cart.php?decrease=<?php echo $value['id']; ?>">−</a>
            <?php echo $value['quantity']; ?>
            <a href="cart.php?increase=<?php echo $value['id']; ?>">+</a>
        </div>

        <br>
        <a class="remove-btn"
           href="cart.php?remove=<?php echo $value['id']; ?>">
           Remove
        </a>
    </div>

    <div class="price-box">
        ₹ <?php echo $subtotal; ?>
    </div>

</div>

<?php
    } // END FOREACH
?>

</div>

<!-- PRICE SUMMARY (OUTSIDE LOOP) -->
<div class="summary">
    <h3>Price Details</h3>
    <hr>
    <p>Total Amount: ₹ <?php echo $total; ?></p>
    <hr>
    <a href="checkout.php"
   style="background:#fb641b; color:white; padding:10px 15px; text-decoration:none; display:block; text-align:center; border-radius:4px;">
   PLACE ORDER
</a>
</div>

</div>

<?php
}else{
    echo "<p style='text-align:center;'>Your cart is empty!</p>";
}
?>

</div>

</body>
</html>
