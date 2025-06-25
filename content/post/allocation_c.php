<?php

    $crop_id = $_POST['crop_id'];
    $allocation_land = $_POST['allocation_land'];
    $allocation_water = $_POST['allocation_water'];
    $allocation_ferti = $_POST['allocation_ferti'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Since allocation_type is checked for '%crop%', we can assume it will be included in the logic
    $allocation_type = 'crop'; // You may want to adapt this based on your actual use case

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `allocation_log` (crop_id, allocation_land, allocation_water, allocation_ferti, start_date, end_date, allocation_type) 
                VALUES ('$crop_id', '$allocation_land', '$allocation_water', '$allocation_ferti', '$start_date', '$end_date', '$allocation_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `allocation_log` SET 
                crop_id = '$crop_id', 
                allocation_land = '$allocation_land', 
                allocation_water = '$allocation_water', 
                allocation_ferti = '$allocation_ferti', 
                start_date = '$start_date', 
                end_date = '$end_date' 
                WHERE id = $id";
    }
?>
