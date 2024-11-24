<?php
include 'connect.php';

// Ambil data dari database
$query = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC"); // Ganti `tabel_anda` dengan nama tabel Anda
$posts = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h1>All Posts</h1>
    <a href="create_postingan.php" class="btn btn-success mb-4">Add New Post</a>
    <div class="row">
        <?php foreach ($posts as $post): ?>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
            <img src="<?= htmlspecialchars($post['image_path']); ?>" class="card-img-top" alt="Image">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($post['title']); ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars($post['content'])); ?></p>
                </div>
                <div class="card-footer">
                    <small class="text-muted">Posted by <?= htmlspecialchars($post['username']); ?> on <?= htmlspecialchars($post['created_at']); ?></small>
                    <div class="d-flex justify-content-between mt-2">
                        <a href="edit_postingan.php?id=<?= $post['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="hapus_postingan.php?id=<?= $post['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>
