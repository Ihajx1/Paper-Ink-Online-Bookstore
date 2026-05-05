<?php
include 'db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Secure password hashing

    // Check if email already exists
    $check_email = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check_email->bind_param("s", $email);
    $check_email->execute();
    $result = $check_email->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists. Please use another email.'); window.location.href='../register.php';</script>";
    } else {
        // Insert user into the database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $full_name, $email, $password);
        
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='../login.php';</script>";
        } else {
            echo "<script>alert('Error registering user.'); window.location.href='../register.php';</script>";
        }
        
        $stmt->close();
    }

    $conn->close();
}
?>
