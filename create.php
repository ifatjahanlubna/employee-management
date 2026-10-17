<?php
require "config.php";

$employeeName = "";
$employeeId = "";
$department = "";
$salary = "";
$joinDate = "";
$phoneNumber = "";
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $employeeName = trim($_POST['employee_name']);
    $employeeId = strtoupper(trim($_POST['employee_id']));
    $department = $_POST['department'];
    $salary = trim($_POST['salary']);
    $joinDate = trim($_POST['join_date']);
    $phoneNumber = trim($_POST['phone_number']);

    $errors = validateEmployee($employeeName, $employeeId, $department, $salary, $joinDate, $phoneNumber);

    $noNewEmployeeRowYet = 0;
    if (!isset($errors['employee_id']) && employeeIdExists($database, $employeeId, $noNewEmployeeRowYet)) {
        $errors['employee_id'] = "This Employee ID is already in use.";
    }

    if (count($errors) == 0) {
        $statement = $database->prepare("INSERT INTO employees (employee_name, employee_id, department, salary, join_date, phone_number) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->execute([$employeeName, $employeeId, $department, $salary, $joinDate, $phoneNumber]);
        header("Location: index.php?message=added");
        exit;
    }
}

$pageTitle = "Add Employee";
$formAction = "create.php";
$buttonText = "Save Employee";
require "includes/header.php";
?>

<h1>Add Employee</h1>
<?php require "includes/form.php"; ?>

<?php require "includes/footer.php"; ?>
