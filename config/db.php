<?php

$host = "sql104.infinityfree.com";
$db = "if0_42725510_wanderlanka";
$user = "if0_42725510";
$pass = "B5IinW9yIYfT0hI";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8mb4",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>