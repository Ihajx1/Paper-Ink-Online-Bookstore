<?php
include 'php/db.php'; // Include database connection

// Fetch categories for the filter
$category_query = "SELECT * FROM categories";
$category_result = $conn->query($category_query);

// Search functionality
$search_query = isset($_GET['search']) ? $_GET['search'] : "";

// Filter by category
$category_filter = isset($_GET['category']) && $_GET['category'] != "" ? $_GET['category'] : "";

// SQL query to fetch books based on search or category filter
$sql = "SELECT books.*, categories.name AS category_name 
        FROM books 
        LEFT JOIN categories ON books.category_id = categories.id 
        WHERE books.title LIKE '%$search_query%'";

if ($category_filter != "") {
    $sql .= " AND books.category_id = '$category_filter'";
}

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Books - Paper ink</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">Paper ink</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="admin.php">Admin </a></li>
        </ul>
    </nav>
</header>

<!-- Filter & Search Section -->
<section class="filter-bar">
    <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Search books..." value="<?= htmlspecialchars($search_query) ?>">
        <select name="category">
            <option value="">All Categories</option>
            <?php while ($row = $category_result->fetch_assoc()): ?>
                <option value="<?= $row['id'] ?>" <?= ($row['id'] == $category_filter) ? 'selected' : '' ?>>
                    <?= $row['name'] ?>
                </option>
            <?php endwhile; ?>
        </select>
        <button type="submit">Apply</button>
    </form>
</section>

<!-- Books Grid -->
<section class="book-list">
    <h2>All Books</h2>
    <div class="grid-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="book-card">
                    <img src="images/<?= $row['image_url'] ?>" alt="<?= $row['title'] ?>">
                    <h3><?= $row['title'] ?></h3>
                    <p>By <?= $row['author'] ?></p>
                    <p>Category: <strong><?= $row['category_name'] ?></strong></p>
                    <p>$<?= number_format($row['price'], 2) ?></p>
                    <div class="book-actions">
                        <button class="add-to-cart">Add to Cart</button>
                        <a href="book_details.php?id=<?= $row['id'] ?>" class="details-button">View Details</a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No books found.</p>
        <?php endif; ?>
    </div>
</section>

<footer>
    <p>&copy; 2025 Paper ink. All rights reserved.</p>
</footer>

</body>
</html>
