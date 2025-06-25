<?php
$table = $_GET['table'];
$allowedTables = ['items', 'field', 'equipm']; // Add allowed tables here

$columns = [ //saktong names ng tables
	    'items' => [
			'db' => ['id', 'category', 'item_name', 'description', 'unit', 'price', 'ideal_qty'],
			'display' => ['ID', 'Category', 'Item Name', 'Description', 'Unit', 'Price', 'Ideal Quantity'],
		],
		'field' => [
			'db' => ['id', 'field_nm', 'area', 'soil_type', 'irrigation', 'date_added'],
			'display' => ['ID', 'Field Name', 'Area (sqm)', 'Soil Type', 'Irrigation', 'Date Added'],
		],
        // Add other tables' columns as needed
    ];

	
// Mapping for user-friendly titles
$titles = [
	'items' => ['h1' => 'Resource Items', 'tab' => 'RESOURCE ITEMS | ', 'toggle' => 'res-on'],
	'field' => ['h1' => 'Farm Field', 'tab' => 'FIELD | ', 'toggle' => 'res-on'],
];
	
$create_rec = [
    'items' => 'content/create_rec/items.php',
	'field' => 'content/create_rec/field.php',
];

$update_rec = [
    'items' => 'content/update_rec/items.php',
	'field' => 'content/update_rec/field.php',
];

?>