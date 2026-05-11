<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login - SwiftFix</title>

<style>
*{
  margin:0;
  padding:0;
  box-sizing:border-box;
  font-family:'Segoe UI', sans-serif;
}

body{
  height:100vh;
  display:flex;
  justify-content:center;
  align-items:center;
  background: linear-gradient(135deg,#141e30,#243b55);
}

.login-container{
  width:380px;
  padding:45px 35px;
  border-radius:20px;
  background: rgba(0,0,0,0.65);
  backdrop-filter: blur(15px);
  -webkit-backdrop-filter: blur(15px);
  border:1px solid rgba(255,255,255,0.1);
  box-shadow:0 20px 40px rgba(0,0,0,0.6);
  color:#fff;
}

.login-container h1{
  text-align:center;
  margin-bottom:30px;
  font-size:26px;
  letter-spacing:1px;
}

.input-group{
  position:relative;
  margin-bottom:25px;
}

.input-group input{
  width:100%;
  padding:14px 12px;
  border:none;
  border-radius:10px;
  outline:none;
  background:rgba(255,255,255,0.08);
  color:#fff;
  font-size:15px;
  transition:0.3s;
}

.input-group label{
  position:absolute;
  top:14px;
  left:12px;
  font-size:14px;
  color:#aaa;
  pointer-events:none;
  transition:0.3s;
}

.input-group input:focus,
.input-group input:valid{
  background:rgba(255,255,255,0.15);
}

.input-group input:focus + label,
.input-group input:valid + label{
  top:-9px;
  left:10px;
  font-size:11px;
  background:#243b55;
  padding:2px 6px;
  border-radius:6px;
  color:#00e0ff;
}

button{
  width:100%;
  padding:14px;
  border:none;
  border-radius:12px;
  font-size:16px;
  font-weight:bold;
  cursor:pointer;
  background: linear-gradient(90deg,#00e0ff,#00c6ff);
  color:#000;
  transition:0.3s;
}

button:hover{
  transform:translateY(-3px);
  box-shadow:0 10px 25px rgba(0,224,255,0.4);
}

.error{
  color:#ff4d4d;
  text-align:center;
  margin-bottom:15px;
  font-size:14px;
}

.footer-text{
  text-align:center;
  margin-top:18px;
  font-size:13px;
  color:#aaa;
}

</style>
</head>

<body>

<div class="login-container">
  <h1>Admin Panel</h1>

  <?php if (isset($_GET['error'])): ?>
      <p class="error">Invalid username or password</p>
  <?php endif; ?>

  <form action="admin_auth.php" method="post">

    <div class="input-group">
      <input type="text" name="username" required>
      <label>Admin Username</label>
    </div>

    <div class="input-group">
      <input type="password" name="password" required>
      <label>Password</label>
    </div>

    <button type="submit">Secure Login</button>
  </form>

  <div class="footer-text">
    SwiftFix Administration System
  </div>
</div>

</body>
</html>