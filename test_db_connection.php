<?php
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'db_smart_travel';

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if ($conn->connect_error) {
    echo 'MySQL Error: ' . $conn->connect_error;
} else {
    echo 'MySQL: Connected OK' . PHP_EOL;
    $result = mysqli_query($conn, 'SELECT DATABASE()');
    $row = mysqli_fetch_row($result);
    echo 'Database: ' . $row[0] . PHP_EOL;
    mysqli_close($conn);
}
?>
