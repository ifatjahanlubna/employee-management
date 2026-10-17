<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="topbar">
    <div class="container">
        <a class="brand" href="index.php">Employee Management</a>
        <?php if ($pageTitle == "Employees"): ?>
            <a class="btn" href="create.php">+ Add Employee</a>
        <?php else: ?>
            <a class="btn" href="index.php">View All Employees</a>
        <?php endif; ?>
    </div>
</header>

<main class="container">
