<?php
require_once 'config/db.php';
require_once 'config/auth.php';

$pageTitle = 'Home';

$category = $_GET['category'] ?? '';
$search = trim($_GET['search'] ?? '');

$sql = "SELECT b.*, u.username
        FROM blogPost b
        JOIN user u ON b.user_id = u.id
        WHERE 1=1";
$params = [];

if ($category !== '') {
    $sql .= " AND b.category = ?";
    $params[] = $category;
}

if ($search !== '') {
    $sql .= " AND (b.title LIKE ? OR b.content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$sql .= " ORDER BY b.created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$posts = $stmt->fetchAll();

require 'includes/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <p class="category" style="color:#a7f3d0;">SRI LANKA TRAVEL STORIES</p>
        <h1>Discover the island beyond the map.</h1>
        <p>Travel guides, destination stories and unforgettable experiences from Sri Lanka.</p>
        <a class="btn" href="#latest">Explore Stories</a>
    </div>
</section>

<div class="container" id="latest">
    <div class="section-head">
        <div>
            <p class="category">WanderLanka Journal</p>
            <h2><?= $category ? e($category) : 'Latest Journeys' ?></h2>
        </div>
        <?php if (isLoggedIn()): ?>
            <a class="btn" href="create.php">+ New Blog</a>
        <?php endif; ?>
    </div>

    <form method="get" style="display:flex; gap:10px; margin-bottom:25px;">
        <?php if ($category): ?><input type="hidden" name="category" value="<?= e($category) ?>"><?php endif; ?>
        <input name="search" value="<?= e($search) ?>" placeholder="Search travel stories...">
        <button class="btn" type="submit">Search</button>
    </form>

    <?php if (!$posts): ?>
        <div class="empty">
            <h3>No blog posts found</h3>
            <p>Register and create the first WanderLanka story.</p>
        </div>
    <?php else: ?>
        <div class="grid">
            <?php foreach ($posts as $post): ?>
                <article class="card">
                    <img class="card-image"
                         src="<?= e($post['image'] ?: 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1000&q=80') ?>"
                         alt="<?= e($post['title']) ?>">
                    <div class="card-body">
                        <div class="category"><?= e($post['category']) ?></div>
                        <h3><a href="post.php?id=<?= (int)$post['id'] ?>"><?= e($post['title']) ?></a></h3>
                        <p class="meta">By <?= e($post['username']) ?> · <?= date('d M Y', strtotime($post['created_at'])) ?></p>
                        <p style="margin-top:12px;">
                            <?= e(mb_strimwidth(preg_replace('/\s+/', ' ', $post['content']), 0, 125, '...')) ?>
                        </p>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <section style="margin-top:55px;">
        <div class="section-head">
            <div>
                <p class="category">Explore</p>
                <h2>Travel by Interest</h2>
            </div>
        </div>
        <div class="categories">
            <a class="category-box" href="index.php?category=Destinations">Destinations</a>
            <a class="category-box" href="index.php?category=Travel%20Guides">Travel Guides</a>
            <a class="category-box" href="index.php?category=Experiences">Experiences</a>
            <a class="category-box" href="index.php?category=Travel%20Stories">Travel Stories</a>
        </div>
    </section>
</div>

<?php require 'includes/footer.php'; ?>
