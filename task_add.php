<?php
session_start();
include "includes/config.php";
$uid = $_SESSION['user'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc  = $_POST['description'];
    $conn->query("INSERT INTO tasks(user_id,title,description) VALUES($uid,'$title','$desc')");
    header("Location: dashboard.php");
}
?>
<html><head><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="container">
<h2>Tambah Task</h2>
<form method="POST">
<input type="text" name="title" placeholder="Judul" required>
<textarea name="description" placeholder="Deskripsi"></textarea>
<button>Simpan</button>
</form>
</div>
</body>
</html>
