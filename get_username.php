<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $users = file('users.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $username = '';

    foreach ($users as $user_line) {
        $user_data = explode(',', $user_line);
        if (isset($user_data[1]) && strtolower($email) === strtolower($user_data[1])) {
            $username = $user_data[0];
            break;
        }
    }

    if ($username) {
        echo json_encode(['username' => $username]);
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    echo json_encode(['error' => 'Not logged in']);
}
?>