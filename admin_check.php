<?php
// This script checks if the logged-in user is an administrator.
// If not, it redirects them to the homepage.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // Redirect non-admin users to the homepage
    header("Location: index.php");
    exit();
}
?>

