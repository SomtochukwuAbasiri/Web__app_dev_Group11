<?php
$host = 'localhost';
$user = 'root';       // change if using another DB user
$pass = '';           // add your DB password if needed
$db   = 'shop inventory';  // make sure this database exists

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>