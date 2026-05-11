<?php
session_start();
include 'profile_db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$username = $_SESSION['username'];
$profile = ['username'=>'', 'date_of_birth'=>'', 'photo'=>''];

// Fetch profile data
$stmt = $profile_con->prepare(
    "SELECT username, date_of_birth, photo FROM profile WHERE username=?"
);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $profile = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Profile | SwiftFix</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {margin:0;font-family:Segoe UI,sans-serif;background:linear-gradient(135deg,#667eea,#764ba2);min-height:100vh;display:flex;align-items:center;justify-content:center;}
.profile-card{background:#fff;width:380px;padding:30px;border-radius:18px;box-shadow:0 20px 40px rgba(0,0,0,0.25);text-align:center;}
.avatar{width:130px;height:130px;border-radius:50%;background:#f1f1f1;margin:0 auto 15px;display:flex;align-items:center;justify-content:center;overflow:hidden;}
.avatar img{width:100%;height:100%;object-fit:cover;}
input,button{width:100%;padding:12px;margin-top:12px;border-radius:10px;}
input{border:1px solid #ccc;}
input:focus{outline:none;border-color:#667eea;}
button{background:#667eea;color:white;border:none;cursor:pointer;}
button:hover{background:#5a67d8;}
label{float:left;margin-top:12px;font-weight:600;color:#555;}
</style>
</head>
<body>

<div class="profile-card">
<h2>User Profile</h2>

<div class="avatar" id="preview">
    <?php if(!empty($profile['photo'])): ?>
        <img src="uploads/<?php echo $profile['photo']; ?>" alt="Profile Photo">
    <?php else: ?>
        Photo
    <?php endif; ?>
</div>

<form action="save_profile.php" method="POST" enctype="multipart/form-data">

    <label>Username / Nickname</label>
    <input type="text" name="username" value="<?php echo htmlspecialchars($profile['username']); ?>" readonly>

    <label>Date of Birth</label>
    <input type="date" name="dob" value="<?php echo htmlspecialchars($profile['date_of_birth']); ?>" required>

    <label>Profile Photo</label>
    <input type="file" name="photo" accept="image/*" onchange="previewImage(event)">

    <button type="submit">Save Profile</button>
</form>
</div>

<script>
function previewImage(event){
    const reader = new FileReader();
    reader.onload = () => {
        document.getElementById('preview').innerHTML = `<img src="${reader.result}">`;
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
</body>
</html>
