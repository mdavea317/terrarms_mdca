<?php
	$title = "DASHBOARD | ";
	$menu_toggle = 'das-on';
	$breadc_if_active = "style='display:none'";

	include 'includes/db.php';

	// Get the current year and month
	$current_month = date('m');
	$current_year = date('Y');

	// Get the start and end dates for the current month
	$first_day = date('Y-m-01');
	$last_day = date('Y-m-t');

	$today = date('Y-m-d');
	$empID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
	$userLevel = isset($_SESSION['user_lvl']) ? $_SESSION['user_lvl'] : 0;
	$logged_name = (isset($_SESSION['last_nm']) && isset($_SESSION['first_nm'])) 
		? $_SESSION['last_nm'] . '_' . $_SESSION['first_nm'] 
		: 0;

	$startOfWeek = date('Y-m-d', strtotime('monday this week'));
	$endOfWeek = date('Y-m-d', strtotime('sunday this week'));


	//Time in and time out changing text
	$sql = "SELECT * FROM employee_log WHERE employee_id = $empID AND log_date = '$today'";
	$result = $conn->query($sql);
	$btn_hide_i = "style='display:none;'";
	$btn_hide_o = "style='display:none;'";
	$clock_in = "";
	$clock_out = "";
	$hrs_ot = "";

	if ($result) {
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();

			$clock_in = $row['clock_in'];
			$clock_out = $row['clock_out'];
			$hrs_ot = $row['hrs_ot'];
			
			// Check if hrs_ot is not empty and then format it as h:mm
			if (!empty($hrs_ot)) {
				// Separate the hours and minutes from the decimal hrs_ot
				$hours = floor($hrs_ot);  // Get the whole hours
				$minutes = ($hrs_ot - $hours) * 60;  // Convert fractional part to minutes

				// Format the output as h:mm
				$hrs_ot = sprintf("%d:%02d", $hours, $minutes);
			} else {
				$hrs_ot = "";
			}
			
		}
	} else {
		// Query failed
		echo "Error: " . $conn->error;
	}

	if (empty($clock_in)){
		$btn_hide_i = ""; //naka-display siya
	}
	elseif (!empty($clock_in) && empty($clock_out)){
		$btn_hide_i = "style='display:none;'";		
		$btn_hide_o = ""; //naka-display siya
	}




// Close the connection
//$conn->close();

?>


	<section class="attendance-hm">
		<div class="column">
			<h1><?php echo date("F j"); ?></h1>
			<p><strong><?php echo date("l"); ?></strong></p>
		</div>
		<div class="column">
			<p>Time In</p>
			<h2 id="clock_in"><?php echo empty($clock_in) ? "--" : date("g:i:sA", strtotime($clock_in)); ?></h2>
		</div>
		<div class="column">
			<p>Time Out</p>
			<h2 id="clock_out"><?php echo empty($clock_out) ? "--" : date("g:i:sA", strtotime($clock_out)); ?></h2>
		</div>
		<!--div class="column">
			<p>Overtime (hrs:min)</p>
			<h2><?// php echo empty($hrs_ot) ? "--" : date("g:i", strtotime($hrs_ot)); ?></h2>
		</div--> <!-- to return -->
		<div class="column actions">
			<button id="startAttendance" class="btn btn-white" <?php echo $btn_hide_i?>> Time In? </button>
			<button id="endAttendance" class="btn btn-white" <?php echo $btn_hide_o?>> Time Out?</button>

		</div>
	</section>


	<div class="video-container" style="display:none;">
		<video id="video" width="320" height="240" autoplay></video>
		<canvas id="overlay"></canvas> <!-- For displaying face detection results -->
		
		<br>
		
		    	<button id="closeButton" class="btn btn-red">Close</button>		

	</div>




	    <section class="dashboard-hm">
        <div class="panel-big-hm">
			
			
			<?php
				
				if ($userLevel === 'Employee') { ?>
            <div class="alert header">
                <h2><i class="fa-regular fa-calendar-days"></i> Schedule This Week </h2>
                <a class="btn btn-green" href="index.php?page=read&txn=attendance_s">View All</a>
            </div>
			<?php
						$sql3 = "SELECT * FROM employee_log WHERE `employee_id` = '$empID' AND `log_date` BETWEEN '$startOfWeek' AND '$endOfWeek'";
						$result3 = $conn->query($sql3);

						if ($result3->num_rows > 0) {
							echo "<table class='info-table'>";

							while ($row = $result3->fetch_assoc()) {
								echo "<tr>";
								echo "<td style='width:33%;'>" . date("l, F j", strtotime($row['log_date'])) . "</td>";
								echo "<td>" . date("g:ia", strtotime($row['shift_st'])) . " - " . date("g:ia", strtotime($row['shift_ed'])) . "</td>";
								echo "<td>" . $row['task'] . " <td>";
								echo "</tr>";
							}

							echo "</table>";
						} else {
							// If no rows are found
							echo "<p>No schedule this week.</p>";
						}

						$result3->close();
					
			} elseif ($userLevel === 'Admin') { ?>
            <div class="alert header">
                <h2><i class="fa-solid fa-list-check"></i> Pending Employee Approvals </h2>
            </div>	
			
			<div class="timeline1">
			
			<?php
				$sql_4a = "SELECT *, CONCAT(employee.first_nm, ' ', employee.last_nm) AS full_name
							FROM employee_record
							LEFT JOIN `employee` ON `employee`.`id` = `employee_record`.`employee_id`
							WHERE status = 'Pending'
							ORDER BY date_filed DESC;";
				$result_4a = $conn->query($sql_4a);
			
				if ($result_4a->num_rows > 0) {

						while ($row = $result_4a->fetch_assoc()) { ?>
							<div class='timeline-item'>
								<div class="timeline-date"><?php echo date('M d Y', strtotime($row['date_filed'])); ?></div>
								<div class="timeline-content">
									<div class="transaction-title">
										<?php echo strtoupper($row['record_type']); ?> REQUEST
									</div>
									<div class="transaction-details">
										<?php echo $row['leave_type']; ?>. Requested by <?php echo ucwords($row['full_name']); ?>
									</div>
									<div class="modify-button">						

										<a href="index.php?page=update&txn=employee_r&id=<?php echo $row['id']; ?>"> Modify <i class="fa-solid fa-chevron-right"></i></a>		
										</div> 					
								</div>
						</div>

						<?php	
						}
				} else {
					echo "";
				}
		
			?>
			

			</div>
			
					
					
					
					
					
			<?php } ?>
			
			
			
			

        </div>

        <div class="info-panels">
            <div class="panel">
                <div class="panel-header">
                    <h3>Harvest This Month</h3>
                    <a href="index.php?page=read&txn=crop_s">View More</a>
                </div>
                <div class="panel-body">
					
					<?php
						$sql1 = "SELECT crop_nm, est_yield, harvest_dt FROM `crop` WHERE MONTH(harvest_dt) = $current_month AND YEAR(harvest_dt) = $current_year";
						$result1 = $conn->query($sql1);

						if ($result1->num_rows > 0) {
							echo "<table class='info-table'>";

							while ($row = $result1->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . htmlspecialchars($row['crop_nm']) . "</td>";
								echo "<td>" . htmlspecialchars($row['harvest_dt']) . "<br>";
								echo htmlspecialchars($row['est_yield']) . "kg</td>";
								echo "</tr>";
							}

							echo "</table>";
						} else {
							// If no rows are found
							echo "<p>No crops to harvest this month.</p>";
						}

						$result1->close();
					?>

                </div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h3>Feeding Plans This Month</h3>
                    <a href="index.php?page=read&txn=livestock_f">View More</a>
                </div>
                <div class="panel-body">
					
					<?php
					
						$sql2 = "SELECT 
									l.livestock_nm, 
									lg.feed_type, 
									lg.feed_qty
								FROM 
									livestock_log lg
								JOIN 
									livestock l ON lg.livestock_id = l.id
								WHERE 
									(lg.feed_start_dt BETWEEN ? AND ?) 
									OR 
									(lg.feed_end_dt BETWEEN ? AND ?) 
									OR 
									(lg.feed_start_dt <= ? AND lg.feed_end_dt >= ?)";

						$stmt2 = $conn->prepare($sql2);
						$stmt2->bind_param('ssssss', $first_day, $last_day, $first_day, $last_day, $first_day, $last_day);
						$stmt2->execute();
						$result2 = $stmt2->get_result();

						// Display the results
						if ($result2->num_rows > 0) {
							echo "<table class='info-table'>";

							while ($row = $result2->fetch_assoc()) {
								echo "<tr>";
								echo "<td>" . htmlspecialchars($row['livestock_nm']) . "</td>";
								echo "<td>" . htmlspecialchars($row['feed_type']) . ", ";
								echo htmlspecialchars($row['feed_qty']) . "kg</td>";
								echo "</tr>";
							}

							echo "</table>";
						} else {
							echo "<p>No feed plans for this month.</p>";
						}

						$stmt2->close();
					?>
                </div>
            </div>
        </div>
    </section>

<script>
    const currentUserName = <?php echo json_encode($logged_name); ?>;
</script>
<script src="wp-themes/js/cam_login.js"></script>
