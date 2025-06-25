<?php
include '../includes/db.php';

// Get the input data from the AJAX request
$data = json_decode(file_get_contents("php://input"), true);
$pay_period_st = $data['pay_period_st'];
$pay_period_ed = $data['pay_period_ed'];

// Prepare SQL query to get employee data with totals within the specified pay period
$sql = "
    SELECT e.id, e.first_nm, e.last_nm, 
           e.wage_daily, 
           e.wage_ot,
           SUM(IFNULL(el.days_worked, 0)) AS total_days_worked,
           SUM(IFNULL(el.hrs_ot, 0)) AS total_overtime_hours
    FROM employee AS e
    LEFT JOIN employee_log AS el 
    ON e.id = el.employee_id 
       AND el.log_date BETWEEN '$pay_period_st' AND '$pay_period_ed'
    GROUP BY e.id, e.first_nm, e.last_nm, e.wage_daily, e.wage_ot
";

$result = $conn->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Calculating gross pay
		$wage_daily = floatval($row['wage_daily']);
		$wage_ot = $wage_daily / 8;  // Calculate the hourly wage (no need for number_format here yet)
		$total_days_worked = floatval($row['total_days_worked']);
		$total_overtime_hours = floatval($row['total_overtime_hours']);

		// Calculate Regular Pay and Overtime Pay as floats
		$regular_pay = $wage_daily * $total_days_worked;  // Regular pay (calculated as a float)
		$overtime_pay = $wage_ot * $total_overtime_hours;

		// Gross Pay
		$gross_pay = $regular_pay + $overtime_pay;  // Gross pay (calculated as a float)
        
        // Correct the deductions for each rate
        // Deduction based on the daily wage * 14 days for the half-month period
        $sss = ($wage_daily * 14) * 0.045; // 4.5% of daily rate * 14 days
        $pagibig = ($wage_daily * 14) * 0.02; // 2% of daily rate * 14 days
        $philhealth = ($wage_daily * 14) * 0.05; // 5% of daily rate * 14 days

        // Calculate total deductions
        $total_deductions = $sss + $pagibig + $philhealth;
        
        // Ensure the gross pay calculation is correct
        $take_home_pay = $gross_pay - $total_deductions;

        // Format the results to 2 decimal places
        $data[] = [
            'id' => $row['id'],
            'first_nm' => $row['first_nm'],
            'last_nm' => $row['last_nm'],
            'wage_daily' => number_format($wage_daily, 2),
            'wage_ot' => number_format($wage_ot, 2),
            'total_days_worked' => number_format($total_days_worked, 2),
            //'regular_pay' => number_format($regular_pay, 2),
            //'overtime_pay' => number_format($overtime_pay, 2),
            'total_overtime_hours' => number_format($total_overtime_hours, 2),
            'gross_pay' => number_format($gross_pay, 2),
            'sss' => number_format($sss, 2), // SSS deduction
            'pagibig' => number_format($pagibig, 2), // Pagibig deduction
            'philhealth' => number_format($philhealth, 2), // PhilHealth deduction
            'total_deductions' => number_format($total_deductions, 2), // Total deductions
            'take_home_pay' => number_format($take_home_pay, 2) // Take-home pay
        ];
    }
}

// Send JSON response back to the AJAX request
header('Content-Type: application/json');
echo json_encode($data);
?>
