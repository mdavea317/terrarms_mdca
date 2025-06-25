<?php

    // Retrieve POST variables
    $employee_id = $_POST['employee_id'];
    $allocation_task = $_POST['allocation_task'];
    $work_hrs = $_POST['work_hrs'];
    $prod_rate = $_POST['prod_rate'];
    
    // Set allocation_type to 'labor'
    $allocation_type = 'labor';

    if ($mode === 'create') {
        // Insert new record into allocation_log
        $sql = "INSERT INTO `allocation_log` (employee_id, allocation_task, work_hrs, prod_rate, allocation_type) 
                VALUES ('$employee_id', '$allocation_task', '$work_hrs', '$prod_rate', '$allocation_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record in allocation_log
        $id = $_POST['id'];
        $sql = "UPDATE `allocation_log` SET 
                employee_id = '$employee_id', 
                allocation_task = '$allocation_task', 
                work_hrs = '$work_hrs', 
                prod_rate = '$prod_rate', 
                allocation_type = '$allocation_type' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
