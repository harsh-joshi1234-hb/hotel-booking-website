<?php
session_start();
require 'db_connect.php';
include 'check_login.php';
include 'admin_check.php';

$offer_id = $_GET['id'] ?? null;
if (!$offer_id) {
    header("Location: manage_offers.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM offers WHERE id = ?");
$stmt->execute([$offer_id]);
$offer = $stmt->fetch();

if (!$offer) {
    header("Location: manage_offers.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Offer</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h1 { text-align: center; color: #0984e3; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            border: 1px solid #dfe6e9;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background: #0984e3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .back-link { display: block; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Offer</h1>
        <form action="update_offer_process.php" method="post">
            <input type="hidden" name="id" value="<?php echo $offer['id']; ?>">
            <div class="form-group">
                <label for="offerName">Offer Name:</label>
                <input type="text" id="offerName" name="offerName" value="<?php echo htmlspecialchars($offer['offerName']); ?>" required>
            </div>
            <div class="form-group">
                <label for="discountPercent">Discount (%):</label>
                <input type="number" id="discountPercent" name="discountPercent" value="<?php echo htmlspecialchars($offer['discountPercent']); ?>" required>
            </div>
            <div class="form-group">
                <label for="offerDescription">Description:</label>
                <textarea id="offerDescription" name="offerDescription"><?php echo htmlspecialchars($offer['offerDescription']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="active" <?php if ($offer['status'] == 'active') echo 'selected'; ?>>Active</option>
                    <option value="inactive" <?php if ($offer['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <input type="submit" value="Update Offer">
        </form>
        <a href="manage_offers.php" class="back-link">Back to Offer Management</a>
    </div>
</body>
</html>
