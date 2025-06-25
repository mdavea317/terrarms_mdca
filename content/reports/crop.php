<?php

// Start output buffering to prevent unwanted output
ob_start();
include 'includes/db.php';
	$menu_toggle = 'rep-on';
	$breadc_if_active = "style='display:none'";

// Query data
$sql = "SELECT * FROM crop";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$conn->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $format = $_POST['format'];

    if ($format == 'pdf') {
        // Include FPDF library
        require('wp-themes/fpdf186/fpdf.php');


        // Start generating the PDF
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'Crop Report', 0, 1, 'C');
        $pdf->Ln(10); // New line
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(10, 10, 'ID');
        $pdf->Cell(80, 10, 'Crop Name');
        $pdf->Cell(40, 10, 'Estimated Yield');
        $pdf->Cell(30, 10, 'Planting Date');
        $pdf->Cell(30, 10, 'Harvest Date');
        $pdf->Ln();

        // Add data to PDF
        foreach ($data as $row) {
            $pdf->Cell(10, 10, $row['id']);
            $pdf->Cell(80, 10, $row['crop_nm']);
            $pdf->Cell(40, 10, $row['est_yield']);
            $pdf->Cell(30, 10, $row['planting_dt']);
            $pdf->Cell(30, 10, $row['harvest_dt']);
            $pdf->Ln();
        }

        // Output the PDF as a downloadable file
        $pdf->Output('D', 'crop_report.pdf'); // D for download
        exit(); // Stop further execution to ensure no extra output
    } elseif ($format == 'html') {
        // Output HTML table with data
        echo "<h1>Crop Report</h1>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Crop Name</th><th>Estimated Yield</th><th>Planting Date</th><th>Harvest Date</th></tr>";

        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['crop_nm'] . "</td>";
            echo "<td>" . $row['est_yield'] . "</td>";
            echo "<td>" . $row['planting_dt'] . "</td>";
            echo "<td>" . $row['harvest_dt'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
        exit(); // End execution to prevent further page refresh
    }
}
ob_end_clean();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Report Generation</title>
</head>
<body>

<h1>Generate Crop Report</h1>
<form method="post" action="">
    <label for="format">Select Report Format:</label>
    <select name="format" id="format">
        <option value="pdf">PDF</option>
        <option value="html">HTML</option>
    </select>
    <button type="submit">Generate Report</button>
</form>


</body>
</html>
