<?php
$DB_CONFIG = [
  'host' => 'localhost',
  'user' => 'root',
  'pass' => '',
  'name' => 'memberdb',
  'port' => 3306
];
$conn = new mysqli(
    $DB_CONFIG['host'],
    $DB_CONFIG['user'],
    $DB_CONFIG['pass'],
    $DB_CONFIG['name'],
    $DB_CONFIG['port']
);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>