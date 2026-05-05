<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - paper ink</title>
    <link rel="stylesheet" href="css/style.css">
    <script defer src="js/validation.js"></script>
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">paper ink</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="admin.php">Admin Panel</a></li>
        </ul>
    </nav>
</header>

<!-- Login Form -->
<section class="login-section">
    <h2>Login</h2>
    <form id="loginForm" action="php/login_check.php" method="POST">
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</section>

<!-- Popup Modal for Validation Errors -->
<div id="errorPopup" class="popup">
    <div class="popup-content">
        <h3>Form Errors</h3>
        <ul id="errorList"></ul>
        <button onclick="closePopup()">Close</button>
    </div>
</div>

<footer>
    <p>&copy; 2025 paper ink. All rights reserved.</p>
</footer>

</body>
</html>
