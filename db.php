<?php
$host = 'localhost';
$db = 'home_services'; // change to your database name
$user = 'root';         // XAMPP default
$pass = '';             // XAMPP default (empty)

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Database connection failed: " . $conn->connect_error);
}
?>
