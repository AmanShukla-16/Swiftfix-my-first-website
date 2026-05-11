<?php

$conn = mysqli_connect("localhost","root","","service");

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO subadmin_requests(name,email,password)
VALUES('$name','$email','$password')";

mysqli_query($conn,$query);

echo "Request sent to Admin";

?>