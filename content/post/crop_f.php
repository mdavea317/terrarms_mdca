<?php

    $crop_id = $_POST['crop_id'];
    $dt_applied = $_POST['dt_applied'];
    $fertilizer_type = $_POST['fertilizer_type'];
    $notes = $_POST['notes'];

    // Since record_type is always 'fertilization', we can hardcode it
    $record_type = 'fertilization';

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `crop_log` (crop_id, record_type, dt_applied, fertilizer_type, notes) 
                VALUES ('$crop_id', '$record_type', '$dt_applied', '$fertilizer_type', '$notes')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `crop_log` SET 
                crop_id = '$crop_id', 
                record_type = '$record_type', 
                dt_applied = '$dt_applied', 
                fertilizer_type = '$fertilizer_type', 
                notes = '$notes' 
                WHERE id = $id";
    }
?>
