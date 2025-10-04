<?php
// MODIFIED: Start a session only if one isn't already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in via session
if (isset($_SESSION['user'])) {
    // User is logged in
} 
// Check if the user has a "Remember Me" cookie
elseif (isset($_COOKIE['user_email'])) {
    $_SESSION['user'] = $_COOKIE['user_email'];
} 
// If not logged in, redirect to login page
else {
    // MODIFIED: Redirect to the correct PHP login page
    header("Location: login.php");
    exit();
}
?>

