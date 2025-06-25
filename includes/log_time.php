<?php
// Get the raw POST data
$data = json_decode(file_get_contents('php://input'), true);
date_default_timezone_set('Asia/Manila');

// Check if the data contains the necessary fields
if (isset($data['employeeName'], $data['time'], $data['action'])) {
    $employeeName = $data['employeeName'];
    $time = $data['time'];
    $action = $data['action'];

    include 'db.php';

    // Query to fetch employee names and IDs
    $query = "SELECT id, CONCAT(last_nm, '_', first_nm) AS employee_name FROM employee";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Create an array to map employee names to IDs
        $employeeMapping = [];
        while ($row = $result->fetch_assoc()) {
            $employeeMapping[$row['employee_name']] = $row['id'];
        }

        // Check if the employee exists in the mapping
        if (isset($employeeMapping[$employeeName])) {
            // Get the employee ID
            $employeeId = $employeeMapping[$employeeName];
            $employeeIdB = sprintf('%03d', $employeeId);

            // Set current date and file ticket
            $logDate = date('Y-m-d');
            $logDateB = date('ymd');
            $file_ticket = "{$logDateB}{$employeeIdB}";
			
			// Retrieve shift start and end times from the database
			$query = "SELECT shift_st, shift_ed FROM employee_log 
					  WHERE employee_id = '$employeeId' AND log_date = '$logDate' LIMIT 1";

			$result = $conn->query($query);

			if ($result->num_rows > 0) {
				// Fetch the shift start and end times
				$row = $result->fetch_assoc();
				$shift_st = $row['shift_st']; // Example: '07:00:00'
				$shift_ed = $row['shift_ed']; // Example: '16:00:00'
			} else {
				// Default shift times if no entry found (optional)
				$shift_st = "07:00:00";
				$shift_ed = "16:00:00";
			}
			

            // Calculate clock-in/clock-out based on the action
            if ($action === 'clock_in') {
                // Insert clock_in with unique file ticket, or update if record exists for the day
                $query = "INSERT INTO employee_log (employee_id, log_date, clock_in, file_ticket) 
                          VALUES ('$employeeId', '$logDate', '$time', '$file_ticket')
                          ON DUPLICATE KEY UPDATE clock_in = '$time'";
            } elseif ($action === 'clock_out') {
                // Calculate hours worked, lateness, overtime, and undertime on clock-out
                $query = "SELECT clock_in FROM employee_log WHERE employee_id = '$employeeId' AND log_date = '$logDate'";
                $result = $conn->query($query);
                
                if ($result && $row = $result->fetch_assoc()) {
                    $clock_in_time = new DateTime($row['clock_in']);
                    $clock_out_time = new DateTime($time);
                    $shift_start_time = new DateTime($shift_st);
                    $shift_end_time = new DateTime($shift_ed);

                    // Calculate hours worked
                    $interval = $clock_in_time->diff($clock_out_time);
                    $hours_worked = $interval->h + ($interval->i / 60);
					
					$days_worked = 0;
					if ($hours_worked >= 8){
						$days_worked = $days_worked+1;
					}

                    // Calculate tardiness (late)
                    $tardiness = 0;
                    if ($clock_in_time > $shift_start_time) {
                        $late_interval = $shift_start_time->diff($clock_in_time);
                        $tardiness = $late_interval->h + ($late_interval->i / 60);
                    }

                    // Calculate overtime
					$overtime = 0;

					// Check if clock-out time is after shift end time
					if ($clock_out_time > $shift_end_time) {
						// Calculate the overtime interval
						$overtime_interval = $shift_end_time->diff($clock_out_time);

						// Convert the interval to decimal hours
						$raw_overtime = $overtime_interval->h + ($overtime_interval->i / 60);

						// Extract the decimal part
						$integer_part = floor($raw_overtime);
						$decimal_part = $raw_overtime - $integer_part;

						// Round decimal part to .0, .5, or .1
						if ($decimal_part >= 0.0 && $decimal_part <= 0.24) {
							$decimal_part = 0.0; // Round down to 0
						} elseif ($decimal_part >= 0.25 && $decimal_part <= 0.74) {
							$decimal_part = 0.5; // Round to 0.5
						} elseif ($decimal_part >= 0.75) {
							$decimal_part = 1.0; // Round up to 1
						}

						// Calculate final overtime
						$overtime = $integer_part + $decimal_part;
					} else {
						$overtime = 0; // No overtime if clock-out is before or at shift end
					}
					
					/*$overtime = 0;
                    if ($clock_out_time > $shift_end_time) {
                        $overtime_interval = $shift_end_time->diff($clock_out_time);
                        $overtime = $overtime_interval->h + ($overtime_interval->i / 60);
                    }*/

                    // Calculate undertime
                    $undertime = 0;
                    if ($clock_out_time < $shift_end_time) {
                        $undertime_interval = $clock_out_time->diff($shift_end_time);
                        $undertime = $undertime_interval->h + ($undertime_interval->i / 60);
                    }

                    // Update clock_out and calculated fields in the employee_log table
                    $query = "UPDATE employee_log SET 
                                clock_out = '$time', 
                                hrs_worked = '$hours_worked', 
								days_worked = '$days_worked',
                                hrs_late = '$tardiness', 
                                hrs_ot = '$overtime', 
                                hrs_ut = '$undertime' 
                              WHERE employee_id = '$employeeId' AND log_date = '$logDate'";
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Clock-in time not found']);
                    exit;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Invalid action']);
                exit;
            }

            // Execute the query and check for success
            if ($conn->query($query) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => ucfirst($action) . ' time logged']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Error logging ' . $action]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Employee not found']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No employees found in database']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input data']);
}
?>
