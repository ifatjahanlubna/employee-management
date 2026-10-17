<?php
require "config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $employeeRowId = (int) $_POST['id'];
    $statement = $database->prepare("DELETE FROM employees WHERE id = ?");
    $statement->execute([$employeeRowId]);
    header("Location: index.php?message=deleted");
    exit;
}

header("Location: index.php");
