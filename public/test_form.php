<?php
// Simple test to see if form is submitting

echo "<h1>Form Test</h1>";

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h2>POST DATA RECEIVED:</h2>";
    echo "<pre>";
    var_dump($_POST);
    echo "</pre>";
    
    echo "<h2>FILES DATA:</h2>";
    echo "<pre>";
    var_dump($_FILES);
    echo "</pre>";
    
    // Try to check if file exists
    if (!empty($_FILES['logo_image'])) {
        $file = $_FILES['logo_image'];
        echo "<h3>File Analysis:</h3>";
        echo "Name: " . $file['name'] . "<br>";
        echo "Type: " . $file['type'] . "<br>";
        echo "Size: " . $file['size'] . "<br>";
        echo "Error: " . $file['error'] . "<br>";
        echo "Tmp_name: " . $file['tmp_name'] . "<br>";
        
        if (file_exists($file['tmp_name'])) {
            echo "Tmp file EXISTS<br>";
        } else {
            echo "Tmp file DOES NOT EXIST<br>";
        }
    }
} else {
    echo "<p>No POST data</p>";
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Test</title>
</head>
<body>

<h2>Test Form Submission</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="logo_image" accept="image/*" required>
    <button type="submit">Upload Test</button>
</form>

</body>
</html>
