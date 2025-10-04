<?php
session_start();
require 'db_connect.php';
include 'check_login.php';
include 'admin_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $offerName = trim($_POST['offerName'] ?? '');
    $discount = filter_input(INPUT_POST, 'discountPercent', FILTER_VALIDATE_INT);
    $description = trim($_POST['offerDescription'] ?? '');
    $status = trim($_POST['status'] ?? '');

    if ($id && !empty($offerName) && $discount !== false && in_array($status, ['active', 'inactive'])) {
        try {
            $sql = "UPDATE offers SET offerName = ?, discountPercent = ?, offerDescription = ?, status = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$offerName, $discount, $description, $status, $id]);
            $_SESSION['success_message'] = "Offer updated successfully!";
            header("Location: manage_offers.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error updating offer.";
            header("Location: edit_offer.php?id=" . $id);
            exit();
        }
    } else {
        $_SESSION['error_message'] = "All fields are required.";
        header("Location: edit_offer.php?id=" . $id);
        exit();
    }
}
?>
