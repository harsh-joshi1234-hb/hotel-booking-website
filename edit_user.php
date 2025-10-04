<?php
session_start();
require 'db_connect.php';
include 'check_login.php';
include 'admin_check.php';

$user_id = $_GET['id'] ?? null;
if (!$user_id) {
    header("Location: manage_users.php");
    exit();
}

$stmt = $pdo->prepare("SELECT id, username, email, role, status FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if (!$user) {
    header("Location: manage_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f5f6fa; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; }
        h1 { text-align: center; color: #0984e3; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], select {
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
        <h1>Edit User</h1>
        <form action="update_user.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="active" <?php if ($user['status'] == 'active') echo 'selected'; ?>>Active</option>
                    <option value="inactive" <?php if ($user['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <input type="submit" value="Update User">
        </form>
        <a href="manage_users.php" class="back-link">Back to User Management</a>
    </div>
</body>
</html>