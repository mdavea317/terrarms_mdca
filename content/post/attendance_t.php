<?php

    // Retrieve POST variables
    $employee_id = $_POST['employee_id']; // Identifier for the employee
    $date_filed = $_POST['date_filed']; // Date when the overtime was filed
    $reason = $_POST['reason']; // Reason for the overtime
    $file_ticket = $_POST['file_ticket']; // Additional ticket file information (if applicable)

    // Set record_type to 'overtime'
    $record_type = 'Overtime';
    $status = 'Pending';

    if ($mode === 'create') {
        // Insert new record into employee_record
        $sql = "INSERT INTO `employee_record` (employee_id, record_type, date_filed, reason, status, file_ticket) 
                VALUES ('$employee_id', '$record_type', '$date_filed', '$reason', '$status', '$file_ticket')";
        
    } elseif ($mode === 'update') {
        // Update existing record in employee_record
        $id = $_POST['id']; // Assuming you have the ID of the record to update
        $sql = "UPDATE `employee_record` SET 
                employee_id = '$employee_id', 
                record_type = '$record_type', 
                date_filed = '$date_filed', 
                reason = '$reason', 
				status = '$status',
                file_ticket = '$file_ticket' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
