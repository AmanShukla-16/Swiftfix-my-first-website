<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>SwiftFix Staff Login</title>

<style>
*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Segoe UI',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#0f172a,#1e293b,#020617);
background-size:400% 400%;
animation:bgmove 10s ease infinite;
}

@keyframes bgmove{
0%{background-position:0% 50%;}
50%{background-position:100% 50%;}
100%{background-position:0% 50%;}
}

.login-box{
width:380px;
padding:40px;
border-radius:20px;
background:rgba(255,255,255,0.08);
backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,0.2);
box-shadow:0 10px 30px rgba(0,0,0,0.5);
color:white;
}

.login-box h2{
text-align:center;
margin-bottom:30px;
color:#00e0ff;
}

.input-group{
margin-bottom:20px;
}

.input-group label{
display:block;
margin-bottom:6px;
font-size:14px;
}

.input-group input{
width:100%;
padding:12px;
border:none;
border-radius:8px;
background:#0f172a;
color:white;
}

button{
width:100%;
padding:12px;
border:none;
border-radius:10px;
background:linear-gradient(90deg,#00e0ff,#00c6ff);
font-weight:bold;
cursor:pointer;
}

button:hover{
opacity:0.9;
}

.links{
text-align:center;
margin-top:15px;
font-size:13px;
}

.links a{
color:#00e0ff;
text-decoration:none;
}
</style>
</head>

<body>

<div class="login-box">

<h2>Staff Login</h2>

<form action="subadmin_login.php" method="POST">

<div class="input-group">
<label>Email</label>
<input type="email" name="email" required>
</div>

<div class="input-group">
<label>Password</label>
<input type="password" name="password" required>
</div>

<button type="submit">Login</button>

</form>

<div class="links">
<a href="subadmin_register.html">Request Staff Access</a>
</div>

</div>

</body>
</html>