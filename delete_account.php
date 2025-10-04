
<?php
session_start();
require 'db_connect.php'; // Reuse your connection file

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Prepare and execute the DELETE statement
$sql = "DELETE FROM users WHERE email = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION['user']]);

// Log the user out after deleting the account
header("Location: logout.php");
exit();
?>