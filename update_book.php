<?php
session_start();
include 'db.php';

// Check if admin is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    echo "<script>alert('Access Denied! Admins only.'); window.location.href='../login.php';</script>";
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    
    // Check if a new image is uploaded
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        // Update query with image
        $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, price = ?, stock = ?, image_url = ? WHERE id = ?");
        $stmt->bind_param("ssdssi", $title, $author, $price, $stock, $image, $book_id);
    } else {
        // Update query without image
        $stmt = $conn->prepare("UPDATE books SET title = ?, author = ?, price = ?, stock = ? WHERE id = ?");
        $stmt->bind_param("ssdsi", $title, $author, $price, $stock, $book_id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Book updated successfully!'); window.location.href='../admin.php';</script>";
    } else {
        echo "<script>alert('Error updating book!'); window.location.href='edit_book.php?id=$book_id';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
