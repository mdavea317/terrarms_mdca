<?php
include '../includes/db.php';

// Get the data sent via POST
$data = json_decode(file_get_contents('php://input'), true);

// Debugging: log the received data
file_put_contents('php://stderr', print_r($data, true));  // Log to error log for debugging

if ($data) {
    // Extract general data (pay period, start and end dates)
    $payPeriodSt = $data['pay_period_st'];
    $payPeriodEd = $data['pay_period_ed'];
    $startDate = $data['start_date'];
    $endDate = $data['end_date'];

    // Process each employee data and insert into the database
    foreach ($data['employees'] as $employee) {
        // Extract employee data
        $employeeId = $employee['id'];
        $wageDaily = $employee['wage_daily'];
        $wageOt = $employee['wage_ot'];
        $totalDaysWorked = $employee['total_days_worked'];
        $totalOvertimeHours = $employee['total_overtime_hours'];
        $grossPay = $employee['gross_pay'];
        $sssDed = $employee['sss'];
        $pagIbigDed = $employee['pagibig'];
        $philHealthDed = $employee['philhealth'];
        $totalDeductions = $employee['total_deductions'];
        $takeHomePay = $employee['take_home_pay'];


        // Insert employee data into payroll_data table
        $sql = "INSERT INTO payroll_data (
                    employee_id, pay_period_st, pay_period_ed,
                    gross_pay, total_deductions, take_home_pay, wage_daily, wage_ot, 
                    total_days_worked, total_overtime_hours, sss, pagibig, philhealth
                ) VALUES (
                    '$employeeId', '$payPeriodSt', '$payPeriodEd',
                    '$grossPay', '$totalDeductions', '$takeHomePay', '$wageDaily', '$wageOt',
                    '$totalDaysWorked', '$totalOvertimeHours', '$sssDed', '$pagIbigDed', '$philHealthDed'
                )";

        if (!$conn->query($sql)) {
            // If there was an error inserting the record, log the error
            echo json_encode(['success' => false, 'message' => 'Error saving employee data: ' . $conn->error]);
            exit();
        }
    }

    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}

$conn->close();
?>