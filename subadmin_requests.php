<?php
$conn = mysqli_connect("localhost", "your_username", "your_password", "service");
?>

<!DOCTYPE html>
<html>
<head>
<title>Sub Admin Requests</title>

<style>
body{
margin:0;
font-family:'Segoe UI',sans-serif;
background:#0f172a;
color:white;
}

.container{
width:80%;
margin:40px auto;
}

h1{
text-align:center;
color:#00e0ff;
margin-bottom:30px;
}

.request-card{
background:#1e293b;
padding:20px;
border-radius:12px;
margin-bottom:20px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 8px 20px rgba(0,0,0,0.4);
}

.user-info{
font-size:16px;
}

.actions a{
text-decoration:none;
padding:8px 14px;
border-radius:6px;
margin-left:10px;
font-weight:bold;
}

.accept{
background:#00e0ff;
color:black;
}

.delete{
background:#ef4444;
color:white;
}

.actions a:hover{
opacity:0.85;
}
</style>
</head>

<body>

<div class="container">

<h1>Sub Admin Requests</h1>

<?php

$result = mysqli_query($conn,"SELECT * FROM subadmin_requests");

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

?>

<div class="request-card">

<div class="user-info">
<strong><?php echo $row['name']; ?></strong><br>
<?php echo $row['email']; ?>
</div>

<div class="actions">
<a class="accept" href="accept_subadmin.php?id=<?php echo $row['id']; ?>">Accept</a>
<a class="delete" href="delete_subadmin.php?id=<?php echo $row['id']; ?>">Delete</a>
</div>

</div>

<?php
}

}else{
echo "<p style='text-align:center;'>No requests found</p>";
}

?>

</div>

</body>
</html>
