

	<div class="panel-med">
		    <div class="header">
				<h2><?= ucfirst($mode) . " " .  $panel_b[$txn]['title']?> record</h2>
			</div>
			<div class="form_box">
				<!-- Display error message if any -->
				<?php if ($error): ?>
					<h2 style="color:red;"><?= htmlspecialchars($error) ?></h2>
				<?php endif; ?>

				<!-- Display success message if any -->
				<?php if (isset($_GET['success'])): ?>
					<h2 style="color:green;"><?= htmlspecialchars($_GET['success']) ?></h2>
					<br>
					<a href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>" class="btn btn-green">View Records</a>
				<?php else: 
					/* The form for create/update */
					include 'includes/form_fields.php'; ?>
        		<?php endif; ?>
				
				

			
			</div>
				

		
		</div>



		<?php if ($mode === 'update') { ?>
        <div class="panel-med" <?php echo $panel_b[$txn]['display']?>>
		
			<?php if ($panel_b[$txn]['type'] === 'timeline-table'):
				$sql = $panel_b[$txn]['sql'];
			 	$result = $conn->query($sql); 
			 	$panel_b_rows =  $panel_b[$txn]['rows'];
			 	$panel_b_thead =  $panel_b[$txn]['thead'];
			?>
			
			    <table class="table-green">
					<thead>
						<tr>
							<th style='width: 10%;'> </th>
							<?php
								$max = count($panel_b_rows); // Get the maximum number of rows		
								for ($i = 0; $i < $max; $i++) {
									echo "<th>" . $panel_b_thead[$i] . "</th>";
								}							
							?>
							
							
						</tr>
					</thead>
					<tbody>
						<?php
							// Output the table rows
							if ($result->num_rows > 0) {
								while ($row = $result->fetch_assoc()) {
									if ($row['id'] == $data['id']) {
										$indicator = "►"; // Right triangle symbol$data['id']
									} else {
										$indicator = "<a href='index.php?page=update&txn=$txn&id=".$row['id']."'> ".$row['id']." </a>"; 
									}

									
									
									
									echo "<tr>";
									echo "<td style='background-color: #E3DED1;'>" . $indicator . "</td>";
														
									$max = count($panel_b_rows); // Get the maximum number of rows		
									for ($i = 0; $i < $max; $i++) {
										
										$status_tag = $row[$panel_b_rows[$i]];
										$status_frm = "";

										switch ($status_tag){	
											case "In Use":
											$status_frm = "status-tag stat-light-blue";
											break;

											case "In Maintenance":
											$status_frm = "status-tag stat-light-grey";
											break;

											case "Returned":
											$status_frm = "status-tag stat-light-green";
											break;

											case "Pending":
											$status_frm = "status-tag stat-light-grey";
											break;

											case "Completed":
											$status_frm = "status-tag stat-light-green";
											break;

											case "In Progress":
											$status_frm = "status-tag stat-light-orange";
											break;		

											case "Harvested":
											$status_frm = "status-tag stat-light-green";
											break;	

											case "Approved":
											$status_frm = "status-tag stat-dark-green";
											break;	

											case "Denied":
											$status_frm = "status-tag stat-dark-tan";
											break;
												
											default:
											$status_frm = "";
										}
										
										echo "<td> <span class='".$status_frm."'> " . $row[$panel_b_rows[$i]] . "</span> </td>";
									}
									
									echo "</tr>";
								}
							} else {
								echo "<tr><td colspan='4'>No records found.</td></tr>"; // Handle no records case
							}
						?>
					</tbody>
				</table>
			

			<?php elseif ($panel_b[$txn]['type'] === 'emp-request'):
				$sql = "SELECT *, CONCAT(employee.first_nm, ' ', employee.last_nm) AS full_name 
						FROM employee_record 
						LEFT JOIN `employee` ON `employee`.`id` = `employee_record`.`employee_id` 
						WHERE `employee_record`.`id` = {$data['id']}";

				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// Fetch the row data
					$row = $result->fetch_assoc();

					if ($row['record_type'] == 'Overtime'){
						$thead_o = ['Date Filed', 'File Ticket', 'Name', 'Record Type', 'Reason'];
						$rows_o = ['date_filed', 'file_ticket', 'full_name', 'record_type', 'reason'];

						for ($i = 0; $i < count($thead_o); $i++) {
							echo "<label>{$thead_o[$i]}:</label> ";
							echo "<b>{$row[$rows_o[$i]]}</b><br>"; 
						}
					}
					
					if ($row['record_type'] == 'Leave'){
						$thead_o = ['Date Filed', 'Name', 'Record Type', 'Leave Type', 'Start Date', 'End Date', 'Reason'];
						$rows_o = ['date_filed', 'full_name', 'record_type', 'leave_type', 'start_dt', 'end_dt', 'reason'];

						for ($i = 0; $i < count($thead_o); $i++) {
							echo "<label>{$thead_o[$i]}:</label> ";
							echo "<b>{$row[$rows_o[$i]]}</b><br>"; 
						}
					}
					
					
				} else {
					echo "No records found.";
				}


									   
			?>
			

			
			<?php endif; ?>
		</div>

		<?php } ?>














<script>
document.addEventListener('DOMContentLoaded', function () {
    const budgetedInput = document.querySelector('input[name="amnt_budgeted"]');
    const actualInput = document.querySelector('input[name="amnt_actual"]');
    const remainingInput = document.querySelector('input[name="amnt_remaining"]');

    function updateRemaining() {
        const budgeted = parseFloat(budgetedInput.value) || 0;
        const actual = parseFloat(actualInput.value) || 0;
        remainingInput.value = (budgeted - actual).toFixed(2); // Two decimal places
    }

    budgetedInput.addEventListener('input', updateRemaining);
    actualInput.addEventListener('input', updateRemaining);
});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {
    // Select the input fields for quantity, unit price, and total price
    const quantityInput = document.querySelector('input[name="quantity"]');
    const unitPriceInput = document.querySelector('input[name="unit_prc"]');
    const totalPriceInput = document.querySelector('input[name="total_prc"]');

    // Function to update the total price
    function updateTotalPrice() {
        const quantity = parseFloat(quantityInput.value) || 0; // Default to 0 if not a valid number
        const unitPrice = parseFloat(unitPriceInput.value) || 0; // Default to 0 if not a valid number
        totalPriceInput.value = (quantity * unitPrice).toFixed(2); // Update with the computed value, rounded to 2 decimal places
    }

    // Add event listeners to the quantity and unit price inputs to trigger the computation
    quantityInput.addEventListener('input', updateTotalPrice);
    unitPriceInput.addEventListener('input', updateTotalPrice);

    // Initial update when the page loads (in case there's pre-filled data)
    updateTotalPrice();
});
</script>


<?php if ($txn === 'employee'): ?>

<script>
// Select the input fields for first name and birthdate
const firstNameInput = document.querySelector('input[name="first_nm"]');
const birthdateInput = document.querySelector('input[name="birthdate"]');

// Select the output fields for username and password
const usernameInput = document.querySelector('input[name="username"]');
const passwordInput = document.querySelector('input[name="password"]');

// Function to generate username and password
function generateUsernameAndPassword() {
    const firstName = firstNameInput.value;  // Get first name from the input
    const birthdate = birthdateInput.value;  // Get birthdate from the input

    // Generate username (lowercase)
    const username = firstName.toLowerCase();

    // Generate password (Proper case first name + birthdate)
    const password = firstName.charAt(0).toUpperCase() + firstName.slice(1).toLowerCase() + "_" + birthdate;

    // Set the generated username and password to the respective fields
    usernameInput.value = username;
    passwordInput.value = password;
}

// Call the function whenever the input changes or you want to generate the values
firstNameInput.addEventListener('input', generateUsernameAndPassword);
birthdateInput.addEventListener('input', generateUsernameAndPassword);


</script>

<?php endif; ?>