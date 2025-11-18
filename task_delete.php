<?php
include "includes/config.php";
$id = $_GET['id'];
$conn->query("DELETE FROM tasks WHERE id=$id");
header("Location: dashboard.php");
