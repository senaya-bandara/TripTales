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
        <a class="logo" href="/wanderlanka/index.php">
            <span>W</span> WanderLanka
        </a>
        <nav>
            <a href="/wanderlanka/index.php">Home</a>
            <a href="/wanderlanka/index.php?category=Destinations">Destinations</a>
            <a href="/wanderlanka/index.php?category=Travel Guides">Travel Guides</a>
            <a href="/wanderlanka/index.php?category=Experiences">Experiences</a>
            <?php if (isLoggedIn()): ?>
                <a href="/wanderlanka/dashboard.php">Dashboard</a>
                <a class="nav-button" href="/wanderlanka/logout.php">Logout</a>
            <?php else: ?>
                <a href="/wanderlanka/login.php">Login</a>
                <a class="nav-button" href="/wanderlanka/register.php">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main>
