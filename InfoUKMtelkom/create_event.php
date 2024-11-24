<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil input tanggal dalam format "24 November 2024"
    $input_date = $_POST['date'];
    $datetime_object = DateTime::createFromFormat('d F Y', $input_date);

    // Konversi ke format yang sesuai untuk database (YYYY-MM-DD)
    $formatted_date = $datetime_object->format('Y-m-d');

    $event_title = $_POST['event_title'];
    $description = $_POST['description'];

    // Proses file gambar
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['image']['name']);
        $targetFilePath = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {
            // Simpan data ke database
            $sql = "INSERT INTO events (date, image_path, event_title, description) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$formatted_date, $targetFilePath, $event_title, $description]);

            header("Location: beranda.php");
            exit;
        } else {
            $error = "Failed to upload image.";
        }
    } else {
        $error = "Please upload an image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <a href="Beranda.php" class="text-sm text-muted">Back</a>
    <div class="container mt-5">
        <h1>Add New Event</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="event_title" class="form-label">Event Title</label>
                <input type="text" class="form-control" id="event_title" name="event_title" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>
            <div class="mb-3">
                <label for="date" class="form-label">Date (e.g., 24 November 2024)</label>
                <input type="text" class="form-control" id="date" name="date" placeholder="24 November 2024" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Event</button>
        </form>

    </div>
</body>

</html>