<?php

    $livestock_nm = $_POST['livestock_nm'];
    $livestock_type = $_POST['livestock_type'];
    $quantity = $_POST['quantity'];
    $birthdate = $_POST['birthdate'];

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `livestock` (livestock_nm, livestock_type, quantity, birthdate) 
                VALUES ('$livestock_nm', '$livestock_type', '$quantity', '$birthdate')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `livestock` SET 
                livestock_nm = '$livestock_nm', 
                livestock_type = '$livestock_type', 
                quantity = '$quantity', 
                birthdate = '$birthdate' 
                WHERE id = $id";
    }
?>
