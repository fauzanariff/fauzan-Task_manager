<?php
session_start();
include "includes/config.php";
$id = $_GET['id'];

$t = $conn->query("SELECT * FROM tasks WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $desc  = $_POST['description'];
    $status = $_POST['status'];
    $conn->query("UPDATE tasks SET title='$title', description='$desc', status='$status' WHERE id=$id");
    header("Location: dashboard.php");
}
?>
<html><head><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="container">
<h2>Edit Task</h2>
<form method="POST">
<input type="text" name="title" value="<?= $t['title'] ?>" required>
<textarea name="description"><?= $t['description'] ?></textarea>
<select name="status">
  <option <?= $t['status']=="To-Do"?"selected":"" ?>>To-Do</option>
  <option <?= $t['status']=="In-Progress"?"selected":"" ?>>In-Progress</option>
  <option <?= $t['status']=="Done"?"selected":"" ?>>Done</option>
</select>
<button>Update</button>
</form>
</div>
</body>
</html>
