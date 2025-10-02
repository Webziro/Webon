<?php
// includes/helpers.php - Shared helper functions
// Prevent double inclusion even if the file is referenced using different relative paths
if (defined('WEBON_HELPERS_LOADED')) {
    return;
}
define('WEBON_HELPERS_LOADED', true);
// Diagnostic: log when helpers.php is included and whether create_slug already exists
if (function_exists('create_slug')) {
    error_log('[helpers.php] create_slug() already exists when including helpers.php.');
} else {
    error_log('[helpers.php] create_slug() not yet defined; defining now.');
}
if (!function_exists('webon_create_slug')) {
    function webon_create_slug($str) {
        $str = strtolower(trim($str));
        // replace non letter or digits by -
        $str = preg_replace('~[^\pL\d]+~u', '-', $str);
        // transliterate
        $str = iconv('utf-8', 'us-ascii//TRANSLIT', $str);
        // remove unwanted characters
        $str = preg_replace('~[^-\w]+~', '', $str);
        $str = trim($str, '-');
        // remove duplicate -
        $str = preg_replace('~-+~', '-', $str);
        if (empty($str)) return 'post';
        return $str;
    }
}

// Backwards-compatible wrapper for any legacy code that still calls create_slug()
// Define it only if it doesn't already exist so we don't trigger a redeclare fatal.
if (!function_exists('create_slug')) {
    function create_slug($str) {
        // Proxy to the project-prefixed implementation
        return webon_create_slug($str);
    }
}

// Ensure slug is unique in the news table. Appends -2, -3, ... on conflicts
if (!function_exists('ensure_unique_slug')) {
    function ensure_unique_slug($baseSlug, $pdo, $excludeId = null) {
        // Defensive: check whether the 'slug' column exists before running queries that reference it.
        $slugColumnExists = false;
        try {
            $colStmt = $pdo->prepare("SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'news' AND COLUMN_NAME = 'slug'");
            $colStmt->execute();
            $slugColumnExists = (bool)$colStmt->fetchColumn();
        } catch (Exception $e) {
            // Any failure means we should be conservative and treat the column as missing
            $slugColumnExists = false;
        }

        if (! $slugColumnExists) {
            // Slug column not present yet (migration not applied). Return a safe, short unique slug
            // by appending a short unique suffix to avoid collisions.
            return $baseSlug . '-' . substr(str_replace('.', '', uniqid('', true)), -6);
        }

        $slug = $baseSlug;
        $i = 2;
        while (true) {
            $sql = "SELECT COUNT(*) FROM news WHERE slug = ?";
            $params = [$slug];
            if ($excludeId) {
                $sql .= " AND id != ?";
                $params[] = $excludeId;
            }
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $count = (int)$stmt->fetchColumn();
            if ($count === 0) return $slug;
            $slug = $baseSlug . '-' . $i;
            $i++;
            // safety cap
            if ($i > 1000) return $slug;
        }
    }
}

?>
