<?php
session_start();
include 'db.php';

if(isset($_POST['submit'])){

    $name = $_POST['product_name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Image Upload
    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp_name,"images/".$image);

    $sql = "INSERT INTO products(product_name,description,price,image,stock)
            VALUES('$name','$desc','$price','$image','$stock')";

    if($conn->query($sql)==TRUE){
        echo "Product Added Successfully";
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>
</head>

<body>

<h2>Add Product</h2>

<form method="POST" enctype="multipart/form-data">
Product Name:<br>
<input type="text" name="product_name" required><br><br>

Description:<br>
<textarea name="description"></textarea><br><br>

Price:<br>
<input type="number" name="price" required><br><br>

Stock:<br>
<input type="number" name="stock" required><br><br>

Product Image:<br>
<input type="file" name="image" required><br><br>

<button type="submit" name="submit">Add Product</button>
</form>


</body>
</html>
