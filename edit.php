<?php
require 'includes/config.php';

$id = $_GET['id'] ?? null;
if (!$id || !ctype_digit($id)) { header('Location: index.php'); exit; }

$stmt = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
$stmt->execute([':id' => $id]);
$post = $stmt->fetch();
if (!$post) { header('Location: index.php'); exit; }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title === '') $errors[] = 'Title required';
    if ($content === '') $errors[] = 'Content required';

    if (!$errors) {
        $stmt = $pdo->prepare('UPDATE posts SET title = :title, content = :content WHERE id = :id');
        $stmt->execute([':title' => $title, ':content' => $content, ':id' => $id]);
        header('Location: view.php?id=' . $id . '&msg=' . urlencode('Post updated'));
        exit;
    }
} else {
    $title = $post['title'];
    $content = $post['content'];
}

include 'includes/header.php';
?>
<h2>Edit Post</h2>
<?php if($errors): ?>
  <div class="errors"><ul><?php foreach($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?></ul></div>
<?php endif; ?>

<form method="post" action="">
  <label>Title
    <input type="text" name="title" value="<?= htmlspecialchars($title) ?>">
  </label>
  <label>Content
    <textarea name="content" rows="10"><?= htmlspecialchars($content) ?></textarea>
  </label>
  <input type="hidden" name="_token" value="<?= csrf_token() ?>">
  <button type="submit">Update</button>
</form>

<?php include 'includes/footer.php'; ?>
