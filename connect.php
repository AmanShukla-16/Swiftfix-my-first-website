<?php
// Database Connection

$con = mysqli_connect("localhost", "your_username", "your_password", "service");

if (!$con) {
    die("Connection Failed");
}
?>
