<?php
// includes/helpers.php - Shared helper functions
// Diagnostic: log when helpers.php is included and whether create_slug already exists
if (function_exists('create_slug')) {
    error_log('[helpers.php] create_slug() already exists when including helpers.php.');
} else {
    error_log('[helpers.php] create_slug() not yet defined; defining now.');
}
if (!function_exists('create_slug')) {
    function create_slug($str) {
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

// Ensure slug is unique in the news table. Appends -2, -3, ... on conflicts
if (!function_exists('ensure_unique_slug')) {
    function ensure_unique_slug($baseSlug, $pdo, $excludeId = null) {
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
