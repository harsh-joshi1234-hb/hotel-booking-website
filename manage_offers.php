<?php
session_start();
require 'db_connect.php';
include 'check_login.php'; // Ensures user is logged in
include 'admin_check.php'; // Ensures user is an admin

// Fetch all offers from the database, ordering by the most recently created
try {
    $stmt = $pdo->query("SELECT * FROM offers ORDER BY id DESC");
    $offers = $stmt->fetchAll();
} catch (PDOException $e) {
    // It's good practice to handle potential database errors
    die("Could not retrieve offers from the database: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Offers</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #0984e3; text-align: center; }
        .message { padding: 10px; margin-bottom: 15px; border-radius: 5px; color: #fff; text-align: center; }
        .success { background-color: #27ae60; }
        .error { background-color: #c0392b; }
        .add-offer-btn { display: inline-block; background: #0984e3; color: #fff; padding: 10px 15px; text-decoration: none; border-radius: 5px; margin-bottom: 20px; }
        .offer-table { width: 100%; border-collapse: collapse; }
        .offer-table th, .offer-table td { border: 1px solid #dfe6e9; padding: 12px; text-align: left; }
        .offer-table th { background-color: #0984e3; color: white; }
        .actions a { color: #0984e3; text-decoration: none; margin-right: 10px; }
        .actions a.delete { color: #d63031; }
        .status-active { color: #27ae60; font-weight: bold; }
        .status-inactive { color: #7f8c8d; font-weight: bold; }
        .home-link { display: block; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Offer Management</h1>

        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="message success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="message error"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
        <?php endif; ?>

        <a href="create_offer.php" class="add-offer-btn">Add New Offer</a>

        <table class="offer-table">
            <thead>
                <tr>
                    <th>Offer Name</th>
                    <th>Discount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($offers): ?>
                    <?php foreach ($offers as $offer): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($offer['offerName']); ?></td>
                            <td><?php echo htmlspecialchars($offer['discountPercent']); ?>%</td>
                            <td><span class="status-<?php echo htmlspecialchars($offer['status']); ?>"><?php echo ucfirst(htmlspecialchars($offer['status'])); ?></span></td>
                            <td class="actions">
                                <a href="edit_offer.php?id=<?php echo $offer['id']; ?>">Edit</a>
                                <!-- CORRECTED: Fixed typo in the filename from delete_offer.php to delelte_offer.php -->
                                <a href="delelte_offer.php?id=<?php echo $offer['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this offer?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" style="text-align:center;">No offers found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
         <a href="index.php" class="home-link">Back to Home</a>
    </div>
</body>
</html>


