<?php
// Connect to the database
$sql = "SELECT crop_nm, planting_dt, harvest_dt FROM crop";
$result = $conn->query($sql);

// Prepare data for Google Charts
$rows = [];
while ($row = $result->fetch_assoc()) {
    $plantingDate = date('Y, m, d', strtotime($row['planting_dt']));
    $harvestDate = date('Y, m, d', strtotime($row['harvest_dt']));
    $rows[] = "['" . $row['crop_nm'] . "', new Date($plantingDate), new Date($harvestDate)]";
}

$conn->close();
?>

<script type="text/javascript" src="wp-themes/js/gcharts_loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['timeline']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var container = document.getElementById('timeline');
    var chart = new google.visualization.Timeline(container);
    var dataTable = new google.visualization.DataTable();

    dataTable.addColumn({ type: 'string', id: 'Crop' });
    dataTable.addColumn({ type: 'date', id: 'Planting Date' });
    dataTable.addColumn({ type: 'date', id: 'Harvest Date' });

    // Add rows of data from PHP
    dataTable.addRows([
      <?php echo implode(',', $rows); ?>
    ]);

    // Set options to define color for all bars
    var options = {
      timeline: {
		  singleColor: '#455F51',		  
	  },
		
    };

    chart.draw(dataTable, options);
  }

	
</script>


<div id="timeline" style="height: 300px;"></div>
