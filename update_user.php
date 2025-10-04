<?php
session_start();
require 'db_connect.php';
include 'check_login.php';
include 'admin_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $username = trim($_POST['username'] ?? '');
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $role = trim($_POST['role'] ?? '');
    $status = trim($_POST['status'] ?? '');

    if ($id && !empty($username) && !empty($email) && in_array($role, ['user', 'admin']) && in_array($status, ['active', 'inactive'])) {
        try {
            $sql = "UPDATE users SET username = ?, email = ?, role = ?, status = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $email, $role, $status, $id]);
            header("Location: manage_users.php");
            exit();
        } catch (PDOException $e) {
            // Handle error
            header("Location: edit_user.php?id=" . $id . "&error=1");
            exit();
        }
    } else {
        // Handle invalid data
        header("Location: edit_user.php?id=" . $id . "&error=1");
        exit();
    }
}