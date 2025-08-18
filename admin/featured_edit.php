<?php
// admin/featured_edit.php - Edit featured project
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare('SELECT * FROM featured_projects WHERE id = ?');
$stmt->execute([$id]);
$project = $stmt->fetch();
if (!$project) {
    echo 'Project not found.';
    exit;
}
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $project['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = '../images/featured-projects/';
        $filename = basename($_FILES['image']['name']);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed) && $_FILES['image']['size'] < 2*1024*1024) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = 'images/featured-projects/' . $filename;
            } else {
                $msg = 'Error uploading image.';
            }
        } else {
            $msg = 'Invalid file type or size.';
        }
    } else if (!empty($_POST['image_url'])) {
        $image = $_POST['image_url'];
    }
    if ($title && $image) {
        $stmt = $pdo->prepare('UPDATE featured_projects SET title=?, subtitle=?, image=?, description=? WHERE id=?');
        $stmt->execute([$title, $subtitle, $image, $description, $id]);
        $msg = 'Project updated!';
        // Refresh project data
        $stmt = $pdo->prepare('SELECT * FROM featured_projects WHERE id = ?');
        $stmt->execute([$id]);
        $project = $stmt->fetch();
    } else {
        $msg = 'Title and image are required.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Featured Project</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width:600px; margin:auto; padding:2rem;">
    <h2>Edit Featured Project</h2>
    <?php if ($msg): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($project['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Subtitle</label>
            <input type="text" name="subtitle" class="form-control" value="<?php echo htmlspecialchars($project['subtitle']); ?>">
        </div>
        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="../<?php echo htmlspecialchars($project['image']); ?>" alt="" style="max-width:120px;">
        </div>
        <div class="mb-3">
            <label>Upload New Image</label>
            <input type="file" name="image" class="form-control">
            <small class="form-text text-muted">Or paste image URL below</small>
            <input type="text" name="image_url" class="form-control" placeholder="Or paste image URL">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($project['description']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Project</button>
    </form>
    <a href="featured_list.php">Back to List</a>
</div>
</body>
</html>
