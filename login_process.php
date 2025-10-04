<?php
session_start();
require 'db_connect.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    // --- reCAPTCHA Validation ---
    $recaptcha_secret = '6Ldmbt4rAAAAAEtkLsekvbkLzLHC_sfsGLN7ZCwa';
    $recaptcha_response = $_POST['g-recaptcha-response'];
    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_data = [
        'secret' => $recaptcha_secret,
        'response' => $recaptcha_response,
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($recaptcha_data),
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($recaptcha_url, false, $context);
    $result_json = json_decode($result, true);

    if (!$result_json['success']) {
        $_SESSION['error'] = 'CAPTCHA verification failed. Please try again.';
        header('Location: login.php');
        exit();
    }
    // --- End reCAPTCHA Validation ---

    // --- SELECT Operation ---
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // --- Successful Login ---
        $_SESSION['user'] = $user['email'];
        $_SESSION['user_role'] = $user['role'];
        // ... (Remember me cookie logic) ...
        header("Location: index.php");
        exit();
    } else {
        // --- Failed Login ---
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: login.php");
        exit();
    }
}
?>