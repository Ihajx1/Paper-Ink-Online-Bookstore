<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script>alert('Book deleted successfully!'); window.location.href='../admin.php';</script>";
}
?>
