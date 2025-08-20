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
<body style="background: #f8f9fa;">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">Webon Admin</a>
    <form method="post" action="logout.php" class="d-flex ms-auto">
      <button type="submit" class="btn btn-outline-light">Logout</button>
    </form>
  </div>
</nav>
<div class="container">
    <h2 class="mb-4 text-center fw-bold">Admin Dashboard</h2>
    <div class="row g-4 justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-star-fill text-warning" style="font-size:2rem;"></i>
                    <h5 class="card-title mt-2">Featured Projects</h5>
                    <a href="featured_add.php" class="btn btn-primary btn-sm m-1">Add Featured Project</a>
                    <a href="featured_list.php" class="btn btn-outline-primary btn-sm m-1">Manage Featured Projects</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-newspaper text-info" style="font-size:2rem;"></i>
                    <h5 class="card-title mt-2">News</h5>
                    <a href="news_add.php" class="btn btn-info btn-sm m-1 text-white">Add News</a>
                    <a href="news_list.php" class="btn btn-outline-info btn-sm m-1">Manage News</a>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-briefcase-fill text-success" style="font-size:2rem;"></i>
                    <h5 class="card-title mt-2">Case Studies</h5>
                    <a href="case_study_add.php" class="btn btn-success btn-sm m-1 text-white">Add Case Study</a>
                    <a href="case_study_list.php" class="btn btn-outline-success btn-sm m-1">Manage Case Studies</a>
                </div>
            </div>
        </div>
        
    </div>
    <!-- Add more dashboard cards here as needed -->
</div>
<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
