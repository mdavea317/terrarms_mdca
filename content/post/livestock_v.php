<?php

    // Retrieve POST variables
    $livestock_id = $_POST['livestock_id']; // Adjusted for livestock
    $record_dt = $_POST['record_dt']; // Date of vaccination
    $vaccine_type = $_POST['vaccine_type']; // Type of vaccine
    $notes = $_POST['notes']; // Notes regarding the vaccination
    $employee_id = $_POST['employee_id'];

    // Since record_type is always 'vaccination', we can hardcode it
    $record_type = 'vaccination';

    if ($mode === 'create') {
        // Insert new record into livestock_log
        $sql = "INSERT INTO `livestock_log` (livestock_id, record_type, record_dt, vaccine_type, notes, employee_id) 
                VALUES ('$livestock_id', '$record_type', '$record_dt', '$vaccine_type', '$notes', '$employee_id')";
        
    } elseif ($mode === 'update') {
        // Update existing record in livestock_log
        $id = $_POST['id'];
        $sql = "UPDATE `livestock_log` SET 
                livestock_id = '$livestock_id', 
                record_type = '$record_type', 
                record_dt = '$record_dt', 
                vaccine_type = '$vaccine_type', 
                notes = '$notes',
                employee_id = '$employee_id' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
