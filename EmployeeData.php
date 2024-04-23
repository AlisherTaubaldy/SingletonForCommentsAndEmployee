2.1
SELECT e.Name, e.Salary, c.Name AS ChiefName, c.Salary AS ChiefSalaryFROM Employees AS e
JOIN Employees AS c ON e.ChiefId = c.EmployeeIdWHERE e.Salary > c.Salary;
2.2
SELECT DepartmentFROM Employees
GROUP BY DepartmentHAVING COUNT(*) < 3;
2.3
Для нормализации стоит создать отдельную таблицу Departments в случае если база данных является реляционной