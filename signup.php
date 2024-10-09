<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "yumyard");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Check if passwords match
if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match!'); window.location.href = 'signup.html';</script>";
    exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email already exists
$sql = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('Email already registered!'); window.location.href = 'signup.html';</script>";
    exit();
}

// Insert the new user into the database
$sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Sign-up successful! Please login.'); window.location.href = 'login.html';</script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
