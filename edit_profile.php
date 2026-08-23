<?php
require_once 'config/db.php';
require_once 'config/auth.php';
requireLogin();

$userId = currentUserId();

$errors = [];

/* Get current user */
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

if (!$user) {
    header("Location: logout.php");
    exit;
}


/* Handle form submission */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');

    /* Validation */

    if ($username === '') {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must contain at least 3 characters.";
    }

    if ($email === '') {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }


    /* Check username / email uniqueness */

    if (!$errors) {

        $stmt = $pdo->prepare("
            SELECT id
            FROM user
            WHERE (username = ? OR email = ?)
            AND id != ?
            LIMIT 1
        ");

        $stmt->execute([
            $username,
            $email,
            $userId
        ]);

        $existingUser = $stmt->fetch();

        if ($existingUser) {

            /* Check which field is duplicated */

            $stmt = $pdo->prepare("
                SELECT id
                FROM user
                WHERE username = ?
                AND id != ?
                LIMIT 1
            ");

            $stmt->execute([
                $username,
                $userId
            ]);

            if ($stmt->fetch()) {
                $errors[] = "That username is already being used.";
            }


            $stmt = $pdo->prepare("
                SELECT id
                FROM user
                WHERE email = ?
                AND id != ?
                LIMIT 1
            ");

            $stmt->execute([
                $email,
                $userId
            ]);

            if ($stmt->fetch()) {
                $errors[] = "That email address is already being used.";
            }

        }

    }


    /* Update profile */

    if (!$errors) {

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


        /* Update session username */

        $_SESSION['username'] = $username;

        header("Location: profile.php?updated=1");
        exit;
    }
}


$pageTitle = 'Edit Profile';

require 'includes/header.php';
?>

<section class="edit-profile-page">

    <div class="edit-profile-container">

        <div class="edit-profile-header">

            <a href="profile.php" class="back-profile">
                ← Back to Profile
            </a>

            <span class="profile-eyebrow">
                ACCOUNT SETTINGS
            </span>

            <h1>
                Edit your profile
            </h1>

            <p>
                Keep your WanderLanka profile information up to date.
            </p>

        </div>


        <?php if ($errors): ?>

            <div class="profile-alert profile-alert-error">

                <strong>
                    Please check the following:
                </strong>

                <ul>

                    <?php foreach ($errors as $error): ?>

                        <li><?= e($error) ?></li>

                    <?php endforeach; ?>

                </ul>

            </div>

        <?php endif; ?>


        <div class="edit-profile-card">

            <div class="edit-profile-avatar">
                <?= strtoupper(substr($user['username'], 0, 1)) ?>
            </div>


            <div class="edit-profile-form">

                <form method="post">

                    <div class="form-section-heading">

                        <h2>
                            Personal Information
                        </h2>

                        <p>
                            Update the information associated with your account.
                        </p>

                    </div>


                    <div class="profile-form-group">

                        <label for="username">
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="<?= e($_POST['username'] ?? $user['username']) ?>"
                            required
                            minlength="3"
                        >

                        <small>
                            This name will appear on your WanderLanka profile.
                        </small>

                    </div>


                    <div class="profile-form-group">

                        <label for="email">
                            Email Address
                        </label>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="<?= e($_POST['email'] ?? $user['email']) ?>"
                            required
                        >

                        <small>
                            Use an email address that you regularly access.
                        </small>

                    </div>


                    <div class="profile-form-actions">

                        <a href="profile.php" class="profile-cancel-btn">
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="profile-save-btn"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>


        <div class="profile-security-note">

            <div class="security-icon">
                ✓
            </div>

            <div>

                <strong>
                    Your account is secure
                </strong>

                <p>
                    Your profile information is only visible according
                    to the functionality provided by WanderLanka.
                </p>

            </div>

        </div>

    </div>

</section>

<?php require 'includes/footer.php'; ?>