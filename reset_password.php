<?php
include "includes/config.php";
$msg = "";
$token = $_GET['token'];

$cek = $conn->query("SELECT * FROM users WHERE token='$token'");
if ($cek->num_rows == 0) die("Token tidak valid");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password='$pass', token=NULL WHERE token='$token'");
    die("Password berhasil diganti. <a href='login.php'>Login</a>");
}
?>
<html><head><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="container">
<h2>Reset Password</h2>
<form method="POST">
<input type="password" name="password" placeholder="Password baru" required>
<button>Reset</button>
</form>
</div>
</body>
</html>
