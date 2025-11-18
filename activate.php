<?php
include "includes/config.php";

if (!isset($_GET['token'])) {
    die("Token tidak ada");
}

$token = $_GET['token'];

$check = $conn->query("SELECT * FROM users WHERE token='$token'");

if ($check->num_rows == 0) {
    die("Token tidak valid");
}

$data = $check->fetch_assoc();

if (strtotime($data['token_expire']) < time()) {
    die("Token sudah kadaluarsa");
}

$conn->query("UPDATE users SET status='ACTIVE', token=NULL WHERE token='$token'");

echo "Akun berhasil diaktivasi. <a href='login.php'>Login</a>";
