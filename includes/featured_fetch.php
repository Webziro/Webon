<?php
    // featured_fetch.php - Fetch featured projects from database
    require_once 'db.php';

    try {
        // Prefer to fetch only visible projects if the column exists
        $stmt = $pdo->query('SELECT * FROM featured_projects WHERE is_hidden = 0 ORDER BY created_at ASC');
        $featured = $stmt->fetchAll();
    } catch (Exception $e) {
        // If the column doesn't exist or another error occurs, fall back to fetching all
        $stmt = $pdo->query('SELECT * FROM featured_projects ORDER BY created_at ASC');
        $featured = $stmt->fetchAll();
    }
?>
