<?php
require_once 'config/db.php';
require_once 'config/auth.php';

if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $error = 'All fields are required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Enter a valid email address.';
    } elseif (strlen($password) < 6) {
        $error = 'Password must contain at least 6 characters.';
    } else {
        $check = $pdo->prepare("SELECT id FROM user WHERE email = ?");
        $check->execute([$email]);

        if ($check->fetch()) {
            $error = 'An account with this email already exists.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO user (username, email, password, role) VALUES (?, ?, ?, 'user')");
            $stmt->execute([$username, $email, $hash]);

            header("Location: login.php?registered=1");
            exit;
        }
    }
}

$pageTitle = 'Register';
require 'includes/header.php';
?>

<div class="form-card">
    <h1>Create your account</h1>
    <?php if ($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label>Username</label>
            <input name="username" required value="<?= e($_POST['username'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required value="<?= e($_POST['email'] ?? '') ?>">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" required minlength="6">
        </div>
        <button class="btn" type="submit">Register</button>
    </form>

    <p style="margin-top:18px;">Already registered? <a style="color:var(--green)" href="login.php">Login</a></p>
</div>

<?php require 'includes/footer.php'; ?>
