<?php
// This line includes your session checker to protect the page.
include 'check_login.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; text-align: center; margin-top: 50px; }
        .profile-container { background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: inline-block; }
        h1 { color: #0984e3; }
        p { color: #636e72; font-size: 1.1em; }
        .logout-link { display: inline-block; margin-top: 20px; padding: 10px 20px; background: #0984e3; color: #fff; text-decoration: none; border-radius: 5px; }
        /* Style for the new delete button */
        .delete-button { display: inline-block; margin-top: 15px; padding: 10px 20px; background: #d63031; color: #fff; text-decoration: none; border-radius: 5px; border: none; font-size: 1em; cursor: pointer; }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h1>
        <p>This is your protected profile page.</p>
        
        <a href="logout.php" class="logout-link">Logout</a>
        
        <hr style="margin-top: 20px; border: 1px solid #f0f0f0;">
        
        <!-- --- NEW: Delete Account Button --- -->
        <!-- This form will send a POST request to our new delete script. -->
        <!-- The onclick attribute shows a confirmation box before proceeding. -->
        <form action="delete_account.php" method="post" onsubmit="return confirm('Are you sure you want to permanently delete your account? This action cannot be undone.');">
            <button type="submit" class="delete-button">Delete My Account</button>
        </form>
    </div>
</body>
</html>
