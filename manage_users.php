<?php
session_start();
require 'db_connect.php';
include 'check_login.php'; // Ensures user is logged in
include 'admin_check.php'; // Ensures user is an admin

// Fetch all users
$stmt = $pdo->query("SELECT id, username, email, role, status FROM users ORDER BY id DESC");
$users = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; margin: 0; padding: 20px; }
        .container { max-width: 900px; margin: 20px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #0984e3; text-align: center; }
        .user-table { width: 100%; border-collapse: collapse; }
        .user-table th, .user-table td { border: 1px solid #dfe6e9; padding: 12px; text-align: left; }
        .user-table th { background-color: #0984e3; color: white; }
        .actions a { color: #0984e3; text-decoration: none; margin-right: 10px; }
        .actions a.delete { color: #d63031; }
        .status-active { color: #27ae60; font-weight: bold; }
        .status-inactive { color: #7f8c8d; font-weight: bold; }
        .home-link { display: block; text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>User Management</h1>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($users): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['role']); ?></td>
                            <td><span class="status-<?php echo htmlspecialchars($user['status']); ?>"><?php echo ucfirst(htmlspecialchars($user['status'])); ?></span></td>
                            <td class="actions">
                                <a href="edit_user.php?id=<?php echo $user['id']; ?>">Edit</a>
                                <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="text-align:center;">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php" class="home-link">Back to Home</a>
    </div>
</body>
</html>