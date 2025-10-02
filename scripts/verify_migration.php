<?php
// scripts/verify_migration.php
require __DIR__ . '/../includes/config.php';
require __DIR__ . '/../includes/db.php';

function pretty($label, $val) {
    echo str_pad($label, 40) . " : " . $val . "\n";
}

echo "Verification report\n";
echo "===================\n";

try {
    // 1) Check slug column exists
    $stmt = $pdo->prepare("SELECT COUNT(*) as c FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'news' AND COLUMN_NAME = 'slug'");
    $stmt->execute();
    $hasSlug = (bool) $stmt->fetchColumn();
    pretty('slug column exists', $hasSlug ? 'yes' : 'no');

    // 2) Count rows without slug
    if ($hasSlug) {
        $stmt = $pdo->query("SELECT COUNT(*) FROM news WHERE slug IS NULL OR slug = ''");
        pretty('rows with empty slug', $stmt->fetchColumn());

        // 3) Duplicate slugs
        $stmt = $pdo->query("SELECT COUNT(*) FROM (SELECT slug FROM news WHERE slug IS NOT NULL AND slug <> '' GROUP BY slug HAVING COUNT(*) > 1) t");
        pretty('duplicate slug groups', $stmt->fetchColumn());

        // 4) Sample rows
        echo "\nSample rows:\n";
        $stmt = $pdo->query("SELECT id, title, slug, views FROM news ORDER BY id DESC LIMIT 10");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) {
            echo "[{$r['id']}] slug={$r['slug']} views={$r['views']} title=" . substr($r['title'],0,60) . "\n";
        }

        // 5) Index check
        $stmt = $pdo->query("SHOW INDEX FROM news WHERE Column_name = 'slug'");
        $indexes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        pretty('slug index present', empty($indexes) ? 'no' : implode(', ', array_unique(array_column($indexes,'Key_name'))));

        // 6) Views default
        $stmt = $pdo->query("SELECT COLUMN_DEFAULT FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'news' AND COLUMN_NAME = 'views'");
        $default = $stmt->fetchColumn();
        pretty('views default', $default === null ? 'NULL' : $default);

        // 7) Views minimum check
        $stmt = $pdo->query("SELECT COUNT(*) FROM news WHERE views < 100 OR views IS NULL");
        pretty('rows with views < 100', $stmt->fetchColumn());
    }

} catch (Exception $e) {
    echo "Verification failed: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\nDone.\n";
