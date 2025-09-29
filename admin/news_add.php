<?php
// admin/news_add.php - Add News Form
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $status = $_POST['status'] ?? 'draft';
    $author_id = $_SESSION['admin_id'] ?? null;
    $tags = $_POST['tags'] ?? '';
    $category = $_POST['category'] ?? 'blog';
    $image = '';

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/news/';
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = 'images/news/' . basename($_FILES['image']['name']);
        }
    }

    // use shared slug helper
    require_once __DIR__ . '/../includes/helpers.php';
    // generate base slug and ensure uniqueness before inserting
    $baseSlug = create_slug($title);
    $slug = ensure_unique_slug($baseSlug, $pdo);
    // Start views at 100 for new items
    $stmt = $pdo->prepare("INSERT INTO news (title, content, image, status, author_id, tags, category, views, slug) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $content, $image, $status, $author_id, $tags, $category, 100, $slug]);
    $message = 'News added successfully!';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add News - Admin</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
    <style>
        body { padding: 2rem; }
        .container { max-width: 600px; margin: auto; }
    </style>
</head>
<body>
<div class="container">
    <h2>Add News</h2>
    <?php if ($message) echo '<div class="alert alert-success">' . $message . '</div>'; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="6" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags (comma separated)</label>
            <input type="text" name="tags" id="tags" class="form-control" placeholder="e.g. web,php,design">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category" id="category" class="form-control">
                <option value="blog">Blog</option>
                <option value="press">Press</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="draft">Draft</option>
                <option value="published">Published</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add News</button>
        <a href="news_list.php" class="btn btn-secondary">Back to News List</a>
    </form>
</div>
</body>
</html>
