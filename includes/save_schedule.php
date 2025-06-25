<?php
include '../includes/db.php'; // Database connection

// Check if the form is submitted

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_data = $_POST['task'];  // Task for each employee
    $shift_start_data = $_POST['shift_start'];  // Shift start for each employee and date
    $shift_end_data = $_POST['shift_end'];  // Shift end for each employee and date

    $success = true;  // To track success or failure
    // Loop through each employee
    foreach ($task_data as $employee_name => $tasks) {
        // Get the employee ID from your list
        $employee_id = getEmployeeIdByName($employee_name);  // You will need a function to map name to employee ID

        // Loop through each date for the employee
        foreach ($shift_start_data[$employee_name] as $date => $start_time) {
            $end_time = $shift_end_data[$employee_name][$date];
            $task = $tasks[0];  // Assuming there's only one task per employee

            // Generate file_ticket
            $file_ticket = generateFileTicket($date, $employee_id);

            // Insert into the database
            $query = "INSERT INTO employee_log (employee_id, log_date, shift_st, shift_ed, task, file_ticket) 
                      VALUES ('$employee_id', '$date', '$start_time', '$end_time', '$task', '$file_ticket')";

            if (!mysqli_query($conn, $query)) {
                $success = false;
                $error = mysqli_error($conn);  // Capture any error message
                break;  // Break the loop if an error occurs
            }
        }
        if (!$success) {
            break;  // Break the outer loop if an error occurs
        }
    }

    // Redirect to the page with a success or error message
    if ($success) {
        header("Location: ../index.php?page=shift_sched&success=" . urlencode("Schedule saved successfully!"));
    } else {
        header("Location: ../index.php?page=shift_sched&error=" . urlencode($error));
    }
    exit;
}

// Function to generate file_ticket
function generateFileTicket($date, $employee_id) {
    $current_date = date("ymd", strtotime($date));  // Format date as yymdd
    $formatted_employee_id = str_pad($employee_id, 3, '0', STR_PAD_LEFT);  // Ensure employee ID is 3 digits
    return $current_date . $formatted_employee_id;
}

// Function to get employee ID by name (implement this based on your logic)
function getEmployeeIdByName($employee_name) {
    global $conn;
    $result = mysqli_query($conn, "SELECT id FROM employee WHERE CONCAT(first_nm, ' ', last_nm) = '$employee_name'");
    $row = mysqli_fetch_assoc($result);
    return $row['id'];
}
?>
