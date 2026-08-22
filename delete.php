<?php
require_once 'config/db.php';
require_once 'config/auth.php';
requireLogin();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: dashboard.php");
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

if ($id) {
    // Critical authorization rule:
    // DELETE is allowed only when the post belongs to the logged-in user.
    $stmt = $pdo->prepare("DELETE FROM blogPost WHERE id = ? AND user_id = ?");
    $stmt->execute([$id, currentUserId()]);
}

header("Location: dashboard.php?deleted=1");
exit;
?>