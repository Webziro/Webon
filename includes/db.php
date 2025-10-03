<?php
// db.php - Database connection for webon-app
$host = 'localhost';
$db   = 'webon_app';
$user = 'root'; // Change if you use a different MySQL user
$pass = '';
$charset = 'utf8mb4';
$pass = '';


$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
<!-- db.php - Database connection for webon-app -->