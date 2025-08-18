<?php
// admin/index.php - Admin dashboard for Webon App
session_start();
// Simple authentication (for demo, replace with secure login later)
if (!isset($_SESSION['admin'])) {
    if (isset($_POST['password']) && $_POST['password'] === 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: index.php');
        exit;
    }
    echo '<form method="post"><input type="password" name="password" placeholder="Admin Password"><button type="submit">Login</button></form>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Webon App</title>
    <link rel="stylesheet" href="../css/vendor/bootstrap.min.css">
    <style>
        body { padding: 2rem; }
        .container { max-width: 600px; margin: auto; }
    </style>
</head>
<body>
<div class="container">
    <h2>Admin Dashboard</h2>
    <ul>
        <li><a href="featured_add.php">Add Featured Project</a></li>
        <li><a href="featured_list.php">Manage Featured Projects</a></li>
        <!-- Add more links for other features/tables here -->
    </ul>
    <form method="post" action="logout.php"><button type="submit">Logout</button></form>
</div>
</body>
</html>
