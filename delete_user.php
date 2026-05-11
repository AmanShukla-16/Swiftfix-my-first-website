<?php
session_start();

if(!isset($_SESSION['stuff_logged_in'])){
header("Location: sub_admin_login.html");
exit;
}

$conn = new mysqli("localhost", "your_username", "your_password", "service");

$id = $_GET['email'];

$conn->query("DELETE FROM register2 WHERE email=$id");

header("Location: stuff_dashboard.php");
exit;
?>
