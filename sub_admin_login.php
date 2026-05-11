<?php
session_start();

$conn = new mysqli("localhost","root","","service");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM staff WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $_SESSION['staff_logged_in'] = true;
    $_SESSION['staff_email'] = $email;

    header("Location: stuff_dashboard.php");
    exit();

} else {

    echo "<script>
    alert('Invalid Login Details');
    window.location.href='sub_admin_login.html';
    </script>";

}

$conn->close();
?>