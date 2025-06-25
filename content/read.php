<?php

include 'includes/db.php';
include 'includes/mapping.php';
		
//$read_sql = $read_qry[$txn]['sql'];
$join = isset($read_qry[$txn]['join']) ? $read_qry[$txn]['join'] : null;
$row_s = isset($read_qry[$txn]['row_s']) ? $read_qry[$txn]['row_s'] : null;
$thead = isset($read_qry[$txn]['thead']) ? $read_qry[$txn]['thead'] : null;
$where = isset($read_qry[$txn]['where']) ? $read_qry[$txn]['where'] : null;
$concat = isset($read_qry[$txn]['concat']) ? $read_qry[$txn]['concat'] : null;
$quick_ct = isset($read_qry[$txn]['quick_ct']) ? $read_qry[$txn]['quick_ct'] : null;
$status = isset($read_qry[$txn]['status']) ? $read_qry[$txn]['status'] : null;
$order = isset($read_qry[$txn]['order']) ? $read_qry[$txn]['order'] : null;
$group = isset($read_qry[$txn]['group']) ? $read_qry[$txn]['group'] : null;

if (isset($concat) && !empty($concat)) {
	$concat_im = ", " . implode(", ", $concat);
} else {
	$concat_im = "";
}		
		
$employee_id = $_SESSION['user_id']; 

		
$add_tog_e = $titles[$txn]['add_tog_e'];
$add_btn = isset($titles[$txn]['add_btn']) ? $titles[$txn]['add_btn'] : 'Add Record';
$add_tog_a = $titles[$txn]['add_tog_a'];
$drop_tog = isset($titles[$txn]['drop_tog']) ? $titles[$txn]['drop_tog'] : '';
$srch_tog = isset($titles[$txn]['srch_tog']) ? $titles[$txn]['srch_tog'] : '';
$date_tog = isset($titles[$txn]['$date_tog']) ? $titles[$txn]['$date_tog'] : '';
?>

	<!--SEARCH BAR AND ADD BUTTON-->
	<section class="search-bar">

            <div class="search-container"<?php echo $srch_tog ?> >
				<input type="text" id="search-input" onkeyup="searchFunc()" placeholder="Search here.." title="Type in a name">
			</div>
		
		    <div class="filter-container"<?php echo $drop_tog ?> >
				<label for="category">Select </label>
				<select id="category" class="category-dropdown">
					<option value="all">All</option>
					<?php			 
				 	if (!empty($status)){
						for ($x = 0; $x <= count($status)-1 ; $x++) {
							echo "<option value='".strtolower(substr($status[$x], 0, -3))."'>".$status[$x]."</option>";
						}
					}
					?>
				</select>
			</div>


<?php
		
		//add record toggle on user levels
		if ($userLevel === 'Employee'){
			echo "<a class='btn btn-green' href='index.php?page=create&txn=$txn'";
				echo $add_tog_e;
				echo ">";
			echo "<i class='fa fa-plus'></i> {$add_btn} </a>";
		}
		
		elseif ($userLevel === 'Admin'){
			echo "<a class='btn btn-green' href='index.php?page=create&txn=$txn'";
				echo $add_tog_a;
				echo ">";
			echo "<i class='fa fa-plus'></i> {$add_btn} </a>";
			
			if ($txn === 'employee_p'){
				echo "<a class='btn btn-green' href='index.php?page=payroll_wiz'>";
				echo "<i class='fa fa-plus'></i> Add Pay Period </a>";
			} elseif ($txn === 'employee_s'){
				echo "<a class='btn btn-green' href='index.php?page=shift_sched'>";
				echo "<i class='fa fa-plus'></i> Set Shift Schedule </a>";
			}			
			
		}		
				
		echo "</section>";

		
	   /* PAGINATION RECORD SET 
	   $recordsPerPage = 10;
		
	   if (isset($_GET['pg'])) {
		 $currentPage = $_GET['pg'];
	   } else {
		 $currentPage = 1;
	   }
			
	    $startFrom = ($currentPage - 1) * $recordsPerPage;*/
		
		
		/* CATEGORY COUNT */
		if (!empty($quick_ct)) {
			
			echo "<section class='status-hm'>";
			
			$sql = "SELECT {$quick_ct}, COUNT(*) AS quick_count FROM {$table} {$where} GROUP BY {$quick_ct}";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Create an associative array to map statuses to their counts
				$counts = [];
				while ($row = $result->fetch_assoc()) {
					$counts[$row[$quick_ct]] = $row['quick_count'];
				}

				// Display data for each status
				foreach ($status as $stat) {
					echo "<div class='column'>";
					echo "<p>" . htmlspecialchars($stat) . "</p>";
					// Show the count if the status exists in the query result
					$count = isset($counts[$stat]) ? $counts[$stat] : 0;
					echo "<h2>{$count}</h2>";
					echo "</div>";
				}
			} else {
				echo "0";
			}
		}

		
		
		?>
	</section>
		
	<section class="dashboard-hm">
		<div class="panel-big">
			
			
		<?php 
		// Define the query
		//$sql = "SELECT * {$concat_im}, {$table}.id FROM {$table} {$join} {$where} LIMIT $startFrom, $recordsPerPage";
		$sql = "SELECT * {$concat_im}, {$table}.id FROM {$table} {$join} {$where} {$group} {$order}";
		$result = $conn->query($sql);
			
		if ($read_qry[$txn]['view'] === 'table') {
		
			// Start the table HTML
			echo "<table class='table-green' id='search-table'>";

			// Output table header using `$thead` array
			echo "<thead><tr>";
			foreach ($thead as $header) {
				echo "<th>" . htmlspecialchars($header) . "</th>";
			}
			
			//Actions headers
			if ($userLevel === 'Employee') {
				if (isset($read_qry[$txn]['act_e']) && count($read_qry[$txn]['act_e']) > 0) {
					echo "<th class='action-col'>  </th>";
				}
			} elseif ($userLevel === 'Admin') {
				if (isset($read_qry[$txn]['act_a']) && count($read_qry[$txn]['act_a']) > 0) {
					echo "<th class='action-col'>  </th>";
				}
			}
										
										
			echo "</tr></thead>";
			//echo $sql;
			// Output table rows
			echo "<tbody id='table-body'>";
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					
					if (!empty($quick_ct)){
						echo "<tr data-category='".strtolower(substr($row[$quick_ct], 0, -3))."'>";
					} else {
						echo "<tr>";
					}
					
					
					$row_s1 = isset($row[$row_s[1]]) ? $row[$row_s[1]] : '';
					$row_emp_id = isset($row['employee_id']) ? $row['employee_id'] : '';
						
					echo "<td> <b>". $row[$row_s[0]] ."</b>";
					echo "<p>". $row_s1 ."</p> </td>";
					
					if ($row_s[2] === 'status' || $row_s[2] === 'harvest_oc'){
						
						$status_tag = $row[$row_s[2]];
						$status_frm = "";
						
						switch ($status_tag){	
							case "In Use":
							$status_frm = "stat-light-blue";
							break;
								
							case "In Maintenance":
							$status_frm = "stat-light-grey";
							break;
								
							case "Returned":
							$status_frm = "stat-light-green";
							break;
								
							case "Pending":
							$status_frm = "stat-light-grey";
							break;
								
							case "Completed":
							$status_frm = "stat-light-green";
							break;
								
							case "In Progress":
							$status_frm = "stat-light-orange";
							break;		
								
							case "Harvested":
							$status_frm = "stat-light-green";
							break;	
								
							case "Approved":
							$status_frm = "stat-dark-green";
							break;	
								
							case "Denied":
							$status_frm = "stat-dark-tan";
							break;
						}
						
						
						echo "<td> <span class='status-tag ".$status_frm."'>". $row[$row_s[2]] ."</span> </td>";
						
						for ($i = 3; $i < count($row_s); $i++) {
							$column = $row_s[$i]; // Access the element at index $i
							echo "<td>" . htmlspecialchars($row[$column]) . "</td>";						
						}
					} else{
						for ($i = 2; $i < count($row_s); $i++) {
							$column = $row_s[$i]; // Access the element at index $i
							echo "<td>" . htmlspecialchars($row[$column]) . "</td>";						
						}
					}
					


						// For Employee level
						if ($userLevel === 'Employee') {
							if (isset($read_qry[$txn]['act_e']) && count($read_qry[$txn]['act_e']) > 0) {
								echo '<td class="action-col">';
								/*if ($row_emp_id == $employee_id) {*/
								foreach ($read_qry[$txn]['act_e'] as $action) {
									if ($action === 'view') { //$employee_id
										echo '<a href="index.php?page=view&txn=' . $txn . '&id=' . $row['id'] . '" title="View more information"><i class="fa-solid fa-eye"></i></a>';
									} elseif ($action === 'update') {
										if ($row_emp_id == $employee_id) {
											echo '<a href="index.php?page=update&txn=' . $txn . '&id=' . $row['id'] . '" title="Update records"><i class="fa fa-pen"></i></a>';
										}
									} elseif ($action === 'delete') {
										echo '<a href="index.php?page=delete&txn=' . $txn . '&id=' . $row['id'] . '" title="Delete"><i class="fa fa-trash"></i></a>';
									} elseif ($action === 'request') {
										$dateTimeObject = new DateTime($row['log_date']); // Convert string to DateTime object
										$fm_date = date_format($dateTimeObject, 'ymd'); // Format it


										$fm_empid = sprintf('%03d', $employee_id); // Format with leading zeros


										if ($row['status'] === 'Approved' || $row['hrs_ot'] == 0) {
											echo '';
										} elseif ($row['id'] == 0) {
											echo '<a href="index.php?page=create&txn=' . htmlspecialchars($txn) . '&file_ticket=' . htmlspecialchars($fm_date) . htmlspecialchars($fm_empid) . '"><i class="fa-regular fa-file"></i>Create file</a>';
										} elseif ($row['id'] > 0) {
											echo '<a href="index.php?page=update&txn=' . htmlspecialchars($txn) . '&file_ticket=' . htmlspecialchars($fm_date) . htmlspecialchars($fm_empid) . '&id=' . htmlspecialchars($row['id']) . '"><i class="fa-solid fa-pen"></i>Edit file</a>';
										}															
									}
								}
								/*}*/
								echo '</td>'; // End actions column
							}
						}

						// For Admin level
						elseif ($userLevel === 'Admin') {
							if (isset($read_qry[$txn]['act_a']) && count($read_qry[$txn]['act_a']) > 0) {
								echo '<td class="action-col">';
								/*if ($row_emp_id != $employee_id) {*/
									foreach ($read_qry[$txn]['act_a'] as $action) {
										if ($action === 'view') {
											echo '<a href="index.php?page=view&txn=' . htmlspecialchars($txn) . '&id=' . $row['id'] . '" title="View more information"><i class="fa-solid fa-eye"></i></a>';
										} elseif ($action === 'update') {
											echo '<a href="index.php?page=update&txn=' . htmlspecialchars($txn) . '&id=' . $row['id'] . '" title="Update records"><i class="fa fa-pen"></i></a>';
										} elseif ($action === 'delete') {
											echo '<a href="index.php?page=delete&txn=' . htmlspecialchars($txn) . '&id=' . $row['id'] . '" title="Delete"><i class="fa fa-trash"></i></a>';
										}
									}
								/*}*/
								echo '</td>'; // End actions column
							}
						}
					echo "</tr>";					
				}
			} else {
				echo "<tr><td colspan='" . count($thead) . "'>No records found</td></tr>";
			}
			echo "</tbody>";

			// End the table HTML
			echo "</table>";

			
			/*//PAGINATION SQL
		   $sql = "SELECT COUNT(*) AS total FROM {$table} {$where}";
		   $result = $conn->query($sql);
		   $row = $result->fetch_assoc();
		   $totalRecords = $row["total"];
		   $totalPages = ceil($totalRecords / $recordsPerPage);

		   echo "<div class='pagination'>";

		   if ($totalPages > 1) {
			 for ($i = 1; $i <= $totalPages; $i++) {
			   if ($i == $currentPage) {
				 echo "<a class='active' href='index.php?page=read&txn=$txn&pg=$i'>$i</a> ";
			   } else {
				 echo "<a href='index.php?page=read&txn=$txn&pg=$i'>$i</a> ";
			   }
			 }
		   }

		   echo "</div>";*/
			
			
		} elseif ($read_qry[$txn]['view'] === 'gantt') {
			include 'includes/gantt.php';		
		} 
			
			
			
			
			
			
		?>
		
			
	</div>
</section>
		

<script>
function searchFunc() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search-input");
  filter = input.value.toUpperCase();
  table = document.getElementById("search-table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>	
	
<script>	
// Get references to the dropdown and table body
const categoryDropdown = document.getElementById('category');
const tableBody = document.getElementById('table-body');

// Add an event listener for changes in the dropdown
categoryDropdown.addEventListener('change', function() {
    const selectedCategory = this.value;

    // Get all table rows
    const rows = tableBody.getElementsByTagName('tr');

    // Loop through the rows and show/hide based on the selected category
    for (let row of rows) {
        const rowCategory = row.getAttribute('data-category');

        // Show the row if it matches the selected category or "all" is selected
        if (selectedCategory === 'all' || rowCategory === selectedCategory) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    }
});

</script>


