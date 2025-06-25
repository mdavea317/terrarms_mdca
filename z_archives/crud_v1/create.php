<?php

	include 'includes/db.php'; ?>


<?php
	include 'includes/table_map.php';

if (array_key_exists($tabledb, $tablename)) {
	
	if (isset($titles[$tabledb])) {
        $title = $titles[$tabledb]['tab'];
        $title_h1 = $titles[$tabledb]['h1'];
		$menu_toggle = $titles[$tabledb]['toggle'];
		$title_parent = $titles[$tabledb]['parent'];
    }
	
    // Dynamically include the form for the selected table, not just 'items'
    if (isset($create_rec[$tabledb])) {
        $form_include = $create_rec[$tabledb]; // Get the correct form based on table
    } else {
        echo "Form for the selected table not found.";
        exit; // Stop further execution if the form is not found
    }
}  else {
    echo "Invalid table selected.";
    exit; // Stop further execution if the table is invalid
}
?>


<section class="dashboard-hm">
	<?php include $form_include; ?>
 </section>


