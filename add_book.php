<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    // Image upload handling
    $image = $_FILES['image']['name'];
    $target = "../images/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $stmt = $conn->prepare("INSERT INTO books (title, author, price, stock, image_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdss", $title, $author, $price, $stock, $image);
    $stmt->execute();
    
    echo "<script>alert('Book added successfully!'); window.location.href='../admin.php';</script>";
}
?>
