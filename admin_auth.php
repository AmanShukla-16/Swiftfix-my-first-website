<?php
session_start();

// Hardcoded admin credentials (OK for now)
$ADMIN_USERNAME = "admin";
$ADMIN_PASSWORD = "admin1234";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: admin_login.php");
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Basic validation
if ($username === '' || $password === '') {
    echo "<script>
        alert('All fields are required');
        window.location.href='admin_login.php';
    </script>";
    exit;
}

// Auth check
if ($username === $ADMIN_USERNAME && $password === $ADMIN_PASSWORD) {

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username']  = $username;

    header("Location: admin_panel.php");
    exit;

} else {

    echo "<script>
        alert('Wrong admin username or password');
        window.location.href='admin_login.php';
    </script>";
    exit;
}
?>
