<?php
session_start();
require 'db_connect.php';
include 'check_login.php';
include 'admin_check.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        header("Location: manage_users.php");
        exit();
    } catch (PDOException $e) {
        // Handle error
        header("Location: manage_users.php?error=1");
        exit();
    }
} else {
    header("Location: manage_users.php");
    exit();
}