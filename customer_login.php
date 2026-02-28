<?php
session_start();
include 'db.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customers 
            WHERE email='$email' AND password='$password'";

    $result = $conn->query($sql);

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        $_SESSION['customer'] = $row['name']; // store name
        $_SESSION['email'] = $row['email'];       // store email

        header("Location: dashboard.php");
exit();

    } else {
        echo "Invalid Login";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Customer Login</title>

<style>

   body {
    margin: 0;
    padding: 0;
    background: url('/hishana_project/images/project.jpeg') no-repeat center center fixed;
    background-size: cover;
    height: 100vh;
    font-family: Arial, sans-serif;
}



form {
    background: rgba(90, 86, 86, 0.85);
    padding: 20px;
    width: 300px;
    margin: 100px auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.3);
}

h2 {
    text-align: center;
    color: black;
    font-size: 38px;
    font-weight: 700;
    letter-spacing: 2px;
    margin-top: 60px;
    text-transform: uppercase;
    text-shadow: 2px 2px 8px rgba(0,0,0,0.6);
}

</style>

</head>

<body>

<h2>Hisahana Enterprises</h2>

<form method="POST">

Email:<br>
<input type="email" name="email" required><br><br>

Password:<br>
<input type="password" name="password" required><br><br>

<button type="submit" name="login">Login</button>

</form>

</body>
</html>
