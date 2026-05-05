<?php
session_start();
include 'php/db.php'; 

// Fetch all books
$query = "SELECT * FROM books ORDER BY title ASC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel -Paper ink</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">Paper ink</div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="books.php">Books</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- Admin Panel Section -->
<section class="admin-panel">
    <h2>Manage Books</h2>

    <!-- Add New Book Form -->
    <form action="php/add_book.php" method="POST" enctype="multipart/form-data" class="admin-form">
        <h3>Add New Book</h3>
        <input type="text" name="title" placeholder="Book Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="number" name="price" step="0.01" placeholder="Price" required>
        <input type="number" name="stock" placeholder="Stock Quantity" required>
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Add Book</button>
    </form>

    <!-- Book List Table -->
    <h3>Book Inventory</h3>
    <table class="admin-table">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><img src="images/<?= $row['image_url'] ?>" alt="<?= $row['title'] ?>" class="book-img"></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['author'] ?></td>
                <td>$<?= number_format($row['price'], 2) ?></td>
                <td><?= $row['stock'] ?></td>
                <td>
                    <a href="php/edit_book.php?id=<?= $row['id'] ?>" class="edit-btn">Edit</a>
                    <a href="php/delete_book.php?id=<?= $row['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                </td>
                
            </tr>
        <?php endwhile; ?>
    </table>
</section>

<footer>
    <p>&copy; 2025 paper ink. All rights reserved.</p>
</footer>

</body>
</html>
