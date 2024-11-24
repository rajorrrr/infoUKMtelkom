<?php
$host = 'localhost'; // Ganti sesuai dengan host database Anda
$dbname = 'infoUKMtelkom'; // Nama database Anda
$username = 'root'; // Username database
$password = ''; // Password database

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Hapus atau pastikan tidak ada echo di sini
    // echo "Connected successfully to the database!"; // Pastikan ini dihapus
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
