<?php

    $year = $_POST['year'];
    $department = $_POST['department'];
    $amount = $_POST['amount'];
    $notes = $_POST['notes'];
    $attachment = $_FILES['attachment']['name']; // Assuming file upload is handled

    // Since transaction_type is always 'profit', we can hardcode it
    $transaction_type = 'profit';

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `finance_log` (year, department, amount, notes, attachment, transaction_type) 
                VALUES ('$year', '$department', '$amount', '$notes', '$attachment', '$transaction_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `finance_log` SET 
                year = '$year', 
                department = '$department', 
                amount = '$amount', 
                notes = '$notes', 
                attachment = '$attachment' 
                WHERE id = $id";
    }
?>
