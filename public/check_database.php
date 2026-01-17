<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_smart_travel';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check table exists
$tableCheck = $conn->query("SHOW TABLES LIKE 'hero_slideshow'");
$tableExists = $tableCheck->num_rows > 0;

// Get table structure
$structure = $conn->query("DESC hero_slideshow");

// Get data
$data = $conn->query("SELECT * FROM hero_slideshow");
$count = $data->num_rows;

// Get active slides
$active = $conn->query("SELECT * FROM hero_slideshow WHERE is_active = 1");
$activeCount = $active->num_rows;

?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Check</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; padding: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        .card { background: white; padding: 20px; margin: 15px 0; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #667eea; color: white; }
        .success { color: #2e7d32; }
        .error { color: #c62828; }
        pre { background: #f0f0f0; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Database Check</h1>
        
        <div class="card">
            <h2>Table Status</h2>
            <p class="<?= $tableExists ? 'success' : 'error' ?>">
                Table 'hero_slideshow': <?= $tableExists ? '✅ EXISTS' : '❌ NOT FOUND' ?>
            </p>
        </div>
        
        <div class="card">
            <h2>Table Structure</h2>
            <table>
                <tr>
                    <th>Field</th>
                    <th>Type</th>
                    <th>Null</th>
                    <th>Key</th>
                    <th>Default</th>
                    <th>Extra</th>
                </tr>
                <?php while ($row = $structure->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Field'] ?></td>
                    <td><?= $row['Type'] ?></td>
                    <td><?= $row['Null'] ?></td>
                    <td><?= $row['Key'] ?></td>
                    <td><?= $row['Default'] ?></td>
                    <td><?= $row['Extra'] ?></td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
        
        <div class="card">
            <h2>Data Count</h2>
            <p>Total rows: <strong><?= $count ?></strong></p>
            <p class="<?= $activeCount > 0 ? 'success' : 'error' ?>">
                Active rows (is_active = 1): <strong><?= $activeCount ?> <?= $activeCount > 0 ? '✅' : '❌' ?></strong>
            </p>
        </div>
        
        <div class="card">
            <h2>Sample Data</h2>
            <pre><?php
                $all = $conn->query("SELECT id, title, image_url, is_active, sort_order FROM hero_slideshow LIMIT 10");
                $rows = [];
                while ($row = $all->fetch_assoc()) {
                    $rows[] = $row;
                }
                echo json_encode($rows, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            ?></pre>
        </div>
    </div>
</body>
</html>
<?php $conn->close(); ?>