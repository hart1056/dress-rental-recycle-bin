<?php
session_start();

// connect to database
$host = "localhost";
$dbname = "dress_rental_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password
    );

    // to see if there's a database error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // make sure our timestamps use the correct timezone
    $pdo->exec("SET time_zone = '+08:00';");
    date_default_timezone_set('Asia/Manila');

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
