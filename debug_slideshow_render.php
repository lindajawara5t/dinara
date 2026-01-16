<?php
// Simple debug without framework
$db = new mysqli('localhost', 'root', '', 'db_smart_travel');

if ($db->connect_error) {
    die('Connection failed: ' . $db->connect_error);
}

$result = $db->query('SELECT id, title, image_url FROM hero_slideshow WHERE is_active=1 ORDER BY sort_order');

echo "<h2>Slideshow Debug</h2>";
echo "<p>Total active slides: " . $result->num_rows . "</p>";

if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Title</th><th>Image URL</th><th>Preview</th></tr>";
    while ($row = $result->fetch_assoc()) {
        $imageUrl = 'uploads/' . $row['image_url'];
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>" . $row['image_url'] . "</td>";
        echo "<td><img src='$imageUrl' width='100' height='70' style='object-fit:cover'></td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<br><h3>HTML Render Test:</h3>";
    echo "<div style='border: 2px solid red; width: 100%; height: 400px; position: relative; background: #000;'>";
    
    $result->data_seek(0); // Reset pointer
    $index = 0;
    while ($row = $result->fetch_assoc()) {
        $imageUrl = 'uploads/' . $row['image_url'];
        $opacity = ($index === 0) ? '1' : '0';
        echo "<div style='position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-image: url(\"$imageUrl\"); background-size: cover; background-position: center; opacity: $opacity; transition: opacity 1s;' class='slide-test' data-index='$index'></div>";
        $index++;
    }
    echo "</div>";
} else {
    echo "<p style='color: red;'><strong>ERROR: No slides found in database!</strong></p>";
}

$db->close();
?>
