<?php
// admin/case_study_list.php - Manage case studies
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: index.php');
    exit;
}
require_once '../includes/db.php';

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare('DELETE FROM case_studies WHERE id = ?');
    $stmt->execute([$id]);
    header('Location: case_study_list.php');
    exit;
}

// Fetch all case studies
$stmt = $pdo->query('SELECT * FROM case_studies ORDER BY id DESC');
$case_studies = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Case Studies</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
</head>
<body>
<div class="container" style="max-width:800px; margin:auto; padding:2rem;">
    <h2>Manage Case Studies</h2>
    <a href="case_study_add.php" class="btn btn-success mb-3">Add New Case Study</a>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Image</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($case_studies as $row): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title']); ?></td>
                <td><img src="../<?php echo htmlspecialchars($row['image']); ?>" alt="" style="max-width:100px;"></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="case_study_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="case_study_list.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this case study?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php">Back to Dashboard</a>
</div>
</body>
</html>
