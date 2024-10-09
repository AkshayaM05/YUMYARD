<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "yumyard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name, comment, created_at FROM comments ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<p><strong>" . htmlspecialchars($row['name']) . "</strong> said:</p>";
        echo "<p>" . nl2br(htmlspecialchars($row['comment'])) . "</p>";
        echo "<p><em>Posted on " . $row['created_at'] . "</em></p>";
        echo "</div><hr>";
    }
} else {
    echo "No comments yet.";
}

$conn->close();
?>
