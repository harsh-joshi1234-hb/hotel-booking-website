<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background: #f5f6fa;
        margin: 0;
        padding: 0;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .signup-container {
        background: #fff;
        padding: 32px 36px 28px 36px;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 320px;
      }
      h1 { color: #0984e3; margin-bottom: 22px; font-size: 2em; letter-spacing: 1px; }
      label { color: #2d3436; font-weight: bold; margin-bottom: 6px; display: block; text-align: left; }
      input[type="text"], input[type="password"], input[type="email"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #dfe6e9;
        border-radius: 5px;
        font-size: 1em;
        margin-bottom: 18px;
        background: #f5f6fa;
        transition: border 0.2s;
      }
      input:focus { border: 1.5px solid #0984e3; outline: none; }
      input[type="submit"] {
        background: #0984e3;
        color: #fff;
        border: none;
        padding: 12px 0;
        border-radius: 6px;
        font-size: 1.1em;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
        transition: background 0.2s;
      }
      input[type="submit"]:hover { background: #74b9ff; color: #2d3436; }
      .login-link { margin-top: 18px; text-align: center; }
      .login-link a { color: #0984e3; text-decoration: none; font-weight: bold; transition: color 0.2s; }
      .login-link a:hover { color: #2d3436; text-decoration: underline; }
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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
   <div class="signup-container">
    <h1>Sign Up</h1>

    <?php
        // This PHP block will display any error message from the server
        if (isset($_SESSION['error'])) {
            echo '<p class="error-message">' . htmlspecialchars($_SESSION['error']) . '</p>';
            unset($_SESSION['error']); // Clear the error after displaying it
        }
    ?>

    <form id="signupForm" action="signup.php" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <div class="g-recaptcha" data-sitekey="6Ldmbt4rAAAAANlYFNcXxw85HzLMiM35eS0Bhg3W"></div>

        <input type="submit" value="Sign Up">
    </form>
    <div class="login-link">
      <p>Already have an account?</p>
      <a href="login.php">Login</a>
    </div>
   </div>
</body>
</html>