<?php
header('Content-Type: application/json');

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

include '../includes/db.php';

// Get the POST data
$data = json_decode(file_get_contents('php://input'), true);

// Check if the incoming data is valid
if (!$data || !isset($data['employeeId']) || !isset($data['clockInTime'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
    exit;
}

$employeeId = $data['employeeId'];
$clockInTime = $data['clockInTime'];
$logDate = date('Y-m-d');  // Use the current date for clock-in

// Check if the employee has already clocked in today
$sql = "SELECT * FROM employee_log WHERE id = ? AND log_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $employeeId, $logDate);
$stmt->execute();
$result = $stmt->get_result();

// If the employee hasn't clocked in yet, insert a new record
if ($result->num_rows === 0) {
    $sql = "INSERT INTO employee_log (id, log_date, clock_in) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $employeeId, $logDate, $clockInTime);
    $stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'Clock-in saved successfully.']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Employee has already clocked in today.']);
}

$stmt->close();
$conn->close();
?>
