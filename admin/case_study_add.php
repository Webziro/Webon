<?php
// admin/case_study_add.php - Add case study
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $image = '';
    // Challenges
    $challenges_title = $_POST['challenges_title'] ?? '';
    $challenges_description = $_POST['challenges_description'] ?? '';
    $challenges_points = $_POST['challenges_points'] ?? '';
    // Solution
    $solution_title = $_POST['solution_title'] ?? '';
    $solution_description = $_POST['solution_description'] ?? '';
    $solution_points = $_POST['solution_points'] ?? '';
    $solution_image = '';
    // Score Board
    $score_points = $_POST['score_points'] ?? '';

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
    } else {
        $image = $_POST['image_url'] ?? '';
    }
    // Solution image
    if (isset($_FILES['solution_image']) && $_FILES['solution_image']['error'] === UPLOAD_ERR_OK) {
        $target_dir = '../images/case-study/';
        $filename = basename($_FILES['solution_image']['name']);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed) && $_FILES['solution_image']['size'] < 2*1024*1024) {
            if (move_uploaded_file($_FILES['solution_image']['tmp_name'], $target_file)) {
                $solution_image = 'images/case-study/' . $filename;
            } else {
                $msg = 'Error uploading solution image.';
            }
        } else {
            $msg = 'Invalid solution image file type or size.';
        }
    } else {
        $solution_image = $_POST['solution_image_url'] ?? '';
    }
    if ($title && $image) {
        $stmt = $pdo->prepare('INSERT INTO case_studies (title, image, description, challenges_title, challenges_description, challenges_points, solution_title, solution_description, solution_points, solution_image, score_points) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([$title, $image, $description, $challenges_title, $challenges_description, $challenges_points, $solution_title, $solution_description, $solution_points, $solution_image, $score_points]);
        $msg = 'Case study added!';
    } else {
        $msg = 'Title and image are required.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Case Study</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width:600px; margin:auto; padding:2rem;">
    <h2>Add Case Study</h2>
    <?php if ($msg): ?><div class="alert alert-info"><?php echo $msg; ?></div><?php endif; ?>
    <form method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Upload Image</label>
            <input type="file" name="image" class="form-control">
            <small class="form-text text-muted">Or paste image URL below</small>
            <input type="text" name="image_url" class="form-control" placeholder="Or paste image URL">
        </div>
        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <hr>
        <h4>Challenges</h4>
        <div class="mb-3">
            <label>Challenges Title</label>
            <input type="text" name="challenges_title" class="form-control">
        </div>
        <div class="mb-3">
            <label>Challenges Description</label>
            <textarea name="challenges_description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Challenges Points</label>
            <input type="text" name="challenges_points" class="form-control">
        </div>
        <hr>
        <h4>Solution</h4>
        <div class="mb-3">
            <label>Solution Title</label>
            <input type="text" name="solution_title" class="form-control">
        </div>
        <div class="mb-3">
            <label>Solution Description</label>
            <textarea name="solution_description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Solution Points</label>
            <input type="text" name="solution_points" class="form-control">
        </div>
        <div class="mb-3">
            <label>Solution Image</label>
            <input type="file" name="solution_image" class="form-control">
            <small class="form-text text-muted">Or paste solution image URL below</small>
            <input type="text" name="solution_image_url" class="form-control" placeholder="Or paste solution image URL">
        </div>
        <hr>
        <h4>Score Board</h4>
        <div class="mb-3">
            <label>Score Points</label>
            <input type="text" name="score_points" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Add Case Study</button>
    </form>
    <a href="index.php">Back to Dashboard</a>
</div>
</body>
</html>
