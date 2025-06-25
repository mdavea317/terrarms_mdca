<?php

	include 'includes/db.php';
	include 'includes/prompt.php'; ?>



	<section class="search-bar">


<?php
	include 'includes/table_map.php';
		
		echo "<a class='btn btn-green' href='index.php?page=create&table=$nmTable'>";
		echo "<i class='fa fa-plus'></i> Add Record </a>";
  		echo "</section>";
	
	if (isset($titles[$tabledb])) {
        $title = $titles[$tabledb]['tab'];
        $title_h1 = $titles[$tabledb]['h1'];
		$title_parent = $titles[$tabledb]['parent'];
		$menu_toggle = $titles[$tabledb]['toggle'];
    }
		
		
	if (isset($view_rec[$tabledb])) {
        $form_include = $view_rec[$tabledb]; // Get the correct form based on table
    } else {
        echo "Form for the selected table not found.";
        exit; // Stop further execution if the form is not found
    }
		
	
		echo "<section class='panel-big'>";
		echo "<table class='table-green'>";
	 	// Fetch and display data for items
		$sql = "SELECT * FROM $dbTable"; // Use the dbTable variable set earlier
		$result = $conn->query($sql);

		// Output headers
		$headers = ['ID', 'Farm Field', 'Area (sqm)', 'Soil Type', 'Irrigation', 'Date Added']; // Adjust headers as needed
		foreach ($headers as $header) {
			echo "<th>" . $header . "</th>";
		}
		echo "<th>Actions</th></tr>";

		while ($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td>" . htmlspecialchars($row['id']) . "</td>";
			echo "<td>" . htmlspecialchars($row['field_nm']) . "</td>";
			echo "<td>" . htmlspecialchars($row['area']) . "</td>";
			echo "<td>" . htmlspecialchars($row['soil_type']) . "</td>";
			echo "<td>" . htmlspecialchars($row['irrigation']) . "</td>";
			echo "<td>" . htmlspecialchars($row['date_added']) . "</td>";
			echo "<td>
					<a href='index.php?page=view&table=$nmTable&id={$row['id']}' title='View'><i class='fa-solid fa-eye'></i></a> 
					<a href='index.php?page=update&table=$nmTable&id={$row['id']}' title='Edit'><i class='fa fa-pen'></i></a> 
					<a href='index.php?page=delete&table=$nmTable&id={$row['id']}' title='Delete'><i class='fa fa-trash'></i></a>
				  </td>";
			echo "</tr>";
		}
		echo "</table> </section>"

?>

</section>
