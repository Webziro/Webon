<?php
// admin/news_edit.php - Edit News
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    echo 'Invalid news ID.';
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
$stmt->execute([$id]);
$news = $stmt->fetch();
if (!$news) {
    echo 'News not found.';
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $content = $_POST['content'] ?? '';
    $tags = $_POST['tags'] ?? '';
    $status = $_POST['status'] ?? 'draft';
    $image = $news['image'];

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $targetDir = '../images/news/';
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = 'images/news/' . basename($_FILES['image']['name']);
        }
    }

    // create slug helper
    function create_slug($str) {
        $str = strtolower(trim($str));
        $str = preg_replace('~[^\\pL\\d]+~u', '-', $str);
        $str = iconv('utf-8', 'us-ascii//TRANSLIT', $str);
        $str = preg_replace('~[^-\w]+~', '', $str);
        $str = trim($str, '-');
        $str = preg_replace('~-+~', '-', $str);
        return $str;
    }
    $slug = create_slug($title);
    $stmt = $pdo->prepare("UPDATE news SET title=?, content=?, image=?, status=?, tags=?, slug=? WHERE id=?");
    $stmt->execute([$title, $content, $image, $status, $tags, $slug, $id]);
    $message = 'News updated successfully!';
    // Refresh data
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$id]);
    $news = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit News - Admin</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
    <style>
        body { padding: 2rem; }
        .container { max-width: 600px; margin: auto; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit News</h2>
    <?php if ($message) echo '<div class="alert alert-success">' . $message . '</div>'; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="<?php echo htmlspecialchars($news['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="content" class="form-control" rows="6" required><?php echo htmlspecialchars($news['content']); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <?php if ($news['image']): ?>
                <img src="../<?php echo htmlspecialchars($news['image']); ?>" alt="Current Image" style="max-width:120px;display:block;margin-bottom:8px;">
            <?php endif; ?>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags (comma separated)</label>
            <input type="text" name="tags" id="tags" class="form-control" value="<?php echo htmlspecialchars($news['tags']); ?>">
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="draft" <?php if ($news['status']==='draft') echo 'selected'; ?>>Draft</option>
                <option value="published" <?php if ($news['status']==='published') echo 'selected'; ?>>Published</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update News</button>
        <a href="news_list.php" class="btn btn-secondary">Back to News List</a>
    </form>
</div>
</body>
</html>
