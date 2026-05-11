<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$con = new mysqli('localhost','root','','service');
if ($con->connect_error) die("Connection failed: ".$con->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (!$email) {
        echo "<script>alert('Enter your email'); window.history.back();</script>";
        exit();
    }

    $stmt = $con->prepare("SELECT username FROM register2 WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $_SESSION['reset_email'] = $email;
        header("Location: new_password.php");
        exit();
    } else {
        echo "<script>alert('Email not found'); window.history.back();</script>";
        exit();
    }
}
?>
