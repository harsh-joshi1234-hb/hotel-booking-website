<?php
session_start();
require 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
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
        header('Location: SingUp.php');
        exit();
    }
    // --- End reCAPTCHA Validation ---

    // --- Server-Side Input Validation ---
    $errors = [];
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }
    if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.";
    }

    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
        header("Location: SingUp.php");
        exit();
    }
    // --- End Validation ---

    // --- Check if user already exists ---
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $_SESSION['error'] = "An account with this email already exists.";
        header("Location: SingUp.php");
        exit();
    }

    // --- INSERT Operation ---
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $email, $hashed_password]);

        // Automatically log the user in
        $_SESSION['user'] = $email;
        header("Location: index.php");
        exit();

    } catch (\PDOException $e) {
        // Handle insertion error
        $_SESSION['error'] = "Could not register account. Please try again later.";
        header("Location: SingUp.php");
        exit();
    }
}
?>