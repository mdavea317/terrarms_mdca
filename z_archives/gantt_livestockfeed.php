<?php
// Connect to the database
$sql = "SELECT 
			ll.id,
			l.livestock_nm,
			ll.feed_start_dt,
			ll.feed_end_dt,
			ll.feed_type,
			ll.feed_qty,			
			ll.notes
		FROM 
			livestock l
		JOIN 
			livestock_log ll ON l.id = ll.livestock_id
		WHERE 
			ll.record_type LIKE '%feed%'";
$result = $conn->query($sql);

// Prepare data for Google Charts
$rows = [];
while ($row = $result->fetch_assoc()) {
    $startDate = date('Y, m, d', strtotime($row['feed_start_dt']));
    $endDate = date('Y, m, d', strtotime($row['feed_end_dt']));
    // Create tooltip text with type and quantity
    $rows[] = "['" . $row['livestock_nm'] . "', '" . $row['feed_type'] . "', new Date($startDate), new Date($endDate)]";
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

        dataTable.addColumn({ type: 'string', id: 'Livestock Id' });
        dataTable.addColumn({ type: 'string', id: 'Type' });
        dataTable.addColumn({ type: 'date', id: 'Start' });
        dataTable.addColumn({ type: 'date', id: 'End' });
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
