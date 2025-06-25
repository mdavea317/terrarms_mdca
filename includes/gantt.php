<?php
// Connect to the database
$sql = $read_qry[$txn]['sql'];
$result = $conn->query($sql);

$data_rw = $read_qry[$txn]['rows'];

// Prepare data for Google Charts
$rows = [];
while ($row = $result->fetch_assoc()) {
    $startDate = date('Y, m, d', strtotime($row[$data_rw[2]]));
    $endDate = date('Y, m, d', strtotime($row[$data_rw[3]]));
    // Create tooltip text with type and quantity
    $rows[] = "['" . $row[$data_rw[1]] . "', '" . $row[$data_rw[4]] . "', new Date($startDate), new Date($endDate)]";
}

$conn->close();
?>

<script type="text/javascript" src="wp-themes/js/gcharts_loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['timeline']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var container = document.getElementById('timeline-tooltip');
        var chart = new google.visualization.Timeline(container);
        var dataTable = new google.visualization.DataTable();

		<?php foreach ($read_qry[$txn]['add_col'] as $column) { ?>
		  dataTable.addColumn({ type: '<?php echo $column['type']; ?>', id: '<?php echo $column['id']; ?>' });
		<?php } ?>

		// Add rows of data from PHP
		dataTable.addRows([
		  <?php echo implode(',', $rows); ?>
		]);
		  
		  
		var options = {
			colors: ['#D9E289', '#C0CF3A', '#94A027'],
		  timeline: {
			  colorByRowLabel: false,
			  showRowLabels: true,
		  },
			
		  alternatingRowStyle: false
		};	  

        chart.draw(dataTable, options);
      }
    </script>

<div id="timeline-tooltip" style="height: 300px;"></div>
