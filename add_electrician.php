<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['electricianName']);
    $contact = mysqli_real_escape_string($con, $_POST['electricianContact']);

    // Handle image upload
    $image = '';
    if (isset($_FILES['electricianImage']) && $_FILES['electricianImage']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["electricianImage"]["name"]);
        if (move_uploaded_file($_FILES["electricianImage"]["tmp_name"], $target_file)) {
            $image = $target_file;
        }
    }

    $sql = "INSERT INTO electricians (name, contact, image) VALUES ('$name', '$contact', '$image')";
    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Electrician added successfully!'); window.location.href='http://localhost/local_side/Dummy%20file/admin_panel.php';</script>";
    } else {
        echo "<script>alert('Error adding electrician: " . mysqli_error($con) . "'); window.history.back();</script>";
    }
} else {
    header("Location: /local_side/Dummy%20file/admin_panel.php");
    exit;
}
?>
