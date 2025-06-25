<?php

    // Retrieve POST variables
    $employee_id = $_POST['employee_id']; // ID of the employee making the distribution
    $product_nm = $_POST['product_nm']; // Name of the product
    $quantity = $_POST['quantity']; // Quantity of the product
    $unit = $_POST['unit']; // Unit of the product (e.g., kg, piece)
    $unit_prc = $_POST['unit_prc']; // Price per unit
    $total_prc = $quantity * $unit_prc; // Calculate total price based on quantity and unit price
    $destination = $_POST['destination']; // Destination of the product
    $remarks = $_POST['remarks']; // Additional remarks for the distribution
    $status = 'Pending'; // Default status for new records

    // Get current timestamp for the date (you can also leave this to the database)
    $date = date('Y-m-d'); // Or leave it to DB to handle the default value

    if ($mode === 'create') {
        // Insert new record into sc_distribution
        $sql = "INSERT INTO `sc_distribution` (date, employee_id, product_nm, quantity, unit, unit_prc, total_prc, destination, status, remarks) 
                VALUES ('$date', '$employee_id', '$product_nm', '$quantity', '$unit', '$unit_prc', '$total_prc', '$destination', '$status', '$remarks')";
        
    } elseif ($mode === 'update') {
        // Update existing record in sc_distribution
        $id = $_POST['id']; // Assuming you have the ID of the record to update
        $sql = "UPDATE `sc_distribution` SET 
                employee_id = '$employee_id', 
                product_nm = '$product_nm', 
                quantity = '$quantity', 
                unit = '$unit', 
                unit_prc = '$unit_prc', 
                total_prc = '$total_prc', 
                destination = '$destination', 
                status = '$status', 
                remarks = '$remarks' 
                WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
