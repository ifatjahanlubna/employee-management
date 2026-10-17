<?php
$dbHost = "localhost";
$dbName = "employee_db";
$dbUsername = "root";
$dbPassword = "";

try {
    $database = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUsername, $dbPassword);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $database->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    die("Database connection failed");
}

$departments = ["HR", "Finance", "IT", "Marketing"];

require_once "functions.php";
