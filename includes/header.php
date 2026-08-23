<?php
require_once __DIR__ . '/../config/auth.php';
$pageTitle = $pageTitle ?? 'WanderLanka';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?> | WanderLanka</title>

    <link rel="stylesheet" href="/wanderlanka/assets/css/style.css">
</head>

<body>

<header class="site-header">
    <div class="nav-container">

        <!-- Logo -->
        <a class="logo" href="/wanderlanka/index.php">
    <img
        src="/wanderlanka/assets/images/logo.png"
        alt="WanderLanka"
    >
</a>


<nav class="main-nav">

<a href="/wanderlanka/index.php"
   class="nav-button <?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">
    Home
</a>

<a href="/wanderlanka/index.php#latest"
   class="nav-button">
    Blogs
</a>

<?php if (isLoggedIn()): ?>

    <a href="/wanderlanka/dashboard.php"
       class="nav-button <?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
        Dashboard
    </a>

    <a href="/wanderlanka/profile.php"
       class="nav-button <?= basename($_SERVER['PHP_SELF']) === 'profile.php' ? 'active' : '' ?>">
        Profile
    </a>

    <a href="/wanderlanka/logout.php"
       class="nav-button nav-logout">
        Logout
    </a>

<?php else: ?>

    <a href="/wanderlanka/login.php"
       class="nav-button nav-login <?= basename($_SERVER['PHP_SELF']) === 'login.php' ? 'active' : '' ?>">
        Login
    </a>

    <a href="/wanderlanka/register.php"
       class="nav-button nav-register <?= basename($_SERVER['PHP_SELF']) === 'register.php' ? 'active' : '' ?>">
        Register
    </a>

<?php endif; ?>

</nav>
    </div>
</header>

<main>