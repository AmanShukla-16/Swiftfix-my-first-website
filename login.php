<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // If accessed directly, go back to login page
    header("Location: login.html");
    exit();
}

// Database connection
$con = new mysqli('localhost', 'root', '', 'service');
if ($con->connect_error) die("Connection failed: " . $con->connect_error);

// Get input
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
    echo "<script>alert('Please enter both username and password'); window.history.back();</script>";
    exit();
}

// Check if username exists
$stmt = $con->prepare("SELECT password FROM register2 WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    // Username not found
    echo "<script>alert('Username not found'); window.history.back();</script>";
    $stmt->close();
    $con->close();
    exit();
}

// Fetch password from DB
$stmt->bind_result($db_password);
$stmt->fetch();

// Check plain password
if ($password === $db_password) {
    $_SESSION['user_logged_in'] = true;
    $_SESSION['username'] = $username;
    header("Location: main.html");
    exit();
} else {
    echo "<script>alert('Incorrect password'); window.history.back();</script>";
    $stmt->close();
    $con->close();
    exit();
}

$stmt->close();
$con->close();
?>
