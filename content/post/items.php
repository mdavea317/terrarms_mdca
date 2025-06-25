<?php

	$category = $_POST['category'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $unit = $_POST['unit'];
   // $price = $_POST['price'];
   // $ideal_qty = $_POST['ideal_qty'];

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `items` (category, item_name, description, unit) 
                VALUES ('$category', '$item_name', '$description', '$unit')";
		
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `items` SET 
                category = '$category', 
                item_name = '$item_name', 
                description = '$description', 
                unit = '$unit' 
                WHERE id = $id";
    }
?>