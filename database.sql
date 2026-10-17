CREATE DATABASE IF NOT EXISTS employee_db;
USE employee_db;

DROP TABLE IF EXISTS employees;

CREATE TABLE employees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  employee_name VARCHAR(100) NOT NULL,
  employee_id VARCHAR(8) NOT NULL UNIQUE,
  department VARCHAR(50) NOT NULL,
  salary DECIMAL(10,2) NOT NULL,
  join_date DATE NOT NULL,
  phone_number VARCHAR(11) NOT NULL
);

INSERT INTO employees (employee_name, employee_id, department, salary, join_date, phone_number) VALUES
('Ayesha Rahman', 'EMP-1001', 'IT', 45000.00, '2024-01-15', '01711111111'),
('Rahim Uddin', 'EMP-1002', 'HR', 32000.00, '2023-06-01', '01822222222'),
('Karim Hasan', 'EMP-1003', 'Finance', 38500.00, '2022-11-20', '01933333333'),
('Nusrat Jahan', 'EMP-1004', 'Marketing', 29000.00, '2025-03-10', '01644444444'),
('Fateha Ayat', 'EMP-1005', 'IT', 52000.00, '2021-08-05', '01555555555');
