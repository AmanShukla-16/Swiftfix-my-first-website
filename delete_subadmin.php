<?php

$conn = mysqli_connect("localhost","root","","service");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM subadmin_requests WHERE id=$id");

header("Location: subadmin_requests.php");

?>