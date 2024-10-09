<?php
// Database connection
$servername = "localhost";
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "yumyard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $recipe_id = mysqli_real_escape_string($conn, $_POST['recipe_id']);
    $rating = mysqli_real_escape_string($conn, $_POST['rating']);

    // Prepare SQL statement using a prepared statement
    $sql = "INSERT INTO ratings (recipe_id, rating) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters and execute statement
    $stmt->bind_param("is", $recipe_id, $rating); // Assuming recipe_id is integer
    if ($stmt->execute()) {
        echo "Rating submitted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
