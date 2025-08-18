<?php
    // featured_fetch.php - Fetch featured projects from database
    require_once 'db.php';

    $stmt = $pdo->query('SELECT * FROM featured_projects ORDER BY created_at ASC');
    $featured = $stmt->fetchAll();
?>
