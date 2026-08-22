<?php
require_once 'config/db.php';
require_once 'config/auth.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $pdo->prepare(
    "SELECT b.*, u.username
     FROM blogPost b
     JOIN user u ON b.user_id = u.id
     WHERE b.id = ?"
);
$stmt->execute([$id]);
$post = $stmt->fetch();

if (!$post) {
    http_response_code(404);
    exit("Blog post not found.");
}

$pageTitle = $post['title'];
require 'includes/header.php';
?>

<div class="container">
    <article class="post">
        <img src="<?= e($post['image'] ?: 'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=1600&q=85') ?>"
             alt="<?= e($post['title']) ?>">

        <div class="post-content">
            <div class="category"><?= e($post['category']) ?></div>
            <h1><?= e($post['title']) ?></h1>
            <p class="meta">
                By <?= e($post['username']) ?> ·
                Published <?= date('d F Y', strtotime($post['created_at'])) ?>
                <?php if ($post['updated_at'] !== $post['created_at']): ?>
                    · Updated <?= date('d F Y', strtotime($post['updated_at'])) ?>
                <?php endif; ?>
            </p>

            <div class="post-text"><?= e($post['content']) ?></div>

            <?php if (isLoggedIn() && currentUserId() === (int)$post['user_id']): ?>
                <div style="margin-top:30px;">
                    <a class="btn" href="edit.php?id=<?= (int)$post['id'] ?>">Edit My Post</a>
                </div>
            <?php endif; ?>
        </div>
    </article>
</div>

<?php require 'includes/footer.php'; ?>
