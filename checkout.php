<?php
session_start();
include 'db.php';

if(isset($_POST['product_id'])){

    $product_id = $_POST['product_id'];

    // create cart session
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    if(isset($_POST['product_id'])){

    $product_id = $_POST['product_id'];

    // get product from database
    $stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
    $stmt->bind_param("i",$product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = [];
    }

    // check if already in cart
    if(isset($_SESSION['cart'][$product_id])){
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {

        $_SESSION['cart'][$product_id] = [
            'id' => $product['id'],
            'name' => $product['product_name'],
            'price' => $product['price'],
            'quantity' => 1
        ];
    }
}
}


if(!isset($_SESSION['customer'])){
    header("Location: customer_login.php");
    exit();
}

if(empty($_SESSION['cart'])){
    echo "Your cart is empty!";
    exit();
}

$customer = $_SESSION['customer'];

/* CALCULATE TOTAL */
$total = 0;
foreach($_SESSION['cart'] as $item){
    $total += $item['price'] * $item['quantity'];
}

/* PLACE ORDER */
if(isset($_POST['place_order'])){

    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';

    if(empty($address) || empty($phone)){
        echo "Please fill all fields!";
        exit();
    }

    if(!preg_match('/^[0-9]{10}$/', $phone)){
        echo "<p style='color:red;'>Invalid phone number!</p>";
        exit();
    }

    /* INSERT ORDER */
    $stmt = $conn->prepare("
        INSERT INTO orders
        (customer_name, total_amount, order_status, address, phone)
        VALUES (?, ?, 'Processing', ?, ?)
    ");

    $stmt->bind_param("sdss",
        $customer,
        $total,
        $address,
        $phone
    );

    $stmt->execute();

    $order_id = $conn->insert_id;

    /* INSERT ORDER ITEMS */
    foreach($_SESSION['cart'] as $item){

        $product_id = $item['id'];
        $quantity = $item['quantity'];
        $price = $item['price'];

        $stmt2 = $conn->prepare("
            INSERT INTO order_items
            (order_id, product_id, quantity, price)
            VALUES (?, ?, ?, ?)
        ");

        $stmt2->bind_param(
            "iiid",
            $order_id,
            $product_id,
            $quantity,
            $price
        );

        $stmt2->execute();
    }

    /* CLEAR CART */
    unset($_SESSION['cart']);
?>
    
<h2 style="text-align:center;">🎉 Order Placed Successfully!</h2>
<p style="text-align:center;">
Thank you, <b><?php echo $customer; ?></b>
</p>

<div style="text-align:center;">
<a href="dashboard.php"
style="background:#2874f0;color:white;
padding:10px 20px;text-decoration:none;border-radius:5px;">
Continue Shopping
</a>
</div>

<?php
exit();
}
?>
<h2>Your Cart</h2>

<table border="1" cellpadding="10">
<tr>
<th>Product</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
</tr>

<?php foreach($_SESSION['cart'] as $item){ ?>

<tr>
<td><?php echo $item['name']; ?></td>
<td>₹ <?php echo $item['price']; ?></td>
<td><?php echo $item['quantity']; ?></td>
<td>₹ <?php echo $item['price']*$item['quantity']; ?></td>
</tr>

<?php } ?>

</table>

<h3>Total Amount: ₹ <?php echo $total; ?></h3>
<h2>Shipping Details</h2>

<p><strong>Customer:</strong> <?php echo $customer; ?></p>

<form method="POST">
Address:<br>
<textarea name="address" required></textarea><br><br>

Phone:<br>
<input type="text" name="phone" required><br><br>

<button type="submit" name="place_order">
Confirm Order
</button>
</form>