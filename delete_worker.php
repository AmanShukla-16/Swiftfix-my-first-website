<?php
session_start();

if(!isset($_SESSION['stuff_logged_in'])){
header("Location: sub_admin_login.html");
exit;
}

$conn = new mysqli("localhost","root","","service");

$id = $_GET['id'];

$conn->query("DELETE FROM workers WHERE id=$id");

header("Location: stuff_dashboard.php");
exit;
?>