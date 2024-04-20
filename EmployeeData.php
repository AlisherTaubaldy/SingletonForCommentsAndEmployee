<?php

class EmployeeData {

    private static ?EmployeeData $instance = null;
    private array $employees = [];

    private function __construct() {}

    public static function getInstance(): EmployeeData {
        if (self::$instance === null) {
            self::$instance = new EmployeeData();
        }
        return self::$instance;
    }

    public function getAllEmployees(): array {
        return $this->employees;
    }

    public function addEmployee(array $employeeData): void {
        $this->employees[$employeeData["Employeeld"]] = $employeeData;
    }

    public function deleteEmployee(int $employeeId): void {
        if (isset($this->employees[$employeeId])) {
            unset($this->employees[$employeeId]);
        }
    }

    public function getEmployeesWithHigherSalaryThanManager(): array {
        $result = [];
        foreach ($this->employees as $employee) {
            $managerId = $employee["Chiefld"];
            if (isset($this->employees[$managerId]) && $employee["Salary"] > $this->employees[$managerId]["Salary"]) {
                $result[] = $employee;
            }
        }
        return $result;
    }

    public function getDepartmentsWithLessThanThreeEmployees(): array {
        $departments = [];
        foreach ($this->employees as $employee) {
            $department = $employee["Department"];
            if (!isset($departments[$department])) {
                $departments[$department] = 0;
            }
            $departments[$department]++;
        }
        $result = [];
        foreach ($departments as $department => $count) {
            if ($count < 3) {
                $result[] = $department;
            }
        }
        return $result;
    }
}

// Example usage
$data = EmployeeData::getInstance();
$allEmployees = $data->getAllEmployees();

$newEmployees = [
    1 => [
        "Employeeld" => 1,
        "Chiefld" => 1,
        "Department" => "Sales",
        "Name" => "Айгерим",
        "Salary" => 800,
    ],
    2 => [
        "Employeeld" => 2,
        "Chiefld" => 1,
        "Department" => "Sales",
        "Name" => "Диляра",
        "Salary" => 700,
    ],
    3 => [
        "Employeeld" => 3,
        "Chiefld" => 4,
        "Department" => "Marketing",
        "Name" => "Мариям",
        "Salary" => 900,
    ],
    4 => [
        "Employeeld" => 4,
        "Chiefld" => 4,
        "Department" => "Marketing",
        "Name" => "Сабина",
        "Salary" => 900,
    ],
    5 => [
        "Employeeld" => 5,
        "Chiefld" => 4,
        "Department" => "Marketing",
        "Name" => "Мадина",
        "Salary" => 1000,
    ],
    6 => [
        "Employeeld" => 6,
        "Chiefld" => 8,
        "Department" => "QA",
        "Name" => "Торгын",
        "Salary" => 300,
    ],
    7 => [
        "Employeeld" => 7,
        "Chiefld" => 8,
        "Department" => "QA",
        "Name" => "Айжан",
        "Salary" => 200,
    ],
    8 => [
        "Employeeld" => 8,
        "Chiefld" => 8,
        "Department" => "QA",
        "Name" => "Дидар",
        "Salary" => 200,
    ],
    ];
foreach ($newEmployees as $newEmployee){
    $data->addEmployee($newEmployee);
}

$highEarners = $data->getEmployeesWithHigherSalaryThanManager();
echo "Employees with salary higher than manager:\n";
foreach ($highEarners as $employee) {
    echo $employee["Name"] . " - " . $employee["Department"] . PHP_EOL;
}

$smallDepts = $data->getDepartmentsWithLessThanThreeEmployees();
echo "\nDepartments with less than 3 employees:\n";
foreach ($smallDepts as $department) {
    echo $department . PHP_EOL;
}

$data2 = EmployeeData::getInstance();

$employees2 = $data2->getAllEmployees();

var_dump($employees2);
