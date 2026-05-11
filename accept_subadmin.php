<?php

$conn = mysqli_connect("localhost","root","","service");

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM subadmin_requests WHERE id=$id");
$row = mysqli_fetch_assoc($result);

$name = $row['name'];
$email = $row['email'];
$password = $row['password'];

mysqli_query($conn,"INSERT INTO staff(name,email,password)
VALUES('$name','$email','$password')");

mysqli_query($conn,"DELETE FROM subadmin_requests WHERE id=$id");

header("Location: subadmin_requests.php");

?>