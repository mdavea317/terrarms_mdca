<?php


    $field_nm = $_POST['field_nm'];
    $area = $_POST['area'];
    $soil_type = $_POST['soil_type'];
    $irrigation = $_POST['irrigation'];
    $date_added = $date_added = date('Y-m-d H:i:s'); // Current date and time in MySQL format
    $geometry = $_POST['geometry'];

    // Decode JSON geometry
    $geometryData = json_decode($geometry, true);
	$geometryJson = json_encode($geometryData); // Encode the geometry array to JSON
   // echo "<pre>$geometryJson</pre>";


    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `field` (field_nm, area, soil_type, irrigation, date_added, geometry) 
                VALUES ('$field_nm', '$area', '$soil_type', '$irrigation', '$date_added', '$geometryJson')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `field` SET 
                field_nm = '$field_nm', 
                area = '$area', 
                soil_type = '$soil_type', 
                irrigation = '$irrigation', 
                date_added = '$date_added',
				geometry = '$geometryJson'				
                WHERE id = $id";
    }
/*

	$field_nm = $_POST['field_nm'];
    $area = $_POST['area'];
    $soil_type = $_POST['soil_type'];
    $irrigation = $_POST['irrigation'];
    $date_added = $_POST['date_added'];

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `field` (field_nm, area, soil_type, irrigation, date_added) 
                VALUES ('$field_nm', '$area', '$soil_type', '$irrigation', '$date_added')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `field` SET 
                field_nm = '$field_nm', 
                area = '$area', 
                soil_type = '$soil_type', 
                irrigation = '$irrigation', 
                date_added = '$date_added' 
                WHERE id = $id";
    }
	*/
	
?>
