<?php
include 'includes/db.php';
include 'includes/mapping.php'; 

$error = '';
$txn = '';
$id = '';

//$title = $view_qry[$txn]['sql'];
$title = isset($view_qry[$txn]['title']) ? $view_qry[$txn]['title'] : '';


// Check if txn and id are set in the URL
if (isset($_GET['txn']) && isset($_GET['id'])) {
    $txn = $_GET['txn'];
    $id = (int)$_GET['id']; // Cast id to integer for security

    // Check if txn is valid
    if (!array_key_exists($txn, $transactions)) {
        $error = "Invalid transaction type.";
    }
} else {
    $error = "Transaction type and ID must be provided.";
}

if (empty($error)) {
    // Prepare SQL query based on transaction
    $table = $transactions[$txn]; // Get the table name from your mapping
    //$sql = "SELECT * FROM $table WHERE id = ?";
	$sql = $view_qry[$txn]['sql'];
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Fetch the record
    } else {
        $error = "No record found for ID $id.";
    }
    $stmt->close();
}

$thead = $view_qry[$txn]['thead'];



?>

<section class="dashboard-hm">
	<div class="panel-med">
		<div class="header">
			<h2> View <?php echo $title?> record </h2>
		</div>

    <?php if ($error): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php else: ?>
            <?php 
            // Get keys from the data array
            $keys = array_keys($data);
            $keys_ct = count($keys);

            // Use a for loop to iterate through the keys
            for ($x = 0; $x < $keys_ct; $x++) {
                $key = $keys[$x];
                echo "<label>" . $thead[$x] . "</label>";
                echo "<b>" . htmlspecialchars($data[$key]) . "</b> </br>";
            }
            ?>
				
		<br>
        <a class="btn btn-green" href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>">Back to List</a>
		
		<?php if ($userLevel === 'Admin'){ ?>
		<a class="btn btn-green-outline" href="index.php?page=update&txn=<?= htmlspecialchars($txn) ?>&id=<?= $id ?>">Update record</a>
		
		<?php } ?>
    <?php endif; ?>
	
	</div>
	
	
	<div class="panel-med" <?php echo $view_qry[$txn]['panel_b']['display'];?>>
	
		<?php
		
			$panel_b = $view_qry[$txn]['panel_b'];
		
			$sql = $panel_b['sql'];
			$stmt = $conn->prepare($sql);
			$stmt->bind_param("i", $id); 
			$stmt->execute();
			$result = $stmt->get_result();

			// Initialize an array to store results
			$transactions = [];

			if ($result->num_rows > 0) {
				// Fetch rows as associative arrays
				while ($row = $result->fetch_assoc()) {
					$transactions[] = $row;
				}
			} else {
				echo "No records found";
			}

			$stmt->close();
		
		
		#Timeline - transaction

		if ($panel_b['type'] === 'timeline-trans'): ?>
			<div class="timeline1">
			<?php
			// Check if there are transactions
			if (!empty($transactions)) {
				foreach ($transactions as $transaction) { ?>

					<div class="timeline-item">
						<div class="timeline-date"><?php echo date('M d Y', strtotime($transaction[$panel_b['rows'][0]])); ?></div>
						<div class="timeline-content">
							<div class="transaction-title">
								<?php echo strtoupper($transaction[$panel_b['rows'][1]]); ?>
							</div>
							<div class="transaction-details">
								<?php echo $transaction[$panel_b['rows'][2]];?>
							</div>
							<div class="modify-button">							
								<?php 
									$empses_id = $_SESSION['user_id'];
									$emplog_id = $transaction[$panel_b['rows'][3]];

									if ($empses_id == $emplog_id){
								?>

								<a href="index.php?page=update&txn=<?php echo $txn.'_'.substr(strtolower($transaction[$panel_b['rows'][1]]),0, 1) ?>&id=<?php echo $transaction['id']; ?>"> Modify <i class="fa-solid fa-chevron-right"></i></a>		
							<?php } ?>
								</div> 					
						</div>
					</div>
				<?php }
			} else {
				echo '<p>No transactions available for this equipment.</p>';
			}
			?>

			</div>
		
		
		<?php elseif ($panel_b['type'] === 'maps'):?>
			<?php
			// Check if there are transactions
			if (!empty($transactions)) {
				foreach ($transactions as $transaction) { ?>		
				<form action="" method="post">
					<input type="hidden" id="geometry" name="geometry" value='<?php echo $transaction[$panel_b['rows'][0]]; ?>'>
					<div id="map" style="width: 100%; height: 400px; border-radius: 5px;"></div>
				</form>
		
		<?php
				}
			}
		endif; ?>
		
	</div>
	
	
</section>


<section class="dashboard-hm"  <?php echo $view_qry[$txn]['panel_c']['display'];?>>
	<div class="panel-big timeline2">
		<?php
		$sql = "SELECT planting_dt, harvest_dt FROM crop WHERE id = $id";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// Fetch the crop data
			$row = $result->fetch_assoc();
			$planting_dt = $row['planting_dt'];
			$harvest_dt = $row['harvest_dt'];
		} else {
			echo "No crop data found";
		}

		$conn->close();
		?>
		
		
		
		
		<div class="timeline-container">
			<div class="timeline-item">
				<img src="http://localhost/terrarms/wp-themes/img/plant_prog1.png" alt="Planting" class="timeline-icon">
				<div class="timeline-label">
					<p>Planting Date</p>
					<strong id="planting-date"><?php echo $planting_dt; ?></strong>
				</div>
			</div>
	
			<div class="timeline-item">
				<img src="http://localhost/terrarms/wp-themes/img/plant_prog2.png" alt="Harvesting" class="timeline-icon">
			</div>	
			
			
			<div class="timeline-item">
				<div class="timeline-label">
					<p>Harvesting Date</p>
					<strong id="harvesting-date"><?php echo $harvest_dt; ?></strong>
				</div>
				<img src="http://localhost/terrarms/wp-themes/img/plant_prog3.png" alt="Harvesting" class="timeline-icon">
			</div>			
			
		</div>
		
        <div class="progress-bar-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>

        <!--div class="modify-button">
			<a href="index.php?page=update&txn=/ htmlspecialchars($txn) ?>&id= //$id ?>"> Modify <i class="fa-solid fa-chevron-right"></i></a>
        </div-->
	</div>
</section>


<script src="wp-themes/js/field_draw_vw.js"></script>


<script>

// Planting and harvesting dates
const plantingDate = new Date('<?php echo $planting_dt; ?>');
const harvestingDate = new Date('<?php echo $harvest_dt; ?>');
const currentDate = new Date(); // Current date

// Get the progress bar element
const progressBar = document.getElementById('progress-bar');

// Function to calculate the percentage of time passed
function calculateProgress(plantingDate, harvestingDate, currentDate) {
    const totalTime = harvestingDate - plantingDate; // Total time between planting and harvesting
    const timePassed = currentDate - plantingDate; // Time passed since planting
    const progress = (timePassed / totalTime) * 100; // Calculate percentage
    return Math.min(Math.max(progress, 0), 100); // Ensure it stays between 0% and 100%
}

// Update the progress bar width based on the calculated percentage
const progressPercentage = calculateProgress(plantingDate, harvestingDate, currentDate);
progressBar.style.width = progressPercentage + '%';
	
</script>
