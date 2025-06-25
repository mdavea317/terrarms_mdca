<?php

    $crop_nm = $_POST['crop_nm'];
    $est_yield = $_POST['est_yield'];
    $planting_dt = $_POST['planting_dt'];
    $harvest_dt = $_POST['harvest_dt'];
    $field_id = $_POST['field_id'];

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `crop` (crop_nm, est_yield, planting_dt, harvest_dt, field_id) 
                VALUES ('$crop_nm', '$est_yield', '$planting_dt', '$harvest_dt', '$field_id')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `crop` SET 
                crop_nm = '$crop_nm', 
                est_yield = '$est_yield', 
                planting_dt = '$planting_dt', 
                harvest_dt = '$harvest_dt', 
                field_id = '$field_id' 
                WHERE id = $id";
    }
?>
