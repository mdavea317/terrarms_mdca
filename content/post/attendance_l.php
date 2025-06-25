<?php

    // Retrieve POST variables
    $employee_id = $_POST['employee_id']; // Identifier for the employee
    $date_filed = $_POST['date_filed']; // Date when the leave was filed
    $leave_type = $_POST['leave_type']; // Type of leave
    $start_dt = $_POST['start_dt']; // Start date of the leave
    $end_dt = $_POST['end_dt']; // End date of the leave
    $reason = $_POST['reason']; // Reason for the leave
    $status = 'Pending'; // Default status for new leave records
    $file_ticket = 0; // Default value for the file_ticket

    // Set record_type to 'Leave'
    $record_type = 'Leave';

    if ($mode === 'create') {
        // Insert new record into employee_record
        $sql = "INSERT INTO `employee_record` (employee_id, record_type, date_filed, leave_type, start_dt, end_dt, reason, status, file_ticket) 
                VALUES ('$employee_id', '$record_type', '$date_filed', '$leave_type', '$start_dt', '$end_dt', '$reason', '$status', '$file_ticket')";
        
    } elseif ($mode === 'update') {
        // Update existing record in employee_record
        $id = $_POST['id']; // Assuming you have the ID of the record to update
        $sql = "UPDATE `employee_record` SET 
                employee_id = '$employee_id', 
                record_type = '$record_type', 
                date_filed = '$date_filed', 
                leave_type = '$leave_type', 
                start_dt = '$start_dt', 
                end_dt = '$end_dt', 
                reason = '$reason', 
                status = '$status', 
                file_ticket = '$file_ticket' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
