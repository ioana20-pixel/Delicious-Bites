<?php
// config.php
$host = 'localhost';  // Your database host (localhost if running locally)
$dbname = 'delicious_bites';
$username = 'root';  // Your database username
$password = '';      // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $dbname :" . $e->getMessage());
}
?>
