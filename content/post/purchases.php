<?php

    // Retrieve POST variables
    $employee_id = $_POST['employee_id']; // ID of the employee making the purchase
    $product_nm = $_POST['product_nm']; // Name of the product
    $quantity = $_POST['quantity']; // Quantity of the product
    $unit = $_POST['unit']; // Unit of the product (e.g., kg, pieces)
    $notes = $_POST['notes']; // Any additional notes
    $remarks = $_POST['remarks']; // Remarks for the purchase
    $status = 'Pending'; // Default status for new records

    // Get current timestamp for the date filed
    $date_filed = date('Y-m-d'); // Or leave it to the DB to handle default

    if ($mode === 'create') {
        // Insert new record into sc_purchases
        $sql = "INSERT INTO `sc_purchases` (date_filed, employee_id, product_nm, quantity, unit, notes, status, remarks) 
                VALUES ('$date_filed', '$employee_id', '$product_nm', '$quantity', '$unit', '$notes', '$status', '$remarks')";
        
    } elseif ($mode === 'update') {
        // Update existing record in sc_purchases
        $id = $_POST['id']; // Assuming you have the ID of the record to update
        $sql = "UPDATE `sc_purchases` SET 
                employee_id = '$employee_id', 
                product_nm = '$product_nm', 
                quantity = '$quantity', 
                unit = '$unit', 
                notes = '$notes', 
                status = '$status', 
                remarks = '$remarks' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
