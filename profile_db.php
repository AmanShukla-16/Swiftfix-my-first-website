<?php
// profile_db.php
$profile_con = mysqli_connect('localhost','root','','service'); // your DB
if (!$profile_con) {
    die("Profile DB Connection failed: " . mysqli_connect_error());
}
?>
