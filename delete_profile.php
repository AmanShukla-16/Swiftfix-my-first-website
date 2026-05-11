<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

include 'connect.php';

if (isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']);

    $table = '';
    switch ($type) {
        case 'users':
            $table = 'users';
            break;
        case 'plumbers':
            $table = 'plumbers';
            break;
        case 'cleaners':
            $table = 'cleaners';
            break;
        case 'electricians':
            $table = 'electricians';
            break;
        default:
            echo "Invalid type.";
            exit;
    }

    $sql = "DELETE FROM $table WHERE id = $id";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Profile deleted successfully.'); window.location.href='admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error deleting profile.'); window.location.href='http://localhost/local_side/Dummy%20file/admin_panel.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request.'); window.location.href='http://localhost/local_side/Dummy%20file/admin_panel.php';</script>";
}
?>
