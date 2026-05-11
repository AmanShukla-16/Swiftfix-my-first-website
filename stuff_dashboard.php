<?php
session_start();
if(!isset($_SESSION['staff_logged_in'])){
header("Location: sub_admin_login.html");
exit;
}

$conn = new mysqli("localhost","root","","service");
?>

<!DOCTYPE html>
<html>
<head>
<title>Staff Dashboard</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#0f172a;
color:white;
display:flex;
}

.sidebar{
width:230px;
background:#111827;
height:100vh;
padding:25px;
}

.sidebar h2{
color:#00e0ff;
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
color:#ddd;
padding:10px;
text-decoration:none;
border-radius:8px;
margin-bottom:10px;
}

.sidebar a:hover{
background:#1f2937;
color:#00e0ff;
}

.main{
flex:1;
padding:40px;
}

.card{
background:#1e293b;
padding:25px;
border-radius:12px;
margin-bottom:30px;
}

.card h3{
color:#00e0ff;
margin-bottom:15px;
}

input,select{
width:100%;
padding:10px;
margin-bottom:10px;
border:none;
border-radius:6px;
background:#0f172a;
color:white;
}

button{
padding:8px 12px;
background:#00e0ff;
border:none;
border-radius:6px;
cursor:pointer;
}

.delete{
background:#ff4d4d;
}

table{
width:100%;
border-collapse:collapse;
}

table th,table td{
padding:10px;
border-bottom:1px solid #333;
}
</style>
</head>

<body>

<div class="sidebar">

<h2>SwiftFix</h2>

<a href="#">Dashboard</a>
<a href="#users">Users</a>
<a href="#clients">Clients</a>
<a href="logout.php">Logout</a>

</div>

<div class="main">

<h1>Staff Dashboard</h1>

<!-- ADD CLIENT -->

<div class="card">

<h3>Add Client</h3>

<form action="add_client.php" method="post" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Client Name" required>

<select name="service" required>
<option value="plumber">Plumber</option>
<option value="cleaner">Cleaner</option>
<option value="electrician">Electrician</option>
</select>

<input type="text" name="contact" placeholder="Contact Number" required>

<input type="file" name="image" required>

<button type="submit">Add Client</button>

</form>

</div>


<!-- USERS -->

<div class="card" id="users">

<h3>Registered Users</h3>

<table>

<tr>
<th>Name</th>
<th>Email</th>
<th>Action</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM register2");

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['username']."</td>";

echo "<td>".$row['email']."</td>";

echo "<td>
<a href='delete_user.php?email=".$row['email']."' 
onclick=\"return confirm('Are you sure you want to delete this user?');\">
<button class='delete'>Delete</button>
</a>
</td>";

echo "</tr>";

}

?>

</table>

</div>


<!-- CLIENTS -->

<div class="card" id="clients">

<h3>Clients / Workers</h3>

<table>

<tr>
<th>Name</th>
<th>Service</th>
<th>Contact</th>
<th>Action</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM workers");

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['name']."</td>";

echo "<td>".$row['service']."</td>";

echo "<td>".$row['contact']."</td>";

echo "<td>
<a href='delete_worker.php?id=".$row['id']."' 
onclick=\"return confirm('Are you sure you want to delete this worker?');\">
<button class='delete'>Delete</button>
</a>
</td>";

echo "</tr>";

}

?>

</table>

</div>

</div>
<?php if(isset($_GET['msg'])){ ?>

<script>

let msg = "<?php echo $_GET['msg']; ?>";

if(msg === "accepted"){
    alert("✅ Staff Accepted!");
}

if(msg === "deleted"){
    alert("❌ Deleted Successfully!");
}

</script>

<?php } ?>

</body>
</html>