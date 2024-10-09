<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yumyard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $comment = $conn->real_escape_string($_POST['comments']);

    $sql = "INSERT INTO comments (name, comment) VALUES ('$name', '$comment')";

    if ($conn->query($sql) === TRUE) {
        echo "New comment created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
