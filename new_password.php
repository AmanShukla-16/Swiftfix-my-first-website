<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.html");
    exit();
}

$email = $_SESSION['reset_email'];

$con = new mysqli('localhost','root','','service');
if ($con->connect_error) die("Connection failed: ".$con->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['new_password'] ?? '';
    $confirm  = $_POST['confirm_password'] ?? '';

    if (!$password || !$confirm) {
        $error = "Fill both password fields.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $con->prepare("UPDATE register2 SET password=? WHERE email=?");
        $stmt->bind_param("ss", $password, $email);
        $stmt->execute();
        $stmt->close();

        unset($_SESSION['reset_email']);

        echo "<script>
            alert('Password updated successfully!');
            window.location.href = 'login.html';
        </script>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Set New Password - SwiftFix</title>
<style>
  body {
    margin: 0;
    height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #667eea, #764ba2);
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .form-container {
    width: 100%;
    max-width: 400px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-radius: 25px;
    padding: 50px 35px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.25);
    border: 1px solid rgba(255, 255, 255, 0.2);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .form-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 50px rgba(0,0,0,0.3);
  }

  h2 {
    margin-bottom: 30px;
    font-size: 28px;
    color: #fff;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
  }

  label {
    display: block;
    text-align: left;
    margin-bottom: 8px;
    font-weight: 600;
    color: #fff;
    font-size: 14px;
  }

  input[type="password"] {
    width: 100%;
    padding: 14px 15px;
    margin-bottom: 20px;
    border-radius: 12px;
    border: none;
    font-size: 16px;
    font-weight: 500;
    background: rgba(255,255,255,0.2);
    color: #000;
    box-shadow: inset 0 2px 6px rgba(255,255,255,0.3);
    transition: all 0.3s ease;
  }

  input[type="password"]:focus {
    background: rgba(255,255,255,0.35);
    outline: none;
    box-shadow: inset 0 2px 10px rgba(255,255,255,0.5);
  }

  button {
    width: 100%;
    padding: 15px;
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #ff758c, #ff7eb3);
    border: none;
    border-radius: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(255,118,140,0.4);
  }

  button:hover {
    background: linear-gradient(135deg, #ff7eb3, #ff758c);
    box-shadow: 0 12px 25px rgba(255,126,179,0.6);
    transform: translateY(-2px);
  }

  .back-link {
    display: block;
    margin-top: 20px;
    color: #fff;
    font-size: 15px;
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .back-link:hover {
    color: #ffd6e0;
    text-decoration: underline;
  }

  .error {
    color: #ffb3b3;
    margin-bottom: 15px;
    font-weight: 600;
  }
</style>
</head>
<body>

<div class="form-container">
  <h2>Set Your New Password</h2>

  <form method="POST" action="">
    <label>New Password:</label>
    <input type="password" name="new_password" placeholder="Enter new password" required>

    <label>Confirm Password:</label>
    <input type="password" name="confirm_password" placeholder="Confirm new password" required>

    <button type="submit">Update Password</button>
  </form>

  <a href="login.html" class="back-link">Back to Login</a>
</div>

</body>
</html>
