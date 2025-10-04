<?php
session_start();
require 'db_connect.php';
include 'check_login.php';
include 'admin_check.php';

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        $sql = "DELETE FROM offers WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        $_SESSION['success_message'] = "Offer deleted successfully!";
        header("Location: manage_offers.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION['error_message'] = "Error deleting offer.";
        header("Location: manage_offers.php");
        exit();
    }
} else {
    $_SESSION['error_message'] = "Invalid offer ID.";
    header("Location: manage_offers.php");
    exit();
}
?>
