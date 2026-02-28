<?php
include 'db.php';

if(isset($_POST['submit'])){

    $name = $_POST['customer_name'];
    $message = $_POST['message'];
    $rating = $_POST['rating'];

    $sql = "INSERT INTO feedback(customer_name,message,rating)
            VALUES('$name','$message','$rating')";

    if($conn->query($sql)==TRUE){
        echo "Feedback Submitted Successfully";
    } else {
        echo "Error";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Customer Feedback</title>
</head>

<body>

<h2>Give Your Feedback</h2>

<form method="POST">

Name:<br>
<input type="text" name="customer_name" required><br><br>

Message:<br>
<textarea name="message"></textarea><br><br>

Rating (1-5):<br>
<input type="number" name="rating" min="1" max="5" required><br><br>

<button type="submit" name="submit">Submit Feedback</button>

</form>

</body>
</html>

