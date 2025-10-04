<?php
require 'includes/config.php';
$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit($id)) {
  header('Location: index.php');
  exit;
}

$stmt = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
$stmt->execute([':id' => $id]);
$post = $stmt->fetch();
if (!$post) {
  header('Location: index.php');
  exit;
}

include 'includes/header.php';
?>
<article class="post-full">
  <h2><?= htmlspecialchars($post['title']) ?></h2>
  <p class="meta"><?= date('F j, Y, g:i a', strtotime($post['created_at'])) ?></p>
  <div class="content"><?= nl2br(htmlspecialchars($post['content'])) ?></div>
  <p class="actions"><a href="edit.php?id=<?= $post['id'] ?>" class="btn">Edit</a> | <a href="index.php" class="btn">Back</a></p>
</article>
<?php include 'includes/footer.php'; ?>