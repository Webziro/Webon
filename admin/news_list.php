<?php
// admin/news_list.php - List, Edit, Delete News
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

// Handle delete
if (isset($_POST['delete_id'])) {
    $stmt = $pdo->prepare("DELETE FROM news WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
    $message = 'News deleted.';
}

// Handle status change
if (isset($_POST['status_id']) && isset($_POST['new_status'])) {
    $stmt = $pdo->prepare("UPDATE news SET status = ? WHERE id = ?");
    $stmt->execute([$_POST['new_status'], $_POST['status_id']]);
    $message = 'Status updated.';
}

$stmt = $pdo->query("SELECT * FROM news ORDER BY created_at DESC");
$newsList = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage News - Admin</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
    <style>
        body { padding: 2rem; }
        .container { max-width: 900px; margin: auto; }
        td { vertical-align: middle !important; }
    </style>
</head>
<body>
<div class="container">
    <h2>Manage News</h2>
    <?php if (!empty($message)) echo '<div class="alert alert-info">' . $message . '</div>'; ?>
    <a href="news_add.php" class="btn btn-success mb-3">Add News</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Tags</th>
                <th>Status</th>
                <th>Views</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($newsList as $news): ?>
            <tr>
                <td><?php echo htmlspecialchars($news['title']); ?></td>
                <td><?php echo htmlspecialchars($news['tags']); ?></td>
                <td>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="status_id" value="<?php echo $news['id']; ?>">
                        <select name="new_status" onchange="this.form.submit()" class="form-select form-select-sm">
                            <option value="draft" <?php if ($news['status']==='draft') echo 'selected'; ?>>Draft</option>
                            <option value="published" <?php if ($news['status']==='published') echo 'selected'; ?>>Published</option>
                        </select>
                    </form>
                </td>
                <td><?php echo $news['views']; ?></td>
                <td><?php echo date('j M, Y', strtotime($news['created_at'])); ?></td>
                <td>
                    <a href="news_edit.php?id=<?php echo $news['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                    <form method="post" style="display:inline;" onsubmit="return confirm('Delete this news?');">
                        <input type="hidden" name="delete_id" value="<?php echo $news['id']; ?>">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php" class="btn btn-secondary">Back to Dashboard</a>
</div>
</body>
</html>
