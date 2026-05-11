<?php
// Database connection only
$con = mysqli_connect("localhost", "root", "", "service");

if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
