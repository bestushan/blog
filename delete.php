<?php
require 'includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

verify_csrf();

$id = $_POST['id'] ?? null;
if (!$id || !ctype_digit($id)) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare('DELETE FROM posts WHERE id = :id');
$stmt->execute([':id' => $id]);

header('Location: index.php?msg=' . urlencode('Post deleted'));
exit;
