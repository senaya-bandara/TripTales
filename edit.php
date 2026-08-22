<?php
require_once 'config/db.php';
require_once 'config/auth.php';
requireLogin();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: dashboard.php");
    exit;
}

// Ownership check: user can only retrieve their own post.
$stmt = $pdo->prepare("SELECT * FROM blogPost WHERE id = ? AND user_id = ?");
$stmt->execute([$id, currentUserId()]);
$post = $stmt->fetch();

if (!$post) {
    http_response_code(403);
    exit("Unauthorized: You can only edit your own blog posts.");
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if ($title === '' || $content === '' || $category === '') {
        $error = 'Title, category and content are required.';
    } else {
        // Ownership is checked again in the UPDATE condition.
        $update = $pdo->prepare(
            "UPDATE blogPost
             SET title = ?, category = ?, content = ?, image = ?
             WHERE id = ? AND user_id = ?"
        );
        $update->execute([$title, $category, $content, $image ?: null, $id, currentUserId()]);

        header("Location: dashboard.php");
        exit;
    }
}

$pageTitle = 'Edit Blog';
require 'includes/header.php';
?>

<div class="form-card" style="max-width:850px;">
    <h1>Edit Travel Story</h1>
    <?php if ($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Blog Title</label>
            <input name="title" maxlength="255" required value="<?= e($_POST['title'] ?? $post['title']) ?>">
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category" required>
                <?php
                $categories = ['Destinations', 'Travel Guides', 'Experiences', 'Travel Stories'];
                $selected = $_POST['category'] ?? $post['category'];
                foreach ($categories as $cat):
                ?>
                    <option value="<?= e($cat) ?>" <?= $selected === $cat ? 'selected' : '' ?>>
                        <?= e($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Cover Image URL</label>
            <input name="image" value="<?= e($_POST['image'] ?? ($post['image'] ?? '')) ?>">
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" required><?= e($_POST['content'] ?? $post['content']) ?></textarea>
        </div>

        <button class="btn" type="submit">Save Changes</button>
        <a class="btn secondary" href="dashboard.php">Cancel</a>
    </form>
</div>

<?php require 'includes/footer.php'; ?>
