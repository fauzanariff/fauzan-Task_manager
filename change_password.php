<?php
session_start();
include "includes/config.php";
$uid = $_SESSION['user'];
$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $conn->query("UPDATE users SET password='$new' WHERE id=$uid");
    $msg = "Password berhasil diubah";
}
?>
<html><head><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="container">
<h2>Ubah Password</h2>
<?= $msg ?>
<form method="POST">
<input type="password" name="password" placeholder="Password baru" required>
<button>Simpan</button>
</form>
<a href="dashboard.php">Kembali</a>
</div>
</body>
</html>
