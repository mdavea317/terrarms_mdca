<?php

    $year = $_POST['year'];
    $department = $_POST['department'];
    $expenses_cat = $_POST['expenses_cat'];
    $amount = $_POST['amount'];
    $notes = $_POST['notes'];
    $attachment = $_FILES['attachment']['name']; // Assuming file upload is handled

    // Since transaction_type is always 'budget', we can hardcode it
    $transaction_type = 'budget';

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `finance_log` (year, transaction_type, department, expenses_cat, amount, notes, attachment) 
                VALUES ('$year', '$transaction_type', '$department', '$expenses_cat', '$amount', '$notes', '$attachment')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `finance_log` SET 
                year = '$year', 
                department = '$department', 
                expenses_cat = '$expenses_cat', 
                amount = '$amount', 
                notes = '$notes', 
                attachment = '$attachment' 
                WHERE id = $id";
    }
?>
