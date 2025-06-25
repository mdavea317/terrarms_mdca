<?php

    $equipment_id = $_POST['equipment_id'];
    $log_date = $_POST['log_date'];
    $status = $_POST['status'];
    $employee_id = $_POST['employee_id'];

    // Since log_type is always "Usage", we can hardcode it
    $log_type = "Availability";

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `equipm_log` (equipment_id, log_type, log_date, status, employee_id) 
                VALUES ('$equipment_id', '$log_type', '$log_date', '$status', '$employee_id')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `equipm_log` SET 
                equipment_id = '$equipment_id', 
                log_type = '$log_type', 
                log_date = '$log_date', 
                status = '$status', 
                employee_id = '$employee_id' 
                WHERE id = $id";
    }
?>
