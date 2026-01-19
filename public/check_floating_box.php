<?php
// Check floating box content in database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dinara";

$conn = new mysqli($servername, $username, $password, $dbname);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>Check Floating Box Content</h2>";

// Check floating box data
$sql = "SELECT * FROM site_content WHERE page_name = 'estimasi' AND section_name = 'floating_box'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h4>Floating Box Data:</h4>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Content Key</th><th>Content Value</th><th>Created</th><th>Updated</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['content_key'] . "</td>";
        echo "<td>" . htmlspecialchars($row['content_value']) . "</td>";
        echo "<td>" . ($row['created_at'] ?? 'N/A') . "</td>";
        echo "<td>" . ($row['updated_at'] ?? 'N/A') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color:red;'>No floating box data found!</p>";
}

// Check all estimasi content
echo "<hr><h3>All Estimasi Content:</h3>";
$sql2 = "SELECT * FROM site_content WHERE page_name = 'estimasi'";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Section</th><th>Key</th><th>Value</th></tr>";
    while($row = $result2->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['section_name'] . "</td>";
        echo "<td>" . $row['content_key'] . "</td>";
        echo "<td>" . htmlspecialchars($row['content_value']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}

$conn->close();
