<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// DB connection
$con = new mysqli('localhost','root','','service');
if ($con->connect_error) die("Connection failed: ".$con->connect_error);

// Get POST data
$username = trim($_POST['username']);
$email    = trim($_POST['email']);
$password = $_POST['password'];
$confirm  = $_POST['confirm_password'];

// Check password match
if ($password !== $confirm) {
    echo "<script>alert('Passwords do not match'); window.history.back();</script>";
    exit();
}

// Check duplicate username/email
$stmt = $con->prepare("SELECT username FROM register2 WHERE username=? OR email=?");
$stmt->bind_param("ss",$username,$email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo "<script>alert('Username or email already exists'); window.history.back();</script>";
    exit();
}
$stmt->close();

// Insert user
$stmt = $con->prepare("INSERT INTO register2 (username,email,password) VALUES (?,?,?)");
$stmt->bind_param("sss",$username,$email,$password);
if ($stmt->execute()) {
    echo "<script>alert('Registration successful'); window.location.href='login.html';</script>";
} else {
    echo "Error: ".$stmt->error;
}
$stmt->close();
$con->close();
?>
