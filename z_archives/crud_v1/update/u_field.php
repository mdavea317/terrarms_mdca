<?php

// Get and validate the ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Convert to integer
if ($id <= 0) {
    die("Invalid ID");
}

// Fetch the existing field data
$sql = "SELECT * FROM `field` WHERE `id` = $id";
$result = $conn->query($sql);
$field = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $field_nm = $_POST['field_nm'];
    $area = $_POST['area'];
    $soil_type = $_POST['soil_type'];
    $irrigation = $_POST['irrigation'];
    
    $sql = "UPDATE `field` 
            SET `field_nm` = '$field_nm', 
                `area` = '$area', 
                `soil_type` = '$soil_type', 
                `irrigation` = '$irrigation' 
            WHERE `id` = '$id'";

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

			<form method="POST" action="index.php?page=update&table=field&id=<?php echo $id; ?>">

				<h3>Field ID: <?php echo htmlspecialchars($field['id']); ?></h3> <!-- Display ID -->

				<label for="field_nm">Field Name</label>
				<input type="text" id="field_nm" name="field_nm" class="input-field" value="<?php echo htmlspecialchars($field['field_nm']); ?>" required> <br>

				<label for="area">Area (in sq meters)</label>
				<input type="number" id="area" name="area" class="input-field" value="<?php echo htmlspecialchars($field['area']); ?>" required> <br>

				<label for="soil_type">Soil Type</label>
				<select id="soil_type" name="soil_type" class="input-field" required>
					<option value="">Select</option>
					<option value="Loam" <?php echo ($field['soil_type'] == 'Loam') ? 'selected' : ''; ?>>Loam</option>
					<option value="Clay" <?php echo ($field['soil_type'] == 'Clay') ? 'selected' : ''; ?>>Clay</option>
					<option value="Sandy Loam" <?php echo ($field['soil_type'] == 'Sandy Loam') ? 'selected' : ''; ?>>Sandy Loam</option>
					<option value="Loamy Sand" <?php echo ($field['soil_type'] == 'Loamy Sand') ? 'selected' : ''; ?>>Loamy Sand</option>
					<option value="Silt" <?php echo ($field['soil_type'] == 'Silt') ? 'selected' : ''; ?>>Silt</option>
				</select>
				<br>

				<label for="irrigation">Irrigation Type</label>
				<select id="irrigation" name="irrigation" class="input-field" required>
					<option value="">Select</option>
					<option value="Sprinkler" <?php echo ($field['irrigation'] == 'Sprinkler') ? 'selected' : ''; ?>>Sprinkler</option>
					<option value="Furrow" <?php echo ($field['irrigation'] == 'Furrow') ? 'selected' : ''; ?>>Furrow</option>
					<option value="Deep Irrigation" <?php echo ($field['irrigation'] == 'Deep Irrigation') ? 'selected' : ''; ?>>Deep Irrigation</option>
					<option value="Drip Irrigation" <?php echo ($field['irrigation'] == 'Drip Irrigation') ? 'selected' : ''; ?>>Drip Irrigation</option>
				</select>
				<br>

				<button type="submit" class="btn btn-green" value="Save Record">Save Record</button>
				<a class="btn btn-red-outline" href="index.php?page=read&table=field">Cancel</a>
			</form>
			</div>
		</div>
		<div class="panel-med">
			Mapa
		</div>
