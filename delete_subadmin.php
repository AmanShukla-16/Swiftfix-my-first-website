<?php

$con = mysqli_connect("localhost", "your_username", "your_password", "service");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM subadmin_requests WHERE id=$id");

header("Location: subadmin_requests.php");

?>
