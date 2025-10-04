<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_username = trim($_POST['new_username']);
    $email = $_SESSION['user'];

    // --- UPDATE Operation ---
    try {
        $sql = "UPDATE users SET username = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$new_username, $email]);

        // Redirect back with a success message
        header("Location: profile.php?success=1");
        exit();
    } catch (\PDOException $e) {
        // Handle update error
        header("Location: profile.php?error=1");
        exit();
    }
}
?>