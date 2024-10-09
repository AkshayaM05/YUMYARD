<?php
// Database connection
$servername = "localhost";
$username = "root"; // change if necessary
$password = ""; // change if necessary
$dbname = "yumyard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipeName = $_POST['recipeName'];
    $ingredients = $_POST['ingredients'];
    $steps = $_POST['steps'];

    $sql = "INSERT INTO recipes (recipe_name, ingredients, steps)
            VALUES ('$recipeName', '$ingredients', '$steps')";

    if ($conn->query($sql) === TRUE) {
        echo "New recipe created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
