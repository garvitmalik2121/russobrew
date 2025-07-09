<?php
$host = "localhost";
$port = 4307;
$user = "root";
$pass = "";
$dbname = "russobrew";

try {
  $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname", $user, $pass);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Database connection failed: " . $e->getMessage());
}
?>