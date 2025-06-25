<?php

    // Retrieve POST variables
    $expenses_cat = $_POST['expenses_cat'];
    $amnt_budgeted = $_POST['amnt_budgeted'];
    $amnt_actual = $_POST['amnt_actual'];
    $amnt_remaining = $_POST['amnt_remaining'];
    
    // Set allocation_type to 'budget'
    $allocation_type = 'budget';

    if ($mode === 'create') {
        // Insert new record into allocation_log
        $sql = "INSERT INTO `allocation_log` (expenses_cat, amnt_budgeted, amnt_actual, amnt_remaining, allocation_type) 
                VALUES ('$expenses_cat', '$amnt_budgeted', '$amnt_actual', '$amnt_remaining', '$allocation_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record in allocation_log
        $id = $_POST['id'];
        $sql = "UPDATE `allocation_log` SET 
                expenses_cat = '$expenses_cat', 
                amnt_budgeted = '$amnt_budgeted', 
                amnt_actual = '$amnt_actual', 
                amnt_remaining = '$amnt_remaining', 
                allocation_type = '$allocation_type' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
