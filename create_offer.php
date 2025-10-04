<?php
session_start();
// MODIFIED: Start a session only if one isn't already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'check_login.php';
include 'admin_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Offer</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #0984e3; text-align: center; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; color: #2d3436; }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #dfe6e9;
            border-radius: 5px;
            font-size: 1em;
            box-sizing: border-box; /* ADDED: Ensures padding doesn't affect width */
        }
        input[type="submit"] {
            background: #0984e3;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            display: block;
            width: 100%;
        }
        .back-link { display: block; text-align: center; margin-top: 20px; }
         /* ADDED: Error message styling */
        .error-message {
            color: #d63031;
            background-color: #ffcccc;
            border: 1px solid #d63031;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create New Offer</h1>
        <?php
        // ADDED: This PHP block will display any error message from the server
        if (isset($_SESSION['error_message'])) {
            echo '<p class="error-message">' . htmlspecialchars($_SESSION['error_message']) . '</p>';
            unset($_SESSION['error_message']); // Clear the error after displaying it
        }
        ?>
        <form action="add_offer.php" method="post">
            <div class="form-group">
                <label for="offerName">Offer Name:</label>
                <input type="text" id="offerName" name="offerName" required>
            </div>
             <div class="form-group">
                <label for="discountPercent">Discount (%):</label>
                <input type="number" id="discountPercent" name="discountPercent" required>
            </div>
            <div class="form-group">
                <label for="offerDescription">Description:</label>
                <textarea id="offerDescription" name="offerDescription" rows="4"></textarea>
            </div>
            <input type="submit" value="Create Offer">
        </form>
        <a href="manage_offers.php" class="back-link">Back to Offer Management</a>
    </div>
</body>
</html>

