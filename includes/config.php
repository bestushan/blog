<?php
// includes/config.php
session_start();

// DB settings — change user/password for your environment (don't keep root on prod)
$host = 'localhost';
$db   = 'blog_crud';
$user = 'root';
$pass = '';
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('Database connection failed: ' . $e->getMessage());
}

// CSRF helpers
if (empty($_SESSION['_token'])) {
    $_SESSION['_token'] = bin2hex(random_bytes(32));
}
function csrf_token() {
    return $_SESSION['_token'];
}
function verify_csrf() {
    if (empty($_POST['_token']) || !hash_equals($_SESSION['_token'], $_POST['_token'])) {
        http_response_code(400);
        exit('Invalid CSRF token');
    }
}
