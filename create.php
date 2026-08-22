<?php
require_once 'config/db.php';
require_once 'config/auth.php';
requireLogin();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $image = trim($_POST['image'] ?? '');

    if ($title === '' || $content === '' || $category === '') {
        $error = 'Title, category and content are required.';
    } else {
        $stmt = $pdo->prepare(
            "INSERT INTO blogPost (user_id, title, content, category, image)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([currentUserId(), $title, $content, $category, $image ?: null]);

        header("Location: dashboard.php");
        exit;
    }
}

$pageTitle = 'Create Blog';
require 'includes/header.php';
?>

<div class="form-card" style="max-width:850px;">
    <h1>Create a Travel Story</h1>
    <?php if ($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Blog Title</label>
            <input name="title" maxlength="255" required value="<?= e($_POST['title'] ?? '') ?>"
                   placeholder="e.g. The Ultimate Weekend Guide to Ella">
        </div>

        <div class="form-group">
            <label>Category</label>
            <select name="category" required>
                <?php
                $categories = ['Destinations', 'Travel Guides', 'Experiences', 'Travel Stories'];
                foreach ($categories as $cat):
                ?>
                    <option value="<?= e($cat) ?>" <?= (($_POST['category'] ?? '') === $cat) ? 'selected' : '' ?>>
                        <?= e($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Cover Image URL</label>
            <input name="image" value="<?= e($_POST['image'] ?? '') ?>"
                   placeholder="Paste an image URL">
        </div>

        <div class="form-group">
            <label>Content</label>
            <textarea name="content" required placeholder="Write your travel story..."><?= e($_POST['content'] ?? '') ?></textarea>
        </div>

        <button class="btn" type="submit">Publish Story</button>
        <a class="btn secondary" href="dashboard.php">Cancel</a>
    </form>
</div>

<?php require 'includes/footer.php'; ?>
