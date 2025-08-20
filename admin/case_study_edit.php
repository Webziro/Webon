<?php
// admin/case_study_edit.php - Edit case study
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare('SELECT * FROM case_studies WHERE id = ?');
$stmt->execute([$id]);
$case = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$case) {
    echo 'Case study not found.';
    exit;
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = $case['image'];
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = '../images/case-study/';
        $filename = basename($_FILES['image']['name']);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed) && $_FILES['image']['size'] < 2*1024*1024) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = 'images/case-study/' . $filename;
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
        $stmt = $pdo->prepare('UPDATE case_studies SET title=?, image=?, description=? WHERE id=?');
        $stmt->execute([$title, $image, $description, $id]);
        $msg = 'Case study updated!';
        // Refresh data
        $stmt = $pdo->prepare('SELECT * FROM case_studies WHERE id = ?');
        $stmt->execute([$id]);
        $case = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $msg = 'Title and image are required.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Case Study</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width:600px; margin:auto; padding:2rem;">
    <h2>Edit Case Study</h2>
    <?php if ($msg): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($case['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Current Image</label><br>
            <img src="../<?php echo htmlspecialchars($case['image']); ?>" alt="" style="max-width:150px;">
        </div>
        <div class="mb-3">
            <label>Upload New Image</label>
            <input type="file" name="image" class="form-control">
            <small class="form-text text-muted">Or paste new image URL below</small>
            <input type="text" name="image_url" class="form-control" placeholder="Or paste image URL">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"><?php echo htmlspecialchars($case['description']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-warning">Update Case Study</button>
    </form>
    <a href="case_study_list.php">Back to List</a>
</div>
</body>
</html>
