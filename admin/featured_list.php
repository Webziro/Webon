<?php
// admin/featured_list.php - List, edit, and delete featured projects
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare('DELETE FROM featured_projects WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: featured_list.php');
    exit;
}

$stmt = $pdo->query('SELECT * FROM featured_projects ORDER BY created_at DESC');
$projects = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Featured Projects</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width:800px; margin:auto; padding:2rem;">
    <h2>Manage Featured Projects</h2>
    <a href="featured_add.php" class="btn btn-success mb-3">Add New Project</a>
    <table class="table table-bordered">
        <thead><tr><th>Image</th><th>Title</th><th>Subtitle</th><th>Actions</th></tr></thead>
        <tbody>
        <?php foreach ($projects as $p): ?>
            <tr>
                <td><img src="../<?php echo htmlspecialchars($p['image']); ?>" alt="" style="max-width:80px;"></td>
                <td><?php echo htmlspecialchars($p['title']); ?></td>
                <td><?php echo htmlspecialchars($p['subtitle']); ?></td>
                <td>
                    <a href="featured_edit.php?id=<?php echo $p['id']; ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="featured_list.php?delete=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this project?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Back to Dashboard</a>
</div>
</body>
</html>
