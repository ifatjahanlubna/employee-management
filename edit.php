<?php
require "config.php";

$employeeRowId = (int) ($_GET['id'] ?? 0);

$statement = $database->prepare("SELECT * FROM employees WHERE id = ?");
$statement->execute([$employeeRowId]);
$savedEmployee = $statement->fetch();

if (!$savedEmployee) {
    header("Location: index.php?message=notfound");
    exit;
}

$employeeName = $savedEmployee['employee_name'];
$employeeId = $savedEmployee['employee_id'];
$department = $savedEmployee['department'];
$salary = $savedEmployee['salary'];
$joinDate = $savedEmployee['join_date'];
$phoneNumber = $savedEmployee['phone_number'];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $employeeName = trim($_POST['employee_name']);
    $employeeId = strtoupper(trim($_POST['employee_id']));
    $department = $_POST['department'];
    $salary = trim($_POST['salary']);
    $joinDate = trim($_POST['join_date']);
    $phoneNumber = trim($_POST['phone_number']);

    $errors = validateEmployee($employeeName, $employeeId, $department, $salary, $joinDate, $phoneNumber);

    if (!isset($errors['employee_id']) && employeeIdExists($database, $employeeId, $employeeRowId)) {
        $errors['employee_id'] = "This Employee ID belongs to another employee.";
    }

    if (count($errors) == 0) {
        $statement = $database->prepare("UPDATE employees SET employee_name = ?, employee_id = ?, department = ?, salary = ?, join_date = ?, phone_number = ? WHERE id = ?");
        $statement->execute([$employeeName, $employeeId, $department, $salary, $joinDate, $phoneNumber, $employeeRowId]);
        header("Location: index.php?message=updated");
        exit;
    }
}

$pageTitle = "Edit Employee";
$formAction = "edit.php?id=" . $employeeRowId;
$buttonText = "Save Changes";
require "includes/header.php";
?>

<h1>Edit Employee #<?= $employeeRowId ?></h1>
<?php require "includes/form.php"; ?>

<?php require "includes/footer.php"; ?>
