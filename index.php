<?php
require "config.php";

$searchText = trim($_GET['search'] ?? "");
$selectedDepartment = $_GET['department'] ?? "";

$statement = $database->prepare("SELECT * FROM employees
                                 WHERE (employee_name LIKE :search_for_name OR employee_id LIKE :search_for_id)
                                 AND (department = :department OR :department_filter = '')
                                ");
$statement->execute([
    ":search_for_name" => "%$searchText%",
    ":search_for_id" => "%$searchText%",
    ":department" => $selectedDepartment,
    ":department_filter" => $selectedDepartment
]);
$employees = $statement->fetchAll();

$summary = $database->query("SELECT COUNT(*) AS total_employees, COALESCE(SUM(salary), 0) AS total_payroll, COALESCE(AVG(salary), 0) AS average_salary FROM employees")->fetch();
$departmentCounts = $database->query("SELECT department, COUNT(*) AS employee_count FROM employees GROUP BY department")->fetchAll();

$messageTexts = [
    "added" => "Employee added successfully.",
    "updated" => "Employee updated successfully.",
    "deleted" => "Employee deleted.",
    "notfound" => "Employee not found."
];
$messageKey = (string) ($_GET["message"] ?? "");
$messageText = $messageTexts[$messageKey] ?? "";

$pageTitle = "Employees";
require "includes/header.php";
?>

<h1>Employees</h1>

<?php if ($messageText != ""): ?>
    <div class="alert alert-success"><?= $messageText ?></div>
<?php endif; ?>

<section class="stats">
    <div class="card stat"><span>Total employees</span><strong><?= $summary['total_employees'] ?></strong></div>
    <div class="card stat"><span>Monthly payroll</span><strong><?= number_format($summary['total_payroll'], 2) ?></strong></div>
    <div class="card stat"><span>Average salary</span><strong><?= number_format($summary['average_salary'], 2) ?></strong></div>
    <div class="card stat">
        <span>By department</span>
        <div class="chips">
            <?php foreach ($departmentCounts as $departmentCount): ?>
                <em><?= htmlspecialchars($departmentCount['department']) ?>: <?= $departmentCount['employee_count'] ?></em>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<form method="get" action="index.php" class="card filters">
    <input type="text" name="search" value="<?= htmlspecialchars($searchText) ?>" placeholder="Search by name or EMP-ID">
    <select name="department">
        <option value="">All departments</option>
        <?php foreach ($departments as $departmentName): ?>
            <option value="<?= $departmentName ?>" <?= $selectedDepartment == $departmentName ? 'selected' : '' ?>><?= $departmentName ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn">Search</button>
    <a class="btn btn-light" href="index.php">Clear</a>
</form>

<?php if (count($employees) == 0): ?>
    <div class="card empty">No employees found.</div>
<?php else: ?>
<div class="table-wrap">
<table>
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Employee ID</th><th>Department</th>
            <th>Salary</th><th>Join Date</th><th>Phone</th><th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?= $employee['id'] ?></td>
            <td><?= htmlspecialchars($employee['employee_name']) ?></td>
            <td><?= htmlspecialchars($employee['employee_id']) ?></td>
            <td><?= htmlspecialchars($employee['department']) ?></td>
            <td><?= number_format($employee['salary'], 2) ?></td>
            <td><?= $employee['join_date'] ?></td>
            <td><?= htmlspecialchars($employee['phone_number']) ?></td>
            <td>
                <div class="actions">
                    <a class="btn btn-small" href="edit.php?id=<?= $employee['id'] ?>">Edit</a>
                    <form method="post" action="delete.php" onsubmit="return confirm('Delete this employee?');">
                        <input type="hidden" name="id" value="<?= $employee['id'] ?>">
                        <button type="submit" class="btn btn-small btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</div>
<?php endif; ?>

<?php require "includes/footer.php"; ?>
