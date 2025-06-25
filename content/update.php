<?php

include 'includes/db.php';
include 'includes/mapping.php';
include 'includes/crea_qry.php';

$mode = 'update'; // Specify the mode as "update"
$txn = $_GET['txn']; // Get the transaction type
$table = $transactions[$txn];  // Ensure correct table is used
$id = isset($_GET['id']) ? $_GET['id'] : null; // Get the record ID to update


$error = '';
$success = '';
$data = [];

$is_update = ($mode === 'update');

// Dynamically include the form for the selected table, not just 'items'
if (isset($post_rec[$txn])) {
    $post_include = $post_rec[$txn]; // Get the correct form based on table - from mapping.php
} else {
    echo "Form for the selected table not found.";
    exit; // Stop further execution if the form is not found
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data
    include $post_include;

    if ($conn->query($sql) === TRUE) {
        // Redirect to avoid duplicate form submission
        header("Location: index.php?page=update&txn=$txn&id=$id&success=Record updated successfully.");
        exit; // Stop execution after redirect
    } else {
        $error = "Failed to create record: " . $conn->error;
    }
}

// If in update mode, fetch the record data for the given ID
if ($is_update && !empty($id)) { // Use !empty() to ensure ID exists
    $sql = "SELECT * FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc(); // Store the existing data for pre-populating form
        } else {
            $error = "Record not found."; // Update to show the user there is an issue
        }
    } else {
        $error = "Failed to prepare SQL statement.";
    }
}

?>

<section class="dashboard-hm">
    <?php include 'includes/panel_create.php'?>    
</section>