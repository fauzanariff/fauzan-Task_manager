<?php
include "includes/config.php";
include "includes/functions.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(20));
    $expires = date("Y-m-d H:i:s", strtotime("+24 hours"));

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $message = "<div class='error'>Email sudah terdaftar</div>";
    } else {
        $conn->query("INSERT INTO users (email, password, token, token_expire, status)
                      VALUES ('$email', '$password', '$token', '$expires', 'PENDING')");

        send_activation_email($email, $token);

        $message = "<div class='success'>Registrasi berhasil! Cek email untuk aktivasi.</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Registrasi</title>
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <div class="container">
    <h2>Registrasi Project Manager</h2>
    <?= $message ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Daftar</button>
    </form>
  </div>
</body>
</html>
