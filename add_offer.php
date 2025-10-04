<?php
session_start();
require 'db_connect.php';
include 'check_login.php';
include 'admin_check.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $offerName = trim($_POST['offerName'] ?? '');
    $discount = filter_input(INPUT_POST, 'discountPercent', FILTER_VALIDATE_INT);
    $description = trim($_POST['offerDescription'] ?? '');

    if (!empty($offerName) && $discount !== false) {
        try {
            $sql = "INSERT INTO offers (offerName, discountPercent, offerDescription) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$offerName, $discount, $description]);
            $_SESSION['success_message'] = "Offer created successfully!";
            header("Location: manage_offers.php");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error_message'] = "Error creating offer.";
            header("Location: create_offer.php");
            exit();
        }
    } else {
        $_SESSION['error_message'] = "Offer name and discount percentage are required.";
        header("Location: create_offer.php");
        exit();
    }
}
?>
