<?php
session_start();
session_unset();
session_destroy();

// Clear the "Remember Me" cookie
if (isset($_COOKIE['user_email'])) {
    unset($_COOKIE['user_email']);
    setcookie('user_email', '', time() - 3600, '/'); // Set to a past time to expire it
}

header("Location: index.php");
exit();
?>