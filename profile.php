<?php
session_start();
include "includes/config.php";
$uid = $_SESSION['user'];

$user = $conn->query("SELECT * FROM users WHERE id=$uid")->fetch_assoc();
?>
<html><head><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="container">
<h2>Profil</h2>
<p>Email: <?= $user['email'] ?></p>
<a href="change_password.php">Ubah Password</a><br><br>
<a href="dashboard.php">Kembali</a>
</div>
</body>
</html>
