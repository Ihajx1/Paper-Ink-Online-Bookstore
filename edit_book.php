<?php
session_start();
include 'db.php';


// Get book ID from URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid Book ID!'); window.location.href='../admin.php';</script>";
    exit;
}

$book_id = $_GET['id'];

// Fetch book details
$stmt = $conn->prepare("SELECT * FROM books WHERE id = ?");
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<script>alert('Book not found!'); window.location.href='../admin.php';</script>";
    exit;
}

$book = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - MintReads</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo">MintReads Admin</div>
        <ul class="nav-links">
            <li><a href="../admin.php">Back to Admin Panel</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<!-- Edit Book Form -->
<section class="admin-panel">
    <h2>Edit Book</h2>
    <form action="update_book.php" method="POST" enctype="multipart/form-data" class="admin-form">
        <input type="hidden" name="id" value="<?= $book['id'] ?>">

        <label>Book Title</label>
        <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>

        <label>Author</label>
        <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>

        <label>Price</label>
        <input type="number" name="price" step="0.01" value="<?= $book['price'] ?>" required>

        <label>Stock Quantity</label>
        <input type="number" name="stock" value="<?= $book['stock'] ?>" required>

        <label>Current Image</label>
        <img src="../images/<?= $book['image_url'] ?>" class="book-img-preview">
        
        <label>Upload New Image (Optional)</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Update Book</button>
    </form>
</section>

<footer>
    <p>&copy; 2025 MintReads. All rights reserved.</p>
</footer>

</body>
</html>
