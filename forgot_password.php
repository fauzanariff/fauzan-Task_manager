<?php
// ==========================================
// TAMPILKAN ERROR AGAR TIDAK BLANK PAGE
// ==========================================
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "includes/config.php";

// Pastikan file functions.php ada
if (!file_exists("includes/functions.php")) {
    die("ERROR: File functions.php tidak ditemukan.");
}

include "includes/functions.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitasi input
    $email = trim($_POST['email']);
    $email = $conn->real_escape_string($email);

    // Cek email di database
    $cek = $conn->query("SELECT * FROM users WHERE email='$email'");

    if (!$cek) {
        die("Query error: " . $conn->error);
    }

    if ($cek->num_rows == 0) {
        $msg = "<div class='error'>Email tidak ditemukan</div>";

    } else {
        // Buat token aman
        $token = bin2hex(random_bytes(20));

        // Simpan token
        $update = $conn->query("UPDATE users SET token='$token' WHERE email='$email'");

        if (!$update) {
            die("Gagal menyimpan token: " . $conn->error);
        }

        // Kirim email
        $email_sent = send_reset_email($email, $token);

        if ($email_sent) {
            $msg = "<div class='success'>Cek email Anda untuk reset password.</div>";
        } else {
            $msg = "<div class='error'>Gagal mengirim email. Coba lagi.</div>";
        }
    }
}
?>
<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container">
<h2>Lupa Password</h2>

<?= $msg ?>

<form method="POST">
    <input type="email" name="email" placeholder="Masukkan email" required>
    <button type="submit">Kirim</button>
</form>
</div>
</body>
</html>
