<?php
// Simple PHP to check hero_slideshow data

// Connect to MySQL
$conn = new mysqli("localhost", "root", "", "db_smart_travel");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h2>🎬 Hero Slideshow Database Check</h2>";

// 1. Check if table exists
$result = $conn->query("SHOW TABLES LIKE 'hero_slideshow'");
if ($result->num_rows == 0) {
    echo "<p style='color: red;'><strong>❌ Table 'hero_slideshow' does NOT exist!</strong></p>";
} else {
    echo "<p style='color: green;'><strong>✅ Table 'hero_slideshow' exists</strong></p>";
    
    // 2. Count all slides
    $result = $conn->query("SELECT COUNT(*) as total FROM hero_slideshow");
    $row = $result->fetch_assoc();
    echo "<p>Total slides: <strong>" . $row['total'] . "</strong></p>";
    
    // 3. Count active slides
    $result = $conn->query("SELECT COUNT(*) as active FROM hero_slideshow WHERE is_active = 1");
    $row = $result->fetch_assoc();
    echo "<p>Active slides: <strong>" . $row['active'] . "</strong></p>";
    
    // 4. List all slides
    echo "<h3>All Slides:</h3>";
    $result = $conn->query("SELECT id, title, image_url, is_active, sort_order FROM hero_slideshow ORDER BY sort_order");
    
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse;'>";
        echo "<tr style='background: #f0f0f0;'><th>ID</th><th>Title</th><th>Image URL</th><th>Active</th><th>Order</th></tr>";
        while($row = $result->fetch_assoc()) {
            $active = $row['is_active'] ? '✅' : '❌';
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['image_url'] . "</td>";
            echo "<td>" . $active . "</td>";
            echo "<td>" . $row['sort_order'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color: orange;'><strong>⚠️ No slides found!</strong></p>";
    }
}

$conn->close();
?>
