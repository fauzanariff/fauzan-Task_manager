<?php
session_start();
include "includes/config.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check = $conn->query("SELECT * FROM users WHERE email='$email' AND status='ACTIVE'");

    if ($check->num_rows == 0) {
        $msg = "<div class='error'>Email tidak ditemukan / belum aktif</div>";
    } else {
        $data = $check->fetch_assoc();

        if (password_verify($password, $data['password'])) {
            $_SESSION['user'] = $data['id'];
            header("Location: dashboard.php");
        } else {
            $msg = "<div class='error'>Password salah</div>";
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
    <h2>Login</h2>
    <?= $msg ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email">
      <input type="password" name="password" placeholder="Password">
      <button>Login</button>
    </form>
    <a href="forgot_password.php">Lupa Password?</a>
  </div>
</body>
</html>
