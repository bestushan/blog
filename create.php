<?php
require 'includes/config.php';
$errors = [];
$title = '';
$content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $title = trim($_POST['title'] ?? '');
    $content = trim($_POST['content'] ?? '');
    if ($title === '') $errors[] = 'Title is required';
    if ($content === '') $errors[] = 'Content is required';

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO posts (title, content) VALUES (:title, :content)');
        $stmt->execute([':title' => $title, ':content' => $content]);
        header('Location: index.php?msg=' . urlencode('Post created'));
        exit;
    }
}

include 'includes/header.php';
?>
<h2>Create Post</h2>
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
  <button type="submit">Create</button>
</form>

<?php include 'includes/footer.php'; ?>
