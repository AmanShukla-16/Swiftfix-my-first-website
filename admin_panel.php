<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_panel.php");
    exit;
}

$conn = new mysqli("localhost","root","","service");
?>

<!DOCTYPE html>
<html>
<head>
<title>SwiftFix Admin Panel</title>

<style>
body{
margin:0;
font-family:'Segoe UI';
background:#0f172a;
color:white;
display:flex;
}

/* sidebar */

.sidebar{
width:250px;
background:#111827;
height:100vh;
padding:30px 20px;
position:fixed;
}

.sidebar h2{
text-align:center;
color:#00e0ff;
margin-bottom:40px;
}

.sidebar a{
display:block;
padding:12px;
margin-bottom:10px;
text-decoration:none;
color:#ddd;
border-radius:8px;
}

.sidebar a:hover{
background:#1f2937;
color:#00e0ff;
}

/* main */

.main{
margin-left:270px;
padding:40px;
width:100%;
}

.card{
background:#1e293b;
padding:25px;
border-radius:15px;
margin-bottom:30px;
}

.card h2{
color:#00e0ff;
margin-bottom:20px;
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
padding:10px 15px;
background:#00e0ff;
border:none;
border-radius:6px;
cursor:pointer;
}

button.delete{
background:#ff4d4d;
}

table{
width:100%;
border-collapse:collapse;
}

table th, table td{
padding:10px;
border-bottom:1px solid #333;
text-align:left;
}
</style>
</head>

<body>

<div class="sidebar">
<h2>SwiftFix</h2>
<a href="#">Dashboard</a>
<a href="#users">Users</a>
<a href="#workers">Workers</a>
<a href="#staff">Staff</a>
<a href="#requests">Requests</a>
<a href="logout.php" style="color:#ff4d4d;">Logout</a>
</div>

<div class="main">

<h1>Admin Dashboard</h1>

<!-- ADD WORKER -->

<div class="card">

<h2>Add Worker</h2>

<form action="add_worker.php" method="post" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Worker Name" required>

<select name="service" required>
<option value="plumber">Plumber</option>
<option value="cleaner">Cleaner</option>
<option value="electrician">Electrician</option>
</select>

<input type="text" name="contact" placeholder="Contact Number" required>

<input type="file" name="image" required>

<button type="submit">Add Worker</button>

</form>

</div>


<!-- USERS -->

<div class="card" id="users">

<h2>Registered Users</h2>

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
<a href='delete_user.php?id=".$row['email']."'>
<button class='delete'>Delete</button>
</a>
</td>";

echo "</tr>";

}

?>

</table>

</div>



<!-- WORKERS -->

<div class="card" id="workers">

<h2>Workers</h2>

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
<a href='delete_worker.php?id=".$row['id']."'>
<button class='delete'>Delete</button>
</a>
</td>";

echo "</tr>";

}

?>

</table>

</div>


<!-- STAFF -->

 <div class="card" id="requests">

<h2>Staff Requests</h2>

<table>

<tr>
<th>Name</th>
<th>Email</th>
<th>Action</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM subadmin_requests");

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['name']."</td>";
echo "<td>".$row['email']."</td>";

echo "<td>

<a href='accept_subadmin.php?id=".$row['id']."' 
onclick=\"return confirm('Accept this request?');\">
<button>Accept</button>
</a>

<a href='delete_subadmin.php?id=".$row['id']."' 
onclick=\"return confirm('Delete this request?');\">
<button class='delete'>Delete</button>
</a>

</td>";

echo "</tr>";
}

?>

</table>

</div>

<div class="card" id="staff">

<h2>Staff Accounts</h2>

<table>

<tr>
<th>Email</th>
<th>Action</th>
</tr>

<?php

$result = $conn->query("SELECT * FROM staff");

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['email']."</td>";

echo "<td>
<a href='delete_staff.php?id=".$row['id']."'>
<button class='delete'>Delete</button>
</a>
</td>";

echo "</tr>";

}

?>

</table>

</div>

</div>

</body>
</html>