<?php
// Temporary debug helper - remove when done
header('Content-Type: text/plain');

echo "PHP version: " . PHP_VERSION . "\n";

echo "Included files (count): " . count(get_included_files()) . "\n";
foreach (get_included_files() as $f) {
    echo " - " . $f . "\n";
}

echo "\nFunction create_slug exists? ";
if (function_exists('create_slug')) {
    echo "Yes\n";
    $rf = new ReflectionFunction('create_slug');
    echo "Defined in: " . $rf->getFileName() . " on line " . $rf->getStartLine() . "\n";
} else {
    echo "No\n";
}

// Also check for helpers file path variants
$paths = [
    __DIR__ . '/../includes/helpers.php',
    __DIR__ . '/..\\includes\\helpers.php',
    __DIR__ . '/../includes/helpers.php',
    __DIR__ . '/../includes/helpers.php'
];

echo "\nhelpers.php realpath checks:\n";
foreach ($paths as $p) {
    echo "- $p -> ";
    $rp = realpath($p);
    echo ($rp ? $rp : 'NOT FOUND') . "\n";
}

// Show defined constants to confirm include guard
if (defined('WEBON_HELPERS_LOADED')) {
    echo "\nWEBON_HELPERS_LOADED is defined.\n";
} else {
    echo "\nWEBON_HELPERS_LOADED NOT defined.\n";
}

// Show last 200 lines of Apache error log for hints (best-effort)
$log = 'C:/xampp/apache/logs/error.log';
if (file_exists($log)) {
    echo "\nLast lines from Apache error.log:\n";
    $lines = file($log);
    $tail = array_slice($lines, -200);
    foreach ($tail as $line) echo $line;
} else {
    echo "\nApache error log not found at $log\n";
}

?>