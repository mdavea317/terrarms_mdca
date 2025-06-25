<?php

    // Retrieve POST variables
    $livestock_id = $_POST['livestock_id']; // Identifier for the livestock
    $feed_start_dt = $_POST['feed_start_dt']; // Start date of the feed plan
    $feed_end_dt = $_POST['feed_end_dt']; // End date of the feed plan
    $feed_type = $_POST['feed_type']; // Type of feed
    $feed_qty = $_POST['feed_qty']; // Quantity of feed
    $notes = $_POST['notes']; // Additional notes
    $employee_id = $_POST['employee_id'];


    // Set record_type to 'feed plan'
    $record_type = 'feed plan';
	$record_dt =  $_POST['feed_start_dt'];

    if ($mode === 'create') {
        // Insert new record into livestock_log
        $sql = "INSERT INTO `livestock_log` (livestock_id, record_type, record_dt, feed_start_dt, feed_end_dt, feed_type, feed_qty, notes, employee_id) 
                VALUES ('$livestock_id', '$record_type', '$feed_start_dt', '$feed_start_dt', '$feed_end_dt', '$feed_type', '$feed_qty', '$notes', '$employee_id')";
        
    } elseif ($mode === 'update') {
        // Update existing record in livestock_log
        $id = $_POST['id']; // Assuming you have the ID of the record to update
        $sql = "UPDATE `livestock_log` SET 
                livestock_id = '$livestock_id', 
                record_type = '$record_type', 
                record_dt = '$feed_start_dt', 
				feed_start_dt = '$feed_start_dt',
                feed_end_dt = '$feed_end_dt', 
                feed_type = '$feed_type', 
                feed_qty = '$feed_qty', 
                notes = '$notes',
                employee_id = '$employee_id' 
				WHERE id = $id";
    }

    // Execute the SQL query as needed
?>
