<?php

    $date = $_POST['date'];
    $source = $_POST['source'];
    $revenue_cat = $_POST['revenue_cat'];
    $amount = $_POST['amount'];
    $notes = $_POST['notes'];
    $attachment = $_FILES['attachment']['name']; // Assuming file upload is handled

    // Since transaction_type is always 'revenue', we can hardcode it
    $transaction_type = 'revenue';

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `finance_log` (date, source, revenue_cat, amount, notes, attachment, transaction_type) 
                VALUES ('$date', '$source', '$revenue_cat', '$amount', '$notes', '$attachment', '$transaction_type')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `finance_log` SET 
                date = '$date', 
                source = '$source', 
                revenue_cat = '$revenue_cat', 
                amount = '$amount', 
                notes = '$notes', 
                attachment = '$attachment' 
                WHERE id = $id";
    }
?>
