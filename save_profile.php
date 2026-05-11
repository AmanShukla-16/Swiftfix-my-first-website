<?php
session_start();
include 'profile_db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$dob = $_POST['dob'] ?? '';
$photo_name = '';

// Handle photo upload
if (!empty($_FILES['photo']['name'])) {
    $photo = $_FILES['photo'];
    $ext = pathinfo($photo['name'], PATHINFO_EXTENSION);
    $photo_name = $username . '_' . time() . '.' . $ext; // unique name
    move_uploaded_file($photo['tmp_name'], 'uploads/' . $photo_name);
}

// Check if profile exists
$stmt = $profile_con->prepare("SELECT username, photo FROM profile WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    // Update existing profile
    if ($photo_name) {
        $update = $profile_con->prepare("UPDATE profile SET date_of_birth=?, photo=? WHERE username=?");
        $update->bind_param("sss", $dob, $photo_name, $username);
    } else {
        $update = $profile_con->prepare("UPDATE profile SET date_of_birth=? WHERE username=?");
        $update->bind_param("ss", $dob, $username);
    }
    $update->execute();
    $update->close();
} else {
    // Insert new profile
    $insert = $profile_con->prepare("INSERT INTO profile(username, date_of_birth, photo) VALUES(?,?,?)");
    $insert->bind_param("sss", $username, $dob, $photo_name);
    $insert->execute();
    $insert->close();
}

$stmt->close();

header("Location: profile.php");
exit();
?>
