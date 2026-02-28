<?php
include 'db.php';

if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert into customers table
    $sql = "INSERT INTO customers(name,email,password)
            VALUES('$name','$email','$password')";

    if($conn->query($sql)==TRUE){
        echo "Registration Successful";
    } else {
    echo "Error: " . $conn->error;
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Customer Registration</title>
</head>

<body>

<h2>Customer Registration</h2>

<form method="POST">

Name:<br>
<input type="text" name="name" required><br><br>

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="register">Register</button>

</form>

</body>
</html>
