<?php
$tabledb = $_GET['table']; // Get the database table name from the URL

// Define your tables and their corresponding file paths
$tablename = [
    'items' => ['name' => 'items', 'db' => 'items', 'file' => 'content/read/r_items.php'],
	'field' => ['name' => 'field', 'db' => 'field', 'file' => 'content/read/r_field.php'],
	'equipm_usage' => ['name' => 'equipm_usage', 'db' => 'equipm_log', 'file' => 'content/read/r_equipm_usage.php'],
    // Add more tables as needed
];

// Check if the table exists in your defined array
if (array_key_exists($tabledb, $tablename)) {
    $dbTable = $tablename[$tabledb]['db'];
    $filePath = $tablename[$tabledb]['file'];
	$nmTable = $tablename[$tabledb]['name'];
	
	
// Mapping for user-friendly titles
	$titles = [
		'items' => ['h1' => 'Item list', 'parent' => 'Resource Item', 'tab' => 'RESOURCE ITEMS | ', 'toggle' => 'res-on'],
		'field' => ['h1' => 'Farm field', 'parent' => 'Resource Item', 'tab' => 'FARM FIELD | ', 'toggle' => 'res-on'],
		'equipm_usage' => ['h1' => 'Equipment usage', 'parent' => 'Equipment', 'tab' => 'EQUIPMENT | ', 'toggle' => 'equ-on'],
	];

	$create_rec = [
		'items' => 'content/create/c_items.php',
		'field' => 'content/create/c_field.php',
		'equipm_usage' => 'content/create/c_equipm_usage.php',
	];
	
	$view_rec = [
		'field' => 'SELECT * FROM `field`',
	];
	
	$update_rec = [
		'items' => 'content/update/u_items.php',
		'field' => 'content/update/u_field.php',
	];
} else {
    echo "Invalid table selected.";
}
?>