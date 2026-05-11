<?php

$conn = new mysqli("localhost","root","","service");

if($conn->connect_error){
die("Connection failed: ".$conn->connect_error);
}

$name = $_POST['name'];
$service = $_POST['service'];
$contact = $_POST['contact'];

$image = $_FILES['image']['name'];
$temp = $_FILES['image']['tmp_name'];

move_uploaded_file($temp,"uploads/".$image);

$sql = "INSERT INTO workers (name,service,contact,image)
VALUES ('$name','$service','$contact','$image')";

if($conn->query($sql) === TRUE){
echo "<script>
alert('Worker Added Successfully');
window.location='stuff_dashboard.php';
</script>";
}else{
echo "Error: ".$conn->error;
}

$conn->close();

?>