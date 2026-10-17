<form method="post" action="<?= $formAction ?>" id="employeeForm" class="card form" novalidate>

    <label for="employee_name">Employee Name *</label>
    <input type="text" id="employee_name" name="employee_name" value="<?= htmlspecialchars($employeeName) ?>">
    <small class="error" id="employee_name-error"><?= $errors['employee_name'] ?? '' ?></small>

    <label for="employee_id">Employee ID *</label>
    <input type="text" id="employee_id" name="employee_id" value="<?= htmlspecialchars($employeeId) ?>" placeholder="EMP-1234">
    <small class="error" id="employee_id-error"><?= $errors['employee_id'] ?? '' ?></small>

    <label for="department">Department *</label>
    <select id="department" name="department">
        <option value="">-- Select department --</option>
        <?php foreach ($departments as $departmentName): ?>
            <option value="<?= $departmentName ?>" <?= $department == $departmentName ? 'selected' : '' ?>><?= $departmentName ?></option>
        <?php endforeach; ?>
    </select>
    <small class="error" id="department-error"><?= $errors['department'] ?? '' ?></small>

    <label for="salary">Salary *</label>
    <input type="number" id="salary" name="salary" value="<?= htmlspecialchars($salary) ?>" step="0.01">
    <small class="error" id="salary-error"><?= $errors['salary'] ?? '' ?></small>

    <label for="join_date">Join Date *</label>
    <input type="date" id="join_date" name="join_date" value="<?= htmlspecialchars($joinDate) ?>">
    <small class="error" id="join_date-error"><?= $errors['join_date'] ?? '' ?></small>

    <label for="phone_number">Phone Number *</label>
    <input type="text" id="phone_number" name="phone_number" value="<?= htmlspecialchars($phoneNumber) ?>" placeholder="01712345678">
    <small class="error" id="phone_number-error"><?= $errors['phone_number'] ?? '' ?></small>

    <div class="actions">
        <button type="submit" class="btn"><?= $buttonText ?></button>
        <a class="btn btn-light" href="index.php">Cancel</a>
    </div>
</form>
