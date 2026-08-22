<?php
require_once 'config/db.php';
require_once 'config/auth.php';
requireLogin();

$stmt = $pdo->prepare("SELECT * FROM blogPost WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([currentUserId()]);
$posts = $stmt->fetchAll();

$pageTitle = 'Dashboard';
require 'includes/header.php';
?>

<div class="container">
    <div class="section-head">
        <div>
            <p class="category">Welcome, <?= e($_SESSION['username']) ?></p>
            <h1>My Travel Stories</h1>
        </div>
        <a class="btn" href="create.php">+ Create Blog</a>
    </div>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert success">Blog post deleted successfully.</div>
    <?php endif; ?>

    <?php if (!$posts): ?>
        <div class="empty">
            <h3>You have not created any posts yet.</h3>
            <p style="margin:10px 0 20px;">Share your first travel story.</p>
            <a class="btn" href="create.php">Create First Post</a>
        </div>
    <?php else: ?>
        <div style="overflow-x:auto;">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= e($post['title']) ?></td>
                        <td><?= e($post['category']) ?></td>
                        <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                        <td><?= date('d M Y', strtotime($post['updated_at'])) ?></td>
                        <td>
                            <div class="actions">
                                <a class="btn small secondary" href="post.php?id=<?= (int)$post['id'] ?>">View</a>
                                <a class="btn small" href="edit.php?id=<?= (int)$post['id'] ?>">Edit</a>
                                <form class="delete-form" action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?= (int)$post['id'] ?>">
                                    <button class="btn small danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require 'includes/footer.php'; ?>
