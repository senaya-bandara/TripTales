<?php
require_once 'config/db.php';
require_once 'config/auth.php';

requireLogin();

$userId = currentUserId();

$message = '';
$error = '';

/* =========================================================
   UPDATE PROFILE
========================================================= */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($username === '' || $email === '') {

        $error = 'Username and email are required.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Please enter a valid email address.';

    } else {

        try {

            $stmt = $pdo->prepare("
                UPDATE user
                SET username = ?, email = ?
                WHERE id = ?
            ");

            $stmt->execute([
                $username,
                $email,
                $userId
            ]);

            /*
             * Keep session username updated
             */
            $_SESSION['username'] = $username;

            $message = 'Profile updated successfully.';

        } catch (PDOException $e) {

            $error = 'Unable to update your profile.';

        }

    }
}


/* =========================================================
   GET USER
========================================================= */

$stmt = $pdo->prepare("
    SELECT *
    FROM user
    WHERE id = ?
");

$stmt->execute([$userId]);

$user = $stmt->fetch();

if (!$user) {
    die('User not found.');
}


/* =========================================================
   GET USER STORIES
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
   STATISTICS
========================================================= */

$totalStories = count($posts);

$categories = [];

foreach ($posts as $post) {

    if (!empty($post['category'])) {
        $categories[$post['category']] = true;
    }

}

$totalCategories = count($categories);


$pageTitle = 'My Profile';

require 'includes/header.php';
?>


<main>

<section class="profile-page">

    <div class="profile-container">


        <!-- =================================================
             WELCOME BAR
        ================================================== -->

        <div class="profile-welcome-bar">

            <div>

                <span class="profile-welcome-small">
                    WANDERLANKA
                </span>

                <h1>
                    Welcome back,
                    <?= e($user['username']) ?>
                </h1>

            </div>

        </div>



        <!-- =================================================
             PROFILE INFORMATION
        ================================================== -->

        <section class="profile-information">

            <div class="profile-information-heading">

                <div>

                    <span>
                        ACCOUNT
                    </span>

                    <h2>
                        Profile Information
                    </h2>

                </div>

                <p>
                    Update your account details below.
                </p>

            </div>


            <?php if ($message): ?>

                <div class="profile-success">
                    <?= e($message) ?>
                </div>

            <?php endif; ?>


            <?php if ($error): ?>

                <div class="profile-error">
                    <?= e($error) ?>
                </div>

            <?php endif; ?>


            <form
                method="POST"
                class="profile-form"
            >

                <!-- Username -->

                <div class="profile-form-row">

                    <label for="username">
                        Username
                    </label>

                    <div class="profile-form-field">

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="<?= e($user['username']) ?>"
                            required
                        >

                    </div>

                </div>


                <!-- Email -->

                <div class="profile-form-row">

                    <label for="email">
                        Email Address
                    </label>

                    <div class="profile-form-field">

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= e($user['email']) ?>"
                            required
                        >

                    </div>

                </div>


                <!-- Member Since -->

                <div class="profile-form-row">

                    <label>
                        Member Since
                    </label>

                    <div class="profile-form-static">

                        <?= date(
                            'd M Y',
                            strtotime($user['created_at'])
                        ) ?>

                    </div>

                </div>


                <!-- Save -->

                <div class="profile-form-actions">

                    <button
                        type="submit"
                        class="profile-save-btn"
                    >
                        Save Changes
                    </button>

                </div>

            </form>

        </section>



        <!-- =================================================
             PROFILE STATISTICS
        ================================================== -->

        <section class="profile-stats">

            <div class="stat-card">

                <div class="stat-icon">
                    ✦
                </div>

                <div>

                    <strong>
                        <?= $totalStories ?>
                    </strong>

                    <span>
                        Stories Published
                    </span>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ◇
                </div>

                <div>

                    <strong>
                        <?= $totalCategories ?>
                    </strong>

                    <span>
                        Categories
                    </span>

                </div>

            </div>


            <div class="stat-card">

                <div class="stat-icon">
                    ↗
                </div>

                <div>

                    <strong>
                        Wanderer
                    </strong>

                    <span>
                        Membership
                    </span>

                </div>

            </div>

        </section>



        <!-- =================================================
             YOUR JOURNEY
        ================================================== -->

        <section class="profile-section-heading">

            <div>

                <span>
                    YOUR JOURNEY
                </span>

                <h2>
                    Your WanderLanka
                </h2>

            </div>

            <div>
                Manage your stories and explore the community.
            </div>

        </section>



        <!-- =================================================
             ACTION TILES
        ================================================== -->

        <section class="profile-actions">


            <a
                href="create.php"
                class="profile-action-card"
            >

                <div class="action-icon">
                    +
                </div>

                <div>

                    <h3>
                        Create Story
                    </h3>

                    <p>
                        Share your latest travel experience.
                    </p>

                </div>

                <span class="action-arrow">
                    →
                </span>

            </a>



            <a
                href="dashboard.php"
                class="profile-action-card"
            >

                <div class="action-icon">
                    ▦
                </div>

                <div>

                    <h3>
                        My Dashboard
                    </h3>

                    <p>
                        Manage and edit your stories.
                    </p>

                </div>

                <span class="action-arrow">
                    →
                </span>

            </a>



            <a
                href="index.php#latest"
                class="profile-action-card"
            >

                <div class="action-icon">
                    ◇
                </div>

                <div>

                    <h3>
                        Explore Blogs
                    </h3>

                    <p>
                        Discover stories from other travellers.
                    </p>

                </div>

                <span class="action-arrow">
                    →
                </span>

            </a>

        </section>


    </div>

</section>

</main>


<?php require 'includes/footer.php'; ?>