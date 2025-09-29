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

// Handle hide/unhide toggle
if (isset($_GET['toggle'])) {
    $id = (int)$_GET['toggle'];
    // Ensure column exists (best-effort, ignore failure)
    try {
        $pdo->exec("ALTER TABLE featured_projects ADD COLUMN IF NOT EXISTS is_hidden TINYINT(1) NOT NULL DEFAULT 0");
    } catch (Exception $e) {
        // Some MySQL versions may not support IF NOT EXISTS; ignore errors
    }
    // Get current state
    $stmt = $pdo->prepare('SELECT is_hidden FROM featured_projects WHERE id = ?');
    $stmt->execute([$id]);
    $current = $stmt->fetchColumn();
    $new = ($current == 1) ? 0 : 1;
    $stmt = $pdo->prepare('UPDATE featured_projects SET is_hidden = ? WHERE id = ?');
    $stmt->execute([$new, $id]);
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
                    <?php
                    // Show Hide/Unhide button based on is_hidden column (if missing, assume visible)
                    $is_hidden = isset($p['is_hidden']) ? (int)$p['is_hidden'] : 0;
                    if ($is_hidden) {
                        echo '<a href="featured_list.php?toggle=' . $p['id'] . '" class="btn btn-warning btn-sm" onclick="return confirm(\'Unhide this project?\');">Unhide</a>';
                    } else {
                        echo '<a href="featured_list.php?toggle=' . $p['id'] . '" class="btn btn-success btn-sm" onclick="return confirm(\'Hide this project?\');">Hide</a>';
                    }
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody> 
    </table>
    <a href="index.php">Back to Dashboard</a>
</div>
</body>
</html>
