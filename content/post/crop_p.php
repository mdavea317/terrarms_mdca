<?php

    $crop_id = $_POST['crop_id'];
    $dt_applied = $_POST['dt_applied'];
    $treatment = $_POST['treatment'];
    $notes = $_POST['notes'];
    $employee_id = $_POST['employee_id'];

    // Since record_type is always 'pest_control', we can hardcode it
    $record_type = 'pest control';

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `crop_log` (crop_id, record_type, dt_applied, treatment, notes, employee_id) 
                VALUES ('$crop_id', '$record_type', '$dt_applied', '$treatment', '$notes', '$employee_id')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `crop_log` SET 
                crop_id = '$crop_id', 
                record_type = '$record_type', 
                dt_applied = '$dt_applied', 
                treatment = '$treatment', 
                notes = '$notes', 
                employee_id = '$employee_id' 
                WHERE id = $id";
    }
?>
