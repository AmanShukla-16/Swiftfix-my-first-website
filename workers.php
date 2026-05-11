<?php

$conn = new mysqli("localhost","root","","service");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$service = $_POST['service'];
$contact = $_POST['contact'];

$sql = "INSERT INTO workers (name,service,contact) 
VALUES ('$name','$service','$contact')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
    alert('Worker Added Successfully');
    window.location.href='staff_dashboard.php';
    </script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>