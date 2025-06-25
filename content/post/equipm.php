<?php

    $equipment_nm = $_POST['equipment_nm'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $purchase_dt = $_POST['purchase_dt'];
    $warranty_end = $_POST['warranty_end'];
    //$field_id = $_POST['field_id'];

    if ($mode === 'create') {
        // Insert new record
       $sql = "INSERT INTO `equipm` (equipment_nm, model, manufacturer, purchase_dt) 
                VALUES ('$equipment_nm', '$model', '$manufacturer', '$purchase_dt')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `equipm` SET 
                equipment_nm = '$equipment_nm', 
                model = '$model', 
                manufacturer = '$manufacturer', 
                purchase_dt = '$purchase_dt', 
                warranty_end = '$warranty_end'
                WHERE id = $id";
    }
?>
