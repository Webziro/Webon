<?php
// scripts/add_slugs.php
// Safe migration helper to add/populate 'slug' column in `news` and ensure views >= 100.
// Usage: php scripts/add_slugs.php

require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';
require __DIR__ . '/../includes/helpers.php';

echo "Starting slug migration...\n";

try {
    // 1) Add slug column if not exists
    $pdo->exec("ALTER TABLE `news` ADD COLUMN IF NOT EXISTS `slug` VARCHAR(255) DEFAULT NULL");
    echo "Ensured slug column exists.\n";

    // 2) Populate slugs for rows without slug or empty slug
    $select = $pdo->query("SELECT id, title, slug FROM news");
    $update = $pdo->prepare("UPDATE news SET slug = ? WHERE id = ?");
    $countUpdated = 0;
    foreach ($select->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $id = $row['id'];
        $title = $row['title'] ?? '';
        $existing = $row['slug'] ?? null;
        if ($existing && trim($existing) !== '') continue;
        $base = webon_create_slug($title ?: 'post');
        $slug = ensure_unique_slug($base, $pdo, null);
        $update->execute([$slug, $id]);
        $countUpdated++;
    }
    echo "Populated slugs for {$countUpdated} rows.\n";

    // 3) Add unique index if not present
    try {
        $pdo->exec("ALTER TABLE `news` ADD UNIQUE INDEX `uniq_slug` (`slug`)");
        echo "Added unique index on slug.\n";
    } catch (Exception $e) {
        echo "Could not add unique index (maybe already exists or duplicates remain): " . $e->getMessage() . "\n";
    }

    // 4) Ensure views >= 100 and set default
    $pdo->exec("UPDATE news SET views = 100 WHERE views IS NULL OR views < 100");
    echo "Updated views to minimum 100.\n";
    try {
        $pdo->exec("ALTER TABLE news MODIFY `views` INT NOT NULL DEFAULT 100");
        echo "Set views column default to 100.\n";
    } catch (Exception $e) {
        echo "Could not modify views default: " . $e->getMessage() . "\n";
    }

    echo "Migration complete. Please verify results in the database and test slug URLs.\n";
} catch (Exception $ex) {
    echo "Migration failed: " . $ex->getMessage() . "\n";
    exit(1);
}
