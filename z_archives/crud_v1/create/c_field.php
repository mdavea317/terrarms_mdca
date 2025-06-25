<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$field_nm = $_POST['field_nm'];
	$area = $_POST['area'];
	$soil_type = $_POST['soil_type'];
	$irrigation = $_POST['irrigation'];
	$date_added = date('Y-m-d');

	$sql = "INSERT INTO `field` (`field_nm`, `area`, `soil_type`, `irrigation`, `date_added`) 
			VALUES ('$field_nm', '$area', '$soil_type', '$irrigation', '$date_added')";

	if ($conn->query($sql) === TRUE) {
		header("Location: index.php?page=read&table=field&status=success");
		exit;
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		header("Location: index.php?page=read&table=field&status=error");
		exit;
	}
}

?>
	
		<div class="panel-med">
			<div class="header">
				<h2> Create farm field record </h2>
			</div>
			<div class="form-box">
				<form method="POST" action="index.php?page=create&table=field">

					<!-- ID is auto-incremented in the database, so no need for it in the form -->

					<label for="field_nm">Field Name</label>
					<input type="text" id="field_nm" name="field_nm" class="input-field" required> <br>

					<label for="area">Area (in sq meters)</label>
					<input type="number" id="area" name="area" class="input-field" required> <br>

					<label for="soil_type">Soil Type</label>
					<select id="soil_type" name="soil_type" class="input-field" required>
						<option value="">Select</option>
						<option value="Loam">Loam</option>
						<option value="Clay">Clay</option>
						<option value="Sandy Loam">Sandy Loam</option>
						<option value="Loamy Sand">Loamy Sand</option>
						<option value="Silt">Silt</option>
					</select>
					<br>


					<label for="irrigation">Irrigation Type</label>
					<select id="irrigation" name="irrigation" class="input-field" required>
						<option value="">Select</option>
						<option value="Sprinkler">Sprinkler</option>
						<option value="Furrow">Furrow</option>
						<option value="Deep Irrigation">Deep Irrigation</option>
						<option value="Drip Irrigation">Drip Irrigation</option>
					</select>
					<br>

					<!-- date_added will be auto-generated in the PHP script using the current timestamp -->

					<button type="submit" class="btn btn-green" value="Save Record">Save Record</button>
					<a class="btn btn-red-outline" href="index.php?page=read&table=field">Cancel</a>

				</form>
			</div>
		</div>
		<div class="panel-med">
			Mapa
		</div>


