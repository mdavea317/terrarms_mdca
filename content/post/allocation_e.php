<?php

    // Retrieve POST variables
    $equipment_id = $_POST['equipment_id'];
    $field_id = $_POST['field_id'];

    // Assuming you want to join and get the model from the equipm table
    // This should be handled in a SELECT query, not here, but kept for clarity on the structure.
    $allocation_type = 'equipment'; // Hardcoded since it's checked for '%equipment%'

    if ($mode === 'create') {
        // Insert new record into allocation_log
        $sql = "INSERT INTO `allocation_log` (equipment_id, field_id, allocation_type) 
                VALUES ('$equipment_id', '$field_id', '$allocation_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record in allocation_log
        $id = $_POST['id'];
        $sql = "UPDATE `allocation_log` SET 
                equipment_id = '$equipment_id', 
                field_id = '$field_id' 
                WHERE id = $id";
    }
?>
