<?php
$conn = new mysqli("localhost","root","","service");

if($conn->connect_error){
die("Connection failed: ".$conn->connect_error);
}

$sql = "SELECT * FROM workers WHERE service='Plumber'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Plumbing Services</title>

<style>
body{
margin:0;
font-family:'Segoe UI',sans-serif;
background:linear-gradient(135deg,#0f172a,#1e293b);
color:white;
}

header{
background:#111827;
padding:15px;
text-align:center;
}

header h1{
margin:0;
color:#00e0ff;
}

nav{
margin-top:8px;
}

nav a{
color:#cbd5e1;
margin:0 15px;
text-decoration:none;
font-weight:500;
transition:0.3s;
}

nav a:hover{
color:#00e0ff;
}

.section-title{
text-align:center;
margin-top:40px;
font-size:28px;
color:#00e0ff;
}

.plumber-profile{
display:flex;
flex-wrap:wrap;
justify-content:center;
gap:30px;
padding:40px;
}

article{
background:rgba(30,41,59,0.8);
backdrop-filter:blur(10px);
border-radius:15px;
padding:20px;
width:280px;
text-align:center;
transition:0.3s;
box-shadow:0 10px 25px rgba(0,0,0,0.4);
}

article:hover{
transform:translateY(-8px);
box-shadow:0 15px 35px rgba(0,224,255,0.4);
}

article img{
width:100%;
height:220px;
object-fit:cover;
border-radius:10px;
}

article h3{
margin:10px 0;
color:#f1f5f9;
font-weight:500;
}

.whatsapp-btn{
display:inline-flex;
align-items:center;
justify-content:center;
margin-top:10px;
padding:10px 15px;
background:#25D366;
color:white;
border-radius:8px;
text-decoration:none;
font-weight:bold;
transition:0.3s;
}

.whatsapp-btn:hover{
background:#1ebe5d;
transform:scale(1.05);
}

footer{
background:#111827;
text-align:center;
padding:15px;
margin-top:30px;
color:#94a3b8;
}
</style>
</head>

<body>

<header>
<h1>SwiftFix Plumbing Services</h1>
<nav>
<a href="index.html">Home</a>
<a href="#">Services</a>
<a href="#">Contact</a>
</nav>
</header>

<h2 class="section-title">Our Professional Plumbers</h2>

<section class="plumber-profile">

<?php
if($result->num_rows > 0){
while($row = $result->fetch_assoc()){
?>

<article>
<img src="uploads/<?php echo $row['image']; ?>" alt="Plumber">
<h3><?php echo $row['name']; ?></h3>
<h3>Contact: <?php echo $row['contact']; ?></h3>

<a href="https://wa.me/<?php echo $row['contact']; ?>" target="_blank" class="whatsapp-btn">
Chat on WhatsApp
</a>
</article>

<?php
}
}else{
echo "<h3>No plumbers available</h3>";
}
?>

</section>

<footer>
Contact us: info@swiftfix.com | © 2026 SwiftFix Service
</footer>

</body>
</html>
