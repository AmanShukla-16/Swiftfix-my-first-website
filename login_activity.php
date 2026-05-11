<?php
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit;
}

include 'connect.php';

// Fetch data
$sql = "SELECT username, email, time FROM register2 ORDER BY time DESC";
$result = mysqli_query($con, $sql);

$login_activity = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $login_activity[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Activity</title>
    <style>
        <style>
body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: #0f172a;
    color: #fff;
    padding: 40px;
}

.container {
    max-width: 1100px;
    margin: auto;
    background: #1e293b;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.4);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #00e0ff;
}

.search-box {
    text-align: right;
    margin-bottom: 15px;
}

.search-box input {
    padding: 12px 15px;
    width: 280px;
    border-radius: 8px;
    border: 2px solid #00e0ff;
    background: #0f172a;
    color: #ffffff;
    font-size: 14px;
    outline: none;
    transition: 0.3s;
}

.search-box input::placeholder {
    color: #94a3b8;
}

.search-box input:focus {
    box-shadow: 0 0 10px #00e0ff;
    border-color: #00c6ff;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
}

thead {
    background: #111827;
}

th {
    padding: 14px;
    text-align: left;
    color: #00e0ff;
    font-weight: 600;
}

td {
    padding: 14px;
    color: #f1f5f9;   /* 👈 Light text */
    font-size: 15px;
}

tbody tr {
    background: #0f172a;
    transition: 0.3s;
}

tbody tr:hover {
    background: #1f2937;
}

tbody tr:nth-child(even) {
    background: #111827;
}

.logout-link {
    display: inline-block;
    margin-top: 25px;
    padding: 10px 18px;
    background: linear-gradient(90deg,#00e0ff,#00c6ff);
    color: #000;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.logout-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0,224,255,0.4);
}
</style>
</head>
<body>
    <div class="search-box">
    <input type="text" id="searchInput" placeholder="Search user...">
</div>
<div class="container">
    <h1>Login Activity</h1>
    <table>
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Login Time</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($login_activity as $login): ?>
            <tr>
                <td><?php echo htmlspecialchars($login['username']); ?></td>
                <td><?php echo htmlspecialchars($login['email']); ?></td>
                <td><?php echo htmlspecialchars($login['time']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a href="admin_panel.php" class="logout-link">Back to Admin Panel</a>
</div>
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();
    let rows = document.querySelectorAll("tbody tr");

    rows.forEach(function(row) {
        let text = row.textContent.toLowerCase();
        row.style.display = text.includes(filter) ? "" : "none";
    });
});
</script>
</body>
</html>
