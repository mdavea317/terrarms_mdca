<?php

	include 'includes/db.php';
	include 'includes/mapping.php';
	include 'includes/crea_qry.php';

	$mode = 'create'; // Specify the mode as "create"
	$txn = $_GET['txn']; // Get the transaction from URL or define it
	$table = $transactions[$txn];  // Ensure correct table is used

	$error = '';
	$success = '';
	$data = [];

	$is_update = ($mode === 'update');

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
				header("Location: index.php?page=create&txn=$txn&success=Record created successfully.");
				exit; // Stop execution after redirect
		} else {
				$error = "Failed to create record: " . $conn->error;
		}
	}



?>


	<section class="dashboard-hm">
		<?php include 'includes/panel_create.php'?>	
	</section>

	