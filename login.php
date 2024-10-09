<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "yumyard");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username exists in the database
$sql = "SELECT * FROM users WHERE email='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the stored data
    $row = $result->fetch_assoc();
    $hashed_password = $row['password'];

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // If login is successful, redirect to the home page
        header("Location: home.html");
        exit();
    } else {
        // Invalid password
        echo "<script>alert('Invalid Username or Password'); window.location.href = 'login.html';</script>";
    }
} else {
    // Invalid username
    echo "<script>alert('Invalid Username or Password'); window.location.href = 'login.html';</script>";
}

$conn->close();
?>
