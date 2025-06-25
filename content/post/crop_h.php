<?php

    $crop_id = $_POST['crop_id'];
    $harvest_oc = $_POST['harvest_oc'];
    $harvest_dt_act = $_POST['harvest_dt_act'];
    $act_yield = $_POST['act_yield'];
    $notes = $_POST['notes'];
    $employee_id = $_POST['employee_id'];

    // Since record_type is always 'pest_control', we can hardcode it
    $record_type = 'harvest';

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `crop_log` (crop_id, record_type, harvest_dt_act, harvest_oc, act_yield, notes, employee_id) 
                VALUES ('$crop_id', '$record_type', '$harvest_dt_act', '$harvest_oc', '$act_yield', '$notes', '$employee_id')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `crop_log` SET 
                crop_id = '$crop_id', 
                record_type = '$record_type', 
                harvest_dt_act = '$harvest_dt_act', 
                harvest_oc = '$harvest_oc', 
                act_yield = '$act_yield', 
                notes = '$notes', 
                employee_id = '$employee_id' 
                WHERE id = $id";
    }
?>
