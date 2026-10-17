<?php
function validateEmployee($employeeName, $employeeId, $department, $salary, $joinDate, $phoneNumber)
{
    global $departments;
    $errors = [];

    if (strlen($employeeName) < 4) {
        $errors['employee_name'] = "Name must be at least 4 characters.";
    }

    if (!preg_match('/^EMP-[0-9]{4}$/', $employeeId)) {
        $errors['employee_id'] = "Employee ID must look like EMP-1234.";
    }

    if (!in_array($department, $departments)) {
        $errors['department'] = "Please select a department.";
    }

    if (!is_numeric($salary) || $salary <= 5000) {
        $errors['salary'] = "Salary must be a number greater than 5000.";
    }

    $dateParts = explode("-", $joinDate);
    $isValidDate = count($dateParts) == 3 && checkdate((int)$dateParts[1], (int)$dateParts[2], (int)$dateParts[0]);

    if (!$isValidDate) {
        $errors['join_date'] = "Please enter a valid join date.";
    } elseif ($joinDate > date("Y-m-d")) {
        $errors['join_date'] = "Join date cannot be in the future.";
    }

    if (!preg_match('/^[0-9]{11}$/', $phoneNumber)) {
        $errors['phone_number'] = "Phone number must be exactly 11 digits.";
    }

    return $errors;
}

function employeeIdExists($database, $employeeId, $currentEmployeeRowId)
{
    $statement = $database->prepare("SELECT COUNT(*) FROM employees WHERE employee_id = ? AND id != ?");
    $statement->execute([$employeeId, $currentEmployeeRowId]);
    return $statement->fetchColumn() > 0;
}
