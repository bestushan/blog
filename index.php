
<?php
require 'includes/config.php';
$stmt = $pdo->query('SELECT * FROM posts ORDER BY created_at DESC');
$posts = $stmt->fetchAll();
include 'includes/header.php';
?>
<?php if (!empty($_GET['msg'])): ?>
    <p class="flash"><?= htmlspecialchars($_GET['msg']) ?></p>
<?php endif; ?>

<section>
    <?php if (empty($posts)): ?>
        <p>No posts yet.
            <?php else: foreach ($posts as $post): ?>
        <article class="post">
            <h2 class="post_header"><a href="view.php?id=<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
            <p class="meta"><?= date('F j, Y, g:i a', strtotime($post['created_at'])) ?></p>
            <p><?= nl2br(htmlspecialchars(strlen($post['content']) > 200 ? substr($post['content'], 0, 200) . '...' : $post['content'])) ?></p>
            <p class="actions">
                <a href="view.php?id=<?= $post['id'] ?>" class="btn">View</a> |
                <a href="edit.php?id=<?= $post['id'] ?>" class="btn">Edit</a> |
            <form method="post" action="delete.php" onsubmit="return confirm('Delete this post?');" style="display:inline">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                <input type="hidden" name="_token" value="<?= csrf_token() ?>">
                <button class="link-button" type="submit">Delete</button>
            </form>
            </p>
        </article>
<?php endforeach;
        endif; ?>
</section>

<?php include 'includes/footer.php'; ?>