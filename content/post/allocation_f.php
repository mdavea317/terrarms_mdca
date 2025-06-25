<?php

    // Retrieve POST variables
    $item_id = $_POST['item_id'];
    $quantity = $_POST['quantity'];
    $allocation_qty = $_POST['allocation_qty'];
    $percentage = $_POST['percentage'];
    $allocation_date = $_POST['allocation_date'];
    
    // Set allocation_type to 'fertilizer'
    $allocation_type = 'fertilizer';

    if ($mode === 'create') {
        // Insert new record into allocation_log
        $sql = "INSERT INTO `allocation_log` (item_id, quantity, allocation_qty, percentage, allocation_date, allocation_type) 
                VALUES ('$item_id', '$quantity', '$allocation_qty', '$percentage', '$allocation_date', '$allocation_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record in allocation_log
        $id = $_POST['id'];
        $sql = "UPDATE `allocation_log` SET 
                item_id = '$item_id', 
                quantity = '$quantity', 
                allocation_qty = '$allocation_qty', 
                percentage = '$percentage', 
                allocation_date = '$allocation_date', 
                allocation_type = '$allocation_type' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
