<?php

require_once 'config/db.php';
require_once 'config/auth.php';

requireLogin();

$userId  = currentUserId();
$username = $_SESSION['username'] ?? 'Traveler';


/* =========================================================
   GET USER'S POSTS
========================================================= */

$stmt = $pdo->prepare("
    SELECT *
    FROM blogPost
    WHERE user_id = ?
    ORDER BY created_at DESC
");

$stmt->execute([$userId]);

$posts = $stmt->fetchAll();


/* =========================================================
   DASHBOARD STATISTICS
========================================================= */

$totalPosts = count($posts);


/* Categories */

$categoryCounts = [];

foreach ($posts as $post) {

    $category = trim($post['category'] ?? '');

    if ($category === '') {
        $category = 'Uncategorized';
    }

    if (!isset($categoryCounts[$category])) {
        $categoryCounts[$category] = 0;
    }

    $categoryCounts[$category]++;
}

$totalCategories = count($categoryCounts);


/* Total Words */

$totalWords = 0;

foreach ($posts as $post) {

    $content = strip_tags($post['content'] ?? '');

    $totalWords += str_word_count($content);
}


/* Most Used Category */

$topCategory = '—';

if (!empty($categoryCounts)) {

    arsort($categoryCounts);

    $topCategory = array_key_first($categoryCounts);
}


/* Latest Story */

$latestPost = $posts[0] ?? null;


/* Page Title */

$pageTitle = 'Dashboard';

require 'includes/header.php';

?>


<div class="dashboard-page">

    <div class="dashboard-container">


        <!-- =====================================================
             HERO
        ====================================================== -->

        <section class="dashboard-hero">

            <div class="dashboard-hero-inner">

                <div class="dashboard-hero-copy">

                    <p class="dashboard-eyebrow">
                        WanderLanka Creator Space
                    </p>

                    <h1>
                        Welcome back,
                        <span><?= e($username) ?></span>
                    </h1>

                    <p class="dashboard-intro">
                        Your stories, journeys and memories — all in one place.
                        Keep exploring and sharing Sri Lanka with the world.
                    </p>

                    <a
                        href="create.php"
                        class="dashboard-primary-btn"
                    >
                        <span class="btn-plus">+</span>
                        Create New Story
                    </a>

                </div>

            </div>

        </section>



        <!-- =====================================================
             STATISTICS
        ====================================================== -->

        <div class="dashboard-stats">

<div class="stat-tile">
    <div class="stat-label">Total Stories</div>
    <div class="stat-number"><?= $totalPosts ?></div>
    <div class="stat-description">Your published journeys</div>
</div>

<div class="stat-tile">
    <div class="stat-label">Categories</div>
    <div class="stat-number"><?= $totalCategories ?></div>
    <div class="stat-description">Topics you've explored</div>
</div>

<div class="stat-tile">
    <div class="stat-label">Words Written</div>
    <div class="stat-number"><?= $totalWords ?></div>
    <div class="stat-description">Your travel journal</div>
</div>

<div class="stat-tile">
    <div class="stat-label">Top Interest</div>
    <div class="stat-number"><?= e($topCategory) ?></div>
    <div class="stat-description">Your favourite topic</div>
</div>

</div>

        <!-- =====================================================
             QUICK ACTIONS
        ====================================================== -->

        <section class="dashboard-actions">

            <div class="dashboard-section-heading">

                <div>

                    <p class="dashboard-section-label">
                        Quick Actions
                    </p>

                    <h2>
                        What would you like to do?
                    </h2>

                </div>

            </div>


            <div class="quick-actions">


                <!-- Write -->

                <a
                    href="create.php"
                    class="quick-action quick-action-featured"
                >

                    <span class="quick-action-icon">
                        +
                    </span>

                    <span class="quick-action-content">

                        <strong>
                            Write a Story
                        </strong>

                        <small>
                            Share your next Sri Lankan adventure.
                        </small>

                    </span>

                    <span class="quick-arrow">
                        →
                    </span>

                </a>



                <!-- Explore -->

                <a
                    href="index.php"
                    class="quick-action"
                >

                    <span class="quick-action-icon">
                        ◉
                    </span>

                    <span class="quick-action-content">

                        <strong>
                            Explore Stories
                        </strong>

                        <small>
                            Discover journeys from other travelers.
                        </small>

                    </span>

                    <span class="quick-arrow">
                        →
                    </span>

                </a>



                <!-- Profile -->

                <a
                    href="profile.php"
                    class="quick-action"
                >

                    <span class="quick-action-icon">
                        ○
                    </span>

                    <span class="quick-action-content">

                        <strong>
                            My Profile
                        </strong>

                        <small>
                            Manage your WanderLanka profile.
                        </small>

                    </span>

                    <span class="quick-arrow">
                        →
                    </span>

                </a>

            </div>

        </section>



        <!-- =====================================================
             LATEST JOURNEY
        ====================================================== -->

        <?php if ($latestPost): ?>

            <section class="latest-journey">

                <div class="latest-journey-heading">

                    <div>

                        <p class="latest-eyebrow">
                            Your Latest Journey
                        </p>

                        <h2>
                            Continue your story
                        </h2>

                    </div>

                    <a
                        href="post.php?id=<?= (int)$latestPost['id'] ?>"
                        class="latest-story-link"
                    >
                        View Story →
                    </a>

                </div>



                <article class="latest-story">


                    <!-- Story Image -->

                    <a
                        href="post.php?id=<?= (int)$latestPost['id'] ?>"
                        class="latest-story-image"
                    >

                        <img
                            src="<?= e(
                                !empty($latestPost['image'])
                                    ? $latestPost['image']
                                    : 'assets/images/image1.jpg'
                            ) ?>"
                            alt="<?= e($latestPost['title']) ?>"
                        >

                    </a>



                    <!-- Story Details -->

                    <div class="latest-story-content">


                        <div class="latest-story-meta">

                            <?php if (!empty($latestPost['category'])): ?>

                                <span class="latest-story-category">
                                    <?= e($latestPost['category']) ?>
                                </span>

                            <?php endif; ?>


                            <span class="latest-story-date">

                                <?= date(
                                    'd M Y',
                                    strtotime($latestPost['created_at'])
                                ) ?>

                            </span>

                        </div>



                        <h3>

                            <a
                                href="post.php?id=<?= (int)$latestPost['id'] ?>"
                            >
                                <?= e($latestPost['title']) ?>
                            </a>

                        </h3>



                        <p>

                            <?= e(
                                mb_strimwidth(
                                    preg_replace(
                                        '/\s+/',
                                        ' ',
                                        strip_tags(
                                            $latestPost['content'] ?? ''
                                        )
                                    ),
                                    0,
                                    180,
                                    '...'
                                )
                            ) ?>

                        </p>



                        <a
                            href="post.php?id=<?= (int)$latestPost['id'] ?>"
                            class="latest-read-link"
                        >
                            Read Story →
                        </a>

                    </div>

                </article>

            </section>

        <?php endif; ?>



        <!-- =====================================================
             EMPTY STATE
        ====================================================== -->

        <?php if (!$latestPost): ?>

            <section class="dashboard-empty">

                <p class="dashboard-section-label">
                    Your Journey
                </p>

                <h2>
                    Your first story starts here.
                </h2>

                <p>
                    Share a place you've visited, an experience you've had,
                    or a journey you'd like others to discover.
                </p>

                <a
                    href="create.php"
                    class="dashboard-primary-btn"
                >
                    <span class="btn-plus">+</span>
                    Create Your First Story
                </a>

            </section>

        <?php endif; ?>



        <!-- =====================================================
             FOOTER QUOTE
        ====================================================== -->

        <section class="dashboard-quote">

<div class="quote-line"></div>

<blockquote>
    “Every journey becomes a story when you choose to remember it.”
</blockquote>

<cite>
    — WanderLanka
</cite>

</section>

    </div>

</div>


<?php require 'includes/footer.php'; ?>