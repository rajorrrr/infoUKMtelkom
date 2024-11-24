<?php
// Koneksi ke database
$host = 'localhost';      // Ganti dengan host database Anda
$username = 'root';       // Ganti dengan username database Anda
$password = '';           // Ganti dengan password database Anda
$dbname = 'infoUKMtelkom'; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query untuk membuat tabel
$sql = "CREATE TABLE events (
    id INT(11) AUTO_INCREMENT PRIMARY KEY, -- ID unik untuk setiap event
    date DATE NOT NULL,                    -- Kolom untuk tanggal event
    image_path VARCHAR(255) NOT NULL,           -- Path atau URL gambar event
    event_title VARCHAR(255) NOT NULL,     -- Judul event
    description TEXT NOT NULL,             -- Deskripsi event
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Tanggal pembuatan record
)";

// Eksekusi query untuk membuat tabel
if ($conn->query($sql) === TRUE) {
    echo "Table 'posts' created successfully!";
} else {
    echo "Error creating table: " . $conn->error;
}

// Tutup koneksi
$conn->close();
