<?php

    $date = $_POST['date'];
    $department = $_POST['department'];
    $expenses_cat = $_POST['expenses_cat'];
    $amount = $_POST['amount'];
    $notes = $_POST['notes'];
    $attachment = $_FILES['attachment']['name']; // Assuming file upload is handled

    // Since transaction_type is always 'expense', we can hardcode it
    $transaction_type = 'expense';

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `finance_log` (date, department, expenses_cat, amount, notes, attachment, transaction_type) 
                VALUES ('$date', '$department', '$expenses_cat', '$amount', '$notes', '$attachment', '$transaction_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `finance_log` SET 
                date = '$date', 
                department = '$department', 
                expenses_cat = '$expenses_cat', 
                amount = '$amount', 
                notes = '$notes', 
                attachment = '$attachment' 
                WHERE id = $id";
    }
?>
