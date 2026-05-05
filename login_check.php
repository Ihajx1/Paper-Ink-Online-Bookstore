<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_role'] = $row['role'];

            // Redirect based on role
            if ($row['role'] === 'admin') {
                echo "<script>alert('Admin login successful!'); window.location.href='../admin.php';</script>";
            } else {
                echo "<script>alert('Login successful! Redirecting to homepage...'); window.location.href='../index.php';</script>";
            }
        } else {
            echo "<script>alert('Invalid password. Please try again.'); window.location.href='../login.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with this email.'); window.location.href='../login.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
