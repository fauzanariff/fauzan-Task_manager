<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");

include "includes/config.php";
$uid = $_SESSION['user'];

$tasks = $conn->query("SELECT * FROM tasks WHERE user_id=$uid ORDER BY id DESC");
?>
<html><head><link rel="stylesheet" href="assets/style.css"></head>
<body>
<div class="container">
<h2>Dashboard</h2>
<a href="task_add.php" class="button">Tambah Task</a>
<a href="profile.php" class="button">Profil</a>
<a href="logout.php" class="button">Logout</a>

<table border="1" width="100%">
<tr>
<th>Judul</th><th>Status</th><th>Aksi</th>
</tr>
<?php while($t = $tasks->fetch_assoc()): ?>
<tr>
<td><?= $t['title'] ?></td>
<td><?= $t['status'] ?></td>
<td>
<a href="task_edit.php?id=<?= $t['id'] ?>">Edit</a> | 
<a href="task_delete.php?id=<?= $t['id'] ?>">Hapus</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>
</body>
</html>
