<?php
// login_process.php

session_start();

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get and sanitize input
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // Validate email (.com or .in domains only)
    if (!preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+\.(com|in)$/i', $email)) {
        $_SESSION['error'] = "Please enter a valid email ending with .com or .in.";
        header("Location: login.html");
        exit();
    }

    // Validate password (min 8 chars, 1 uppercase, 1 lowercase, 1 number)
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $_SESSION['error'] = "Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, and one number.";
        header("Location: login.html");
        exit();
    }

    // Dummy user credentials for demonstration
    $valid_email = "user@example.com";
    $valid_password = "Password123";

    // Check credentials (replace with database check in production)
    if (strtolower($email) === strtolower($valid_email) && $password === $valid_password) {
        $_SESSION['user'] = $email;
        header("Location: index.html");
        exit();
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: login.html");
        exit();
    }
} else {
    header("Location: login.html");
    exit();
}
?>