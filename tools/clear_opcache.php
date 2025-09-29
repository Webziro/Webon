<?php
header('Content-Type: text/plain');

if (function_exists('opcache_reset')) {
    $ok = opcache_reset();
    echo "opcache_reset(): " . ($ok ? "OK" : "Failed or not permitted") . "\n";
    $status = opcache_get_status(false);
    echo "\nOPcache enabled: " . (isset($status['opcache_enabled']) && $status['opcache_enabled'] ? 'yes' : 'no') . "\n";
    if (isset($status['memory_usage'])) {
        echo "Memory usage:\n";
        print_r($status['memory_usage']);
    }
    if (isset($status['opcache_statistics'])) {
        echo "\nStatistics:\n";
        print_r($status['opcache_statistics']);
    }
} else {
    echo "OPcache functions not available in this PHP build.\n";
}

?>