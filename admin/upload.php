<?php
// admin/upload.php - Handles image upload
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}

$target_dir = '../images/featured-projects/';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $filename = basename($file['name']);
    $target_file = $target_dir . $filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($imageFileType, $allowed) && $file['size'] < 2*1024*1024) {
        if (move_uploaded_file($file['tmp_name'], $target_file)) {
            $msg = 'Image uploaded successfully!';
        } else {
            $msg = 'Error uploading image.';
        }
    } else {
        $msg = 'Invalid file type or size.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload Image</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width:600px; margin:auto; padding:2rem;">
    <h2>Upload Image</h2>
    <?php if ($msg): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Select Image</label>
            <input type="file" name="image" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
    <a href="featured_add.php">Back to Add Project</a>
</div>
</body>
</html>
