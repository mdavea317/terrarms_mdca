<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

$empID = intval($_SESSION['user_id']); // Sanitize ID
$report = isset($_GET['report']) ? $_GET['report'] : '';

// Include database connection
include 'includes/db.php';

// Default titles and settings
$title = "REPORTS | ";
$title_h1 = "Reports";
$breadc_if_active = "style='display:none'";
$menu_toggle = 'rep-on';

// Define the report generation configuration
$repgen_qry = [
    'crop' => [
        'title' => 'Crop Information',
        'table' => 'crop',
        'thead' => ['Crop Name', 'Est. Yield', 'Planting Date', 'Harvesting Date'],
        'row_s' => ['crop_nm', 'est_yield', 'planting_dt', 'harvest_dt'],
        'where' => "",
    ],
	'schedule' => [
        'title' => 'Schedule',
        'table' => 'employee_log',
        'thead' => ['Date', 'Shift Start', 'Shift End', 'Task'],
        'row_s' => ['log_date', 'shift_st', 'shift_ed', 'task'],
        'where' => "WHERE employee_id = '$empID'",
    ],
	'payslip' => [
        'title' => 'Payslip',
        'table' => 'payroll_data',
        'thead' => ['Pay Period Start', 'Pay Period End', 'Daily Rate', 'Gross Pay', 'Deduction', 'Take Home Pay'],
		'row_s' => ['pay_period_st', 'pay_period_ed', 'wage_daily','gross_pay','total_deductions','take_home_pay'],
        'where' => "WHERE employee_id = '$empID'",
    ],
];

// Check if the selected report exists in the configuration
if (!isset($repgen_qry[$report])) {
    die('Invalid report type.');
}

$table = $repgen_qry[$report]['table'];
$title_r = $repgen_qry[$report]['title'];
$thead = $repgen_qry[$report]['thead'];
$row_s = $repgen_qry[$report]['row_s'];
$where = $repgen_qry[$report]['where'];

$sql = "SELECT * FROM {$table} {$where}";
$result = $conn->query($sql);

$data = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the connection
$conn->close();

// Handle report generation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $format = $_POST['format'];

    if ($format === 'pdf') {
        // Include FPDF library
        require('wp-themes/fpdf186/fpdf.php');

        // Start generating the PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Add report title
        $pdf->Cell(0, 10, $title_r, 0, 1, 'C');
        $pdf->Ln(10); // New line
        $pdf->SetFont('Arial', '', 11);

        // Add table headers
        foreach ($thead as $col) {
            $pdf->Cell(30, 10, $col, 1); // Adjust the width (40) as per your need
        }
        $pdf->Ln();

        // Add data to PDF
        foreach ($data as $row) {
            foreach ($row_s as $key) {
                $pdf->Cell(30, 10, $row[$key], 1); // Dynamically fetch value by key
            }
            $pdf->Ln(); // Line break for the next row
        }

        // Output the PDF as a downloadable file
        $pdf->Output('D', $report . '_report.pdf'); // D for download
        exit(); // Stop further execution to ensure no extra output
    }

	elseif ($format == 'html') {
        // Output HTML table with data
		
		echo "<div class='panel-big'> <div class='header'>";
        echo "<h2> Report for ". strtolower($title_r) ." </h2> </div>";
        echo "<table class='table-green'>";
		echo "<tr>";
		foreach ($thead as $col) {
            echo "<th>".$col."</th>";
        }
		echo "</tr>";
        //echo "<tr><th>ID</th><th>Crop Name</th><th>Estimated Yield</th><th>Planting Date</th><th>Harvest Date</th></tr>";

        foreach ($data as $row) {
            echo "<tr>";
            foreach ($row_s as $key) {
                echo "<td>" . $row[$key] . "</td>";
            }
            echo "</tr>";
        }

        echo "</table> <br>";
		echo "<button onclick='window.location.href=window.location.href;' class='btn btn-green'>Clear Report</button>";
		echo "</div>";
		
        //exit(); // End execution to prevent further page refresh
    }
}	
?>

<section class="dashboard-hm">
	<div class="panel-med">
		<div class="header">
			<h2> Generate report for <?php echo strtolower($title_r) ?> </h2>
		</div>
		<div class="form-box">
			<form method="post" action="">
				<label for="format">Select Report Format:</label>
				<select name="format" id="format" class="input-field">
					<option value="pdf">PDF</option>
					<option value="html">HTML</option>
				</select>

				<br>
				
				<?php if ($repgen_qry['payslip']){ ?>
					<a href="http://localhost/terrarms/payroll_details.pdf" target="_blank" class="btn btn-green">
						Generate Report
					</a>

				<?php } else { ?>
					<button type="submit" class="btn btn-green">Generate Report</button>
				<?php } ?>


				
				<a href="index.php?page=report" class="btn btn-green-outline">Back to Home</a>
			</form>
		</div>
	</div>
</section>