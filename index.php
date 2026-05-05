<?php
include 'php/db.php'; // Include database connection
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Bookstore</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- Navigation Bar -->
<header>
    <nav class="navbar">
        <div class="logo">Paper ink</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="admin.php">Admin Panel</a></li>
        </ul>
    </nav>
</header>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>welcome to Paper ink</h1>
        <p>Your one-stop shop for all your favorite books.</p>
        <a href="books.php" class="cta-button">Browse Books</a>
    </div>
</section>

<!-- Welcome Section -->
<section class="welcome">
    <h2>About Us</h2>
    <p>Paper ink is an online bookstore that brings you the latest releases, timeless classics, and everything in between.</p>
</section>

<!-- Categories Section -->
<section class="categories">
    <h2>Book Categories</h2>
    <div class="grid-container">
        <?php
        $category_query = "SELECT * FROM categories";
        $category_result = $conn->query($category_query);
        while ($row = $category_result->fetch_assoc()):
        ?>
            <div class="category-card"><?= $row['name'] ?></div>
        <?php endwhile; ?>
    </div>
</section>

<!-- Featured Books (Loaded from MySQL) -->
<section class="featured">
    <h2>Featured Books</h2>
    <div class="grid-container">
        <?php
        $query = "SELECT * FROM books LIMIT 4"; // Fetch 4 featured books
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book-card'>";
                echo "<img src=images/R.jpeg ' alt='" . $row['title'] . "'>";
                echo "<h3>" . $row['title'] . "</h3>";
                echo "<p>By " . $row['author'] . "</p>";
                echo "<p>$" . number_format($row['price'], 2) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No books available.</p>";
        }
        ?>
    </div>
</section>

<footer>
    <p>&copy; 2025 paper ink. All rights reserved.</p>
</footer>

</body>
</html>
