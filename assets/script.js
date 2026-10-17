var employeeForm = document.getElementById("employeeForm");

if (employeeForm) {
    employeeForm.addEventListener("submit", function (event) {
        var employeeName = employeeForm.employee_name.value.trim();
        var employeeId = employeeForm.employee_id.value.trim().toUpperCase();
        var department = employeeForm.department.value;
        var salary = employeeForm.salary.value;
        var joinDate = employeeForm.join_date.value;
        var phoneNumber = employeeForm.phone_number.value.trim();
        var todayDate = new Date().toISOString().split("T")[0];
        var formIsValid = true;

        function showErrorMessage(fieldName, message) {
            document.getElementById(fieldName + "-error").textContent = message;
            if (message != "") {
                formIsValid = false;
            }
        }

        showErrorMessage("employee_name", employeeName.length < 4 ? "Name must be at least 4 characters." : "");
        showErrorMessage("employee_id", /^EMP-[0-9]{4}$/.test(employeeId) ? "" : "Employee ID must look like EMP-1234.");
        showErrorMessage("department", department == "" ? "Please select a department." : "");
        showErrorMessage("salary", salary == "" || Number(salary) <= 5000 ? "Salary must be a number greater than 5000." : "");

        if (joinDate == "") {
            showErrorMessage("join_date", "Please enter a valid join date.");
        } else if (joinDate > todayDate) {
            showErrorMessage("join_date", "Join date cannot be in the future.");
        } else {
            showErrorMessage("join_date", "");
        }

        showErrorMessage("phone_number", /^[0-9]{11}$/.test(phoneNumber) ? "" : "Phone number must be exactly 11 digits.");

        if (!formIsValid) {
            event.preventDefault();
        }
    });
}
