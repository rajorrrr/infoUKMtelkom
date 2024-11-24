<?php
include 'connect.php';

$id = $_GET['id'];

$sql = "DELETE FROM posts WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);

header("Location: Beranda.php");
exit;
