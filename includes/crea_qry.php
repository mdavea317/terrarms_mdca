<?php
/*$mode = '';
$is_update = ($mode === 'update');*/

// _POST for create new and updating existing record
$post_rec = [
	'items' => 'content/post/items.php',
	'field' => 'content/post/field.php',
	'equipment' => 'content/post/equipm.php',
	'equipment_u' => 'content/post/equipm_u.php',
	'equipment_m' => 'content/post/equipm_m.php',
	'crop' => 'content/post/crop.php',
	'crop_p' => 'content/post/crop_p.php',
	'crop_f' => 'content/post/crop_f.php',
	'crop_h' => 'content/post/crop_h.php',
	'livestock' => 'content/post/livestock.php',
	'livestock_v' => 'content/post/livestock_v.php',
	'livestock_f' => 'content/post/livestock_f.php',
	
	'attendance_t' => 'content/post/attendance_t.php',
	'attendance_l' => 'content/post/attendance_l.php',

	'employee' => 'content/post/employee.php',
	'employee_r' => 'content/post/employee_r.php',	
	
	'finance_b' => 'content/post/finance_b.php',
	'finance_e' => 'content/post/finance_e.php',
	'finance_r' => 'content/post/finance_r.php',
	'finance_p' => 'content/post/finance_p.php',	
	
	'allocation_c' => 'content/post/allocation_c.php',
	'allocation_e' => 'content/post/allocation_e.php',
	'allocation_f' => 'content/post/allocation_f.php',
	'allocation_l' => 'content/post/allocation_l.php',
	'allocation_b' => 'content/post/allocation_b.php',

	'purchases' => 'content/post/purchases.php',	
	'distribution' => 'content/post/distribution.php',
	
	'user' => 'content/post/employee.php',
];

// If 2nd panel will be displayed on update.php and create.php
$panel_b = [
	'items' =>[
		'display' => "style='display:none;'",
		'title' => "item",
	],
	'field' =>[
		'display' => "style='display:none;'",
		'title' => "field",
		'type' => "map",
	],
	'equipment' =>[
		'display' => "style='display:none;'",
		'title' => "equipment",
	],
	'equipment_u' =>[
		'display' => " ",
		'title' => "equipment usage",
		'type' => "timeline-table",
		'sql' => "SELECT 
						`equipm_log`.`id`,
						`equipm_log`.`equipment_id`,
						`equipm_log`.`log_date`, 
						CONCAT(`employee`.`first_nm`, ' ', `employee`.`last_nm`) AS `employee_name`, 
						`equipm_log`.`status` 
					FROM 
						`equipm_log` 
					LEFT JOIN 
						`employee` ON `equipm_log`.`employee_id` = `employee`.`id` 
					WHERE 
						`equipm_log`.`equipment_id` = '" . (isset($data['equipment_id']) ? $data['equipment_id'] : "") . "'  
						AND `equipm_log`.`log_type` LIKE '%Avail%' 
					ORDER BY 
						`equipm_log`.`log_date` DESC;",
		'rows' => ['log_date', 'employee_name', 'status'],
        'thead' => ['Date', 'Employee Name', 'Status'],
	],
	'equipment_m' =>[
		'display' => " ",
		'title' => "maintenance",
		'type' => "timeline-table",
		'sql' => "SELECT 
						`equipm_log`.`id`,
						`equipm_log`.`equipment_id`,
						`equipm_log`.`log_date`, 
						CONCAT(`employee`.`first_nm`, ' ', `employee`.`last_nm`) AS `employee_name`, 
						`equipm_log`.`status` 
					FROM 
						`equipm_log` 
					LEFT JOIN 
						`employee` ON `equipm_log`.`employee_id` = `employee`.`id` 
					WHERE 
						`equipm_log`.`equipment_id` = '" . (isset($data['equipment_id']) ? $data['equipment_id'] : "") . "'  
						AND `equipm_log`.`log_type` LIKE '%Maintenance%' 
					ORDER BY 
						`equipm_log`.`log_date` DESC;",
		'rows' => ['log_date', 'employee_name', 'status'],	
        'thead' => ['Date', 'Employee Name', 'Status'],
	],	
	'crop' =>[
		'display' => "style='display:none;'",
		'title' => "crop",
	],
	'crop_p' =>[
		'display' => " ",
		'title' => "pest control",
		'type' => "timeline-table",
		'sql' => "SELECT 
						id,
						crop_id,
						dt_applied, 
						treatment, 
						notes
					FROM 
						crop_log 
					WHERE 
						crop_id = '" . (isset($data['crop_id']) ? $data['crop_id'] : "") . "'  
						AND record_type LIKE '%pest control%' 
					ORDER BY 
						dt_applied DESC;",
		'rows' => ['dt_applied', 'treatment','notes'],
        'thead' => ['Date Applied', 'Treatment Type','Notes'],
	],
	'crop_f' =>[
		'display' => " ",
		'title' => "fertilization",
		'type' => "timeline-table",
		'sql' => "SELECT 
						id,
						crop_id,
						dt_applied, 
						fertilizer_type,
						notes
					FROM 
						crop_log 
					WHERE 
						crop_id = '" . (isset($data['crop_id']) ? $data['crop_id'] : "") . "'  
						AND record_type LIKE '%fertilization%' 
					ORDER BY 
						dt_applied DESC;",
		'rows' => ['dt_applied', 'fertilizer_type','notes'],
        'thead' => ['Date Applied', 'Fertilizer', 'Notes'],
	],
	'crop_h' =>[
		'display' => "style='display:none;'",
		'title' => "crop harvest",
	],
	
	'livestock' =>[
		'display' => "style='display:none;'",
		'title' => "livestock",
	],
	
	'livestock_v' =>[
		'display' => " ",
		'title' => "vaccination",
		'type' => "timeline-table",
		'sql' => "SELECT 
						id,
						livestock_id,
						record_dt, 
						vaccine_type, 
						notes
					FROM 
						livestock_log 
					WHERE 
						livestock_id = '" . (isset($data['livestock_id']) ? $data['livestock_id'] : "") . "'  
						AND record_type LIKE '%vac%' 
					ORDER BY 
						record_dt DESC;",
		'rows' => ['record_dt', 'vaccine_type','notes'],
        'thead' => ['Date', 'Vaccine','Notes'],
	],
	
	'livestock_f' =>[
		'display' => " ",
		'title' => "feed plan",
		'type' => "timeline-table",
		'sql' => "SELECT 
						id,
						livestock_id,
						feed_start_dt, 
						feed_type,
						CONCAT(feed_qty, 'kg') AS feed_qty,
						notes
					FROM 
						livestock_log 
					WHERE 
						livestock_id = '" . (isset($data['livestock_id']) ? $data['livestock_id'] : "") . "'  
						AND record_type LIKE '%feed%' 
					ORDER BY 
						feed_start_dt DESC;",
		'rows' => ['feed_start_dt', 'feed_type','feed_qty','notes'],
        'thead' => ['Date', 'Feed Type','Feed Quantity','Notes'],
	],	
	
	'attendance_t' =>[
		'display' => "style='display:none;'",
		'title' => "overtime request",
	],
	
	'attendance_l' =>[
		'display' => "style='display:none;'",
		'title' => "leave request",
	],	
	
	'employee' =>[
		'display' => "style='display:none;'",
		'title' => "employee",
		'type' => " ",
	],
	
	'employee_r' => [
		'display' => "",
		'type' => "emp-request",
		'title' => "employee request",
	],

	
	'finance_b' =>[
		'display' => "style='display:none;'",
		'title' => "budget entry",
	],	
		
	'finance_e' =>[
		'display' => "style='display:none;'",
		'title' => "expenses entry",
	],
		
	'finance_r' =>[
		'display' => "style='display:none;'",
		'title' => "revenue entry",
	],
		
	'finance_p' =>[
		'display' => "style='display:none;'",
		'title' => "profit entry",
	],
				
	'allocation_c' =>[
		'display' => "style='display:none;'",
		'title' => "crop allocation",
	],				
	'allocation_e' =>[
		'display' => "",
		'title' => "equipment allocation",
	],				
	'allocation_f' =>[
		'display' => "style='display:none;'",
		'title' => "fertilizer allocation",
	],				
	'allocation_l' =>[
		'display' => "style='display:none;'",
		'title' => "labor allocation",
	],				
	'allocation_b' =>[
		'display' => "style='display:none;'",
		'title' => "budget allocation",
	],	
	'purchases' =>[
		'display' => "style='display:none;'",
		'title' => "request purchase order",
	],	
	'distribution' =>[
		'display' => "style='display:none;'",
		'title' => "distribution transaction",
	],
	'user' =>[
		'display' => "style='display:none;'",
		'title' => "user account",
	],
];


// Populated: Fields
$fields = []; // Initialize the array
$query = "SELECT id, field_nm FROM field";
$result1 = $conn->query($query); // Assuming you have a database connection

while ($row = $result1->fetch_assoc()) {
    $fields[] = $row; // Add each row to the fields array
}

// Populated: Employees
$employees = []; 
$query = "SELECT id, CONCAT(first_nm, ' ', last_nm) AS full_name FROM employee";
$result2 = $conn->query($query); 

while ($row = $result2->fetch_assoc()) {
    $employees[] = $row; 
}



$equipment_list = []; 
$query = "SELECT `equipm`.`id`, `equipm`.`equipment_nm`, `equipm_log`.`status`
FROM `equipm` 
	LEFT JOIN `equipm_log` ON `equipm_log`.`equipment_id` = `equipm`.`id`
WHERE `equipm_log`.`status` LIKE '%Return%';"; 
$result = $conn->query($query); 

if ($result) { 
    while ($row = $result->fetch_assoc()) {
        $equipment_list[] = $row; 
    }
}


$equipment_list2 = []; 
$query2 = "SELECT `equipm`.`id`, `equipm`.`equipment_nm`, `equipm_log`.`status`
FROM `equipm` 
	LEFT JOIN `equipm_log` ON `equipm_log`.`equipment_id` = `equipm`.`id`
WHERE `equipm_log`.`status` LIKE '%Mainte%';"; 
$result2 = $conn->query($query2); 

if ($result2) { 
    while ($row = $result2->fetch_assoc()) {
        $equipment_list2[] = $row; 
    }
}

$equipment_list3 = []; 
$query3 = "SELECT `equipm`.`id`, `equipm`.`equipment_nm`, `equipm_log`.`status`
FROM `equipm` 
	LEFT JOIN `equipm_log` ON `equipm_log`.`equipment_id` = `equipm`.`id`;"; 
$result3 = $conn->query($query3); 

if ($result3) { 
    while ($row = $result3->fetch_assoc()) {
        $equipment_list3[] = $row; 
    }
}

$crop_list = []; // Ensure this is initialized as an empty array
$query = "SELECT id, crop_nm FROM `crop`"; // Adjust your query as needed
$result = $conn->query($query); // Execute the query

if ($result) { // Check if the query executed successfully
    while ($row = $result->fetch_assoc()) {
        $crop_list[] = $row; // Populate the equipment list
    }
}

$livestock_list = []; // Ensure this is initialized as an empty array
$query = "SELECT id, livestock_nm FROM `livestock`"; // Adjust your query as needed
$result = $conn->query($query); // Execute the query

if ($result) { // Check if the query executed successfully
    while ($row = $result->fetch_assoc()) {
        $livestock_list[] = $row; // Populate the equipment list
    }
}

$fertilizer_list = []; // Ensure this is initialized as an empty array
$query = "SELECT id, item_name FROM `items` WHERE category = 'Fertilizer'"; // Adjust your query as needed
$result = $conn->query($query); // Execute the query

if ($result) { // Check if the query executed successfully
    while ($row = $result->fetch_assoc()) {
        $fertilizer_list[] = $row; // Populate the equipment list
    }
}

// Turns values into form_fields.php which on loop
$form_fields = [
	'items' => [
		'category' => [
			'label' => 'Category',
			'type' => 'select',
			'options' => ['Supplies', 'Fertilizer', 'Tools and Equipment', 'Livestock'],
			'value' => $is_update && isset($data['category']) ? $data['category'] : '',
		],
		'item_name' => [
			'label' => 'Item Name',
			'type' => 'text',
			'value' => $is_update && isset($data['item_name']) ? htmlspecialchars($data['item_name']) : '',
		],
		'description' => [
			'label' => 'Description',
			'type' => 'textarea',
			'value' => $is_update && isset($data['description']) ? htmlspecialchars($data['description']) : '',
		],
		'unit' => [
			'label' => 'Unit',
			'type' => 'text',
			'value' => $is_update && isset($data['unit']) ? htmlspecialchars($data['unit']) : '',
		],
	],

	'field' => [
		'field_nm' => [
			'label' => 'Field Name',
			'type' => 'text',
			'value' => $is_update && isset($data['field_nm']) ? htmlspecialchars($data['field_nm']) : '',
		],
		'area' => [
			'label' => 'Area (sq meters)',
			'type' => 'number',
			'value' => $is_update && isset($data['area']) ? htmlspecialchars($data['area']) : '',
		],
		'soil_type' => [
			'label' => 'Soil Type',
			'type' => 'select',
			'options' => ['Loam', 'Clay', 'Sandy Loam', 'Loamy Sand', 'Silt'],
			'value' => $is_update && isset($data['soil_type']) ? $data['soil_type'] : '',
		],
		'irrigation' => [
			'label' => 'Irrigation Type',
			'type' => 'select',
			'options' => ['Sprinkler', 'Furrow', 'Deep Irrigation', 'Drip Irrigation'],
			'value' => $is_update && isset($data['irrigation']) ? $data['irrigation'] : '',
		],
		'geometry' => [
			'label' => '',
			'type' => 'hidden',
			'value' => $is_update && isset($data['geometry']) ? htmlspecialchars($data['geometry']) : '',
		],
	],
	
	'equipment' => [
		'equipment_nm' => [
			'label' => 'Equipment Name',
			'type' => 'text',
			'value' => $is_update && isset($data['equipment_nm']) ? htmlspecialchars($data['equipment_nm']) : '',
		],
		'model' => [
			'label' => 'Model',
			'type' => 'text',
			'value' => $is_update && isset($data['model']) ? htmlspecialchars($data['model']) : '',
		],
		'manufacturer' => [
			'label' => 'Manufacturer',
			'type' => 'text',
			'value' => $is_update && isset($data['manufacturer']) ? htmlspecialchars($data['manufacturer']) : '',
		],
		'purchase_dt' => [
			'label' => 'Purchase Date',
			'type' => 'date',
			'value' => $is_update && isset($data['purchase_dt']) ? htmlspecialchars($data['purchase_dt']) : '',
		],
		'warranty_end' => [
			'label' => 'Warranty End Date',
			'type' => 'date',
			'value' => $is_update && isset($data['warranty_end']) ? htmlspecialchars($data['warranty_end']) : '',
		],
		/*'field_id' => [
			'label' => 'Location',
			'type' => 'select',
			'options' => array_map(function($field) use ($data, $is_update) {
				return [
					'value' => $field['id'],
					'label' => htmlspecialchars($field['field_nm']),
					'selected' => ($is_update && isset($data['field_id']) && $data['field_id'] == $field['id']) ? true : false,
				];
			}, $fields),  // Assuming $fields is populated from the query
			'value' => $is_update && isset($data['field_id']) ? $data['field_id'] : '',
		],*/
	],
	
	'equipment_u' => [
		'equipment_id' => [
			'label' => 'Equipment',
			'type' => 'select',
			'options' => array_map(function($equipment) {
				return [
					'value' => $equipment['id'],
					'label' => htmlspecialchars($equipment['equipment_nm'])
				];
			}, $equipment_list3 ?: []), // Use empty array if $equipment_list is null
			'value' => $is_update && isset($data['equipment_id']) ? $data['equipment_id'] : '',
			'readonly' => true,
		],
		'log_date' => [
			'label' => 'Log Date',
			'type' => 'date',
			'value' => $is_update && isset($data['date_filed']) ? htmlspecialchars($data['date_filed']) : date('Y-m-d'), // Default to today's date
		],
		'status' => [
			'label' => 'Status',
			'type' => 'select',
			'options' => ['In Maintenance', 'Returned', 'In Use'],
			'value' => $is_update && isset($data['status']) ? $data['status'] : '',
			'limit' => 'yes'
		],
		/*'employee_id' => [
			'label' => 'Employee',
			'type' => 'select',
			'options' => array_map(function($employee) {
				return [
					'value' => $employee['id'],
					'label' => htmlspecialchars($employee['full_name'])
				];
			}, $employees),
			'value' => $is_update && isset($data['employee_id']) ? $data['employee_id'] : '',
		],*/
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],
	],
	
	'equipment_m' => [
		'equipment_id' => [
			'label' => 'Equipment',
			'type' => 'select',
			'options' => array_map(function($equipment) {
				return [
					'value' => $equipment['id'],
					'label' => htmlspecialchars($equipment['equipment_nm'])
				];
			}, $equipment_list3 ?: []), // Use empty array if $equipment_list is null
			'value' => $is_update && isset($data['equipment_id']) ? $data['equipment_id'] : '',
		],
		'log_date' => [
			'label' => 'Log Date',
			'type' => 'date',
			'value' => $is_update && isset($data['date_filed']) ? htmlspecialchars($data['date_filed']) : date('Y-m-d'), // Default to today's date
		],
		'status' => [
			'label' => 'Status',
			'type' => 'select',
			'options' => ['In Progress', 'Completed'],
			'value' => $is_update && isset($data['status']) ? $data['status'] : '',
		],
		'maint_type' => [
			'label' => 'Maintenance Type',
			'type' => 'text',
			'value' => $is_update && isset($data['maint_type']) ? htmlspecialchars($data['maint_type']) : '',
		],
		'maint_sched_dt' => [
			'label' => 'Maintenance Scheduled Date',
			'type' => 'date',
			'value' => $is_update && isset($data['maint_sched_dt']) ? htmlspecialchars($data['maint_sched_dt']) : '',
		],
		/*'employee_id' => [
			'label' => 'Employee',
			'type' => 'select',
			'options' => array_map(function($employee) {
				return [
					'value' => $employee['id'],
					'label' => htmlspecialchars($employee['full_name'])
				];
			}, $employees),
			'value' => $is_update && isset($data['employee_id']) ? $data['employee_id'] : '',
		],*/
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],
	],

	'crop' => [
		'crop_nm' => [
			'label' => 'Crop Name',
			'type' => 'text',
			'value' => $is_update && isset($data['crop_nm']) ? htmlspecialchars($data['crop_nm']) : '',
		],
		'est_yield' => [
			'label' => 'Estimated Yield',
			'type' => 'number',
			'value' => $is_update && isset($data['est_yield']) ? htmlspecialchars($data['est_yield']) : '',
		],
		'planting_dt' => [
			'label' => 'Planting Date',
			'type' => 'date',
			'value' => $is_update && isset($data['planting_dt']) ? htmlspecialchars($data['planting_dt']) : '',
		],
		'harvest_dt' => [
			'label' => 'Harvest Date',
			'type' => 'date',
			'value' => $is_update && isset($data['harvest_dt']) ? htmlspecialchars($data['harvest_dt']) : '',
		],
		'field_id' => [
			'label' => 'Location',
			'type' => 'select',
			'options' => array_map(function($field) use ($data, $is_update) {
				return [
					'value' => $field['id'],
					'label' => htmlspecialchars($field['field_nm']),
					'selected' => ($is_update && isset($data['field_id']) && $data['field_id'] == $field['id']) ? true : false,
				];
			}, $fields),  // Assuming $fields is populated from the query
			'value' => $is_update && isset($data['field_id']) ? $data['field_id'] : '',
		],
	],
	
	'crop_p' => [
		'crop_id' => [
			'label' => 'Crop',
			'type' => 'select',
			'options' => array_map(function($crop) use ($data, $is_update) {
				return [
					'value' => $crop['id'],
					'label' => htmlspecialchars($crop['crop_nm']),
					'selected' => ($is_update && isset($data['crop_id']) && $data['crop_id'] == $crop['id']) ? true : false,
				];
			},$crop_list ?: []),  // Assuming $crops is populated, use empty array if null
			'value' => $is_update && isset($data['crop_id']) ? $data['crop_id'] : '',
		],
		'dt_applied' => [
			'label' => 'Date Applied',
			'type' => 'date',
			'value' => $is_update && isset($data['dt_applied']) ? htmlspecialchars($data['dt_applied']) : '',
		],
		'treatment' => [
			'label' => 'Treatment',
			'type' => 'text',
			'value' => $is_update && isset($data['treatment']) ? htmlspecialchars($data['treatment']) : '',
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],
	],

	'crop_f' => [
		'crop_id' => [
			'label' => 'Crop',
			'type' => 'select',
			'options' => array_map(function($crop) use ($data, $is_update) {
				return [
					'value' => $crop['id'],
					'label' => htmlspecialchars($crop['crop_nm']),
					'selected' => ($is_update && isset($data['crop_id']) && $data['crop_id'] == $crop['id']) ? true : false,
				];
			},$crop_list ?: []),  // Assuming $crops is populated, use empty array if null
			'value' => $is_update && isset($data['crop_id']) ? $data['crop_id'] : '',
		],
		'dt_applied' => [
			'label' => 'Date Applied',
			'type' => 'date',
			'value' => $is_update && isset($data['dt_applied']) ? htmlspecialchars($data['dt_applied']) : '',
		],
		'fertilizer_type' => [
			'label' => 'Fertilizer Type',
			'type' => 'text',
			'value' => $is_update && isset($data['fertilizer_type']) ? htmlspecialchars($data['fertilizer_type']) : '',
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],
	],
	
	'crop_h' => [
		'crop_id' => [
			'label' => 'Crop',
			'type' => 'select',
			'options' => array_map(function($crop) use ($data, $is_update) {
				return [
					'value' => $crop['id'],
					'label' => htmlspecialchars($crop['crop_nm']),
					'selected' => ($is_update && isset($data['crop_id']) && $data['crop_id'] == $crop['id']) ? true : false,
				];
			},$crop_list ?: []),  // Assuming $crops is populated, use empty array if null
			'value' => $is_update && isset($data['crop_id']) ? $data['crop_id'] : '',
		],
		'harvest_oc' => [
			'label' => 'Outcome',
			'type' => 'select',
			'options' => ['Pending', 'Harvested', 'Failed'],
			'value' => $is_update && isset($data['harvest_oc']) ? $data['harvest_oc'] : 'Pending',
		],
		'harvest_dt_act' => [
			'label' => 'Actual Harvest Date',
			'type' => 'date',
			'value' => $is_update && isset($data['harvest_dt_act']) ? htmlspecialchars($data['harvest_dt_act']) : '',
		],
		'act_yield' => [
			'label' => 'Actual Yield',
			'type' => 'number',
			'value' => $is_update && isset($data['act_yield']) ? htmlspecialchars($data['act_yield']) : '',
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],
	],
	
	'livestock' => [
		'livestock_nm' => [
			'label' => 'Livestock Name',
			'type' => 'text',
			'value' => $is_update && isset($data['livestock_nm']) ? htmlspecialchars($data['livestock_nm']) : '',
		],
		'livestock_type' => [
			'label' => 'Livestock Type',
			'type' => 'select',
			'options' => [
				['value' => 'Goat', 'label' => 'Goat', 'selected' => ($is_update && isset($data['livestock_type']) && $data['livestock_type'] == 'Goat')],
				['value' => 'Cow', 'label' => 'Cow', 'selected' => ($is_update && isset($data['livestock_type']) && $data['livestock_type'] == 'Cow')],
				['value' => 'Chicken', 'label' => 'Chicken', 'selected' => ($is_update && isset($data['livestock_type']) && $data['livestock_type'] == 'Chicken')],
				['value' => 'Pig', 'label' => 'Pig', 'selected' => ($is_update && isset($data['livestock_type']) && $data['livestock_type'] == 'Pig')],
				['value' => 'Sheep', 'label' => 'Sheep', 'selected' => ($is_update && isset($data['livestock_type']) && $data['livestock_type'] == 'Sheep')],
			],
			'value' => $is_update && isset($data['livestock_type']) ? $data['livestock_type'] : '',
		],
		'quantity' => [
			'label' => 'Quantity',
			'type' => 'number',
			'value' => $is_update && isset($data['quantity']) ? htmlspecialchars($data['quantity']) : '',
		],
		'birthdate' => [
			'label' => 'Birthdate',
			'type' => 'date',
			'value' => $is_update && isset($data['birthdate']) ? htmlspecialchars($data['birthdate']) : '',
		],
	],

	'livestock_v' => [
		'livestock_id' => [
			'label' => 'Livestock Name with Batch-Code',
			'type' => 'select',
			'options' => array_map(function($livestock) use ($data, $is_update) {
				return [
					'value' => $livestock['id'],
					'label' => htmlspecialchars($livestock['livestock_nm']),
					'selected' => ($is_update && isset($data['livestock_id']) && $data['livestock_id'] == $livestock['id']) ? true : false,
				];
			},$livestock_list ?: []),  // Assuming $crops is populated, use empty array if null
			'value' => $is_update && isset($data['livestock_id']) ? $data['livestock_id'] : '',
		],		
		'record_dt' => [
			'label' => 'Vaccine Date',
			'type' => 'date',
			'value' => $is_update && isset($data['record_dt']) ? htmlspecialchars($data['record_dt']) : '',
		],
		'vaccine_type' => [
			'label' => 'Vaccine Type',
			'type' => 'text',
			'value' => $is_update && isset($data['vaccine_type']) ? htmlspecialchars($data['vaccine_type']) : '',
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],
		],
	
	
	'livestock_f' => [
		'livestock_id' => [
			'label' => 'Livestock Name with Batch-Code',
			'type' => 'select',
			'options' => array_map(function($livestock) use ($data, $is_update) {
				return [
					'value' => $livestock['id'],
					'label' => htmlspecialchars($livestock['livestock_nm']),
					'selected' => ($is_update && isset($data['livestock_id']) && $data['livestock_id'] == $livestock['id']) ? true : false,
				];
			},$livestock_list ?: []),  // Assuming $crops is populated, use empty array if null
			'value' => $is_update && isset($data['livestock_id']) ? $data['livestock_id'] : '',
		],		
		'feed_start_dt' => [
			'label' => 'Start Date',
			'type' => 'date',
			'value' => $is_update && isset($data['feed_start_dt']) ? htmlspecialchars($data['feed_start_dt']) : '',
		],
		'feed_end_dt' => [
			'label' => 'End Date',
			'type' => 'date',
			'value' => $is_update && isset($data['feed_end_dt']) ? htmlspecialchars($data['feed_end_dt']) : '',
		],
		'feed_type' => [
			'label' => 'Feed Type',
			'type' => 'text',
			'value' => $is_update && isset($data['feed_type']) ? htmlspecialchars($data['feed_type']) : '',
		],
		'feed_qty' => [
			'label' => 'Feed Qty',
			'type' => 'number',
			'value' => $is_update && isset($data['feed_qty']) ? htmlspecialchars($data['feed_qty']) : '',
		],		
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],
	],
	
	'attendance_t' => [ //request for OT
		'file_ticket' => [
			'label' => 'File Ticket',
			'type' => 'text',
			'value' => isset($_GET['file_ticket']) ? htmlspecialchars($_GET['file_ticket']) : '',
			'readonly' => true,
		],
		'date_filed' => [
			'label' => 'Date Filed',
			'type' => 'date',
			'value' => $is_update && isset($data['date_filed']) ? htmlspecialchars($data['date_filed']) : date('Y-m-d'),
		],
		'reason' => [
			'label' => 'Reason',
			'type' => 'textarea',
			'value' => $is_update && isset($data['reason']) ? htmlspecialchars($data['reason']) : '',
		],
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],		
	],	

	'attendance_l' => [ //request for Leave $_SESSION['user_id']
		'date_filed' => [
			'label' => 'Date Filed',
			'type' => 'date',
			'value' => $is_update && isset($data['date_filed']) ? htmlspecialchars($data['date_filed']) : date('Y-m-d'),
		],
		'leave_type' => [
			'label' => 'Leave Type',
			'type' => 'text',
			'value' => $is_update && isset($data['leave_type']) ? htmlspecialchars($data['leave_type']) : '',
		],
		'start_dt' => [
			'label' => 'Start Date',
			'type' => 'date',
			'value' => $is_update && isset($data['start_dt']) ? htmlspecialchars($data['start_dt']) : '',
		],
		'end_dt' => [
			'label' => 'End Date',
			'type' => 'date',
			'value' => $is_update && isset($data['end_dt']) ? htmlspecialchars($data['end_dt']) : '',
		],
		'reason' => [
			'label' => 'Reason',
			'type' => 'textarea',
			'value' => $is_update && isset($data['reason']) ? htmlspecialchars($data['reason']) : '',
		],
		'employee_id' => [
			'label' => '',
			'type' => 'hidden',
			'value' => isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ($is_update && isset($data['employee_id']) ? $data['employee_id'] : ''),
		],		
	],	

	
	
	'employee' => [
		'first_nm' => [
			'label' => 'First Name',
			'type' => 'text',
			'value' => $is_update && isset($data['first_nm']) ? htmlspecialchars($data['first_nm']) : '',
		],
		'last_nm' => [
			'label' => 'Last Name',
			'type' => 'text',
			'value' => $is_update && isset($data['last_nm']) ? htmlspecialchars($data['last_nm']) : '',
		],
		'birthdate' => [
			'label' => 'Birthdate',
			'type' => 'date',
			'value' => $is_update && isset($data['birthdate']) ? htmlspecialchars($data['birthdate']) : '',
		],
		'address' => [
			'label' => 'Address',
			'type' => 'textarea',
			'value' => $is_update && isset($data['address']) ? htmlspecialchars($data['address']) : '',
		],
		'phone_num' => [
			'label' => 'Phone Number',
			'type' => 'text',
			'value' => $is_update && isset($data['phone_num']) ? htmlspecialchars($data['phone_num']) : '',
		],
		'email' => [
			'label' => 'Email',
			'type' => 'email',
			'value' => $is_update && isset($data['email']) ? htmlspecialchars($data['email']) : '',
		],
		'emerg_name' => [
			'label' => 'Emergency Contact Name',
			'type' => 'text',
			'value' => $is_update && isset($data['emerg_name']) ? htmlspecialchars($data['emerg_name']) : '',
		],
		'emerg_num' => [
			'label' => 'Emergency Contact Number',
			'type' => 'text',
			'value' => $is_update && isset($data['emerg_num']) ? htmlspecialchars($data['emerg_num']) : '',
		],
		'position' => [
			'label' => 'Position',
			'type' => 'text',
			'value' => $is_update && isset($data['position']) ? htmlspecialchars($data['position']) : '',
		],
		'department' => [
			'label' => 'Department',
			'type' => 'text',
			'value' => $is_update && isset($data['department']) ? htmlspecialchars($data['department']) : '',
		],
		'employee_dt' => [
			'label' => 'Employee Date',
			'type' => 'date',
			'value' => $is_update && isset($data['employee_dt']) ? htmlspecialchars($data['employee_dt']) : '',
		],
		'num_ss' => [
			'label' => 'Social Security Number',
			'type' => 'text',
			'value' => $is_update && isset($data['num_ss']) ? htmlspecialchars($data['num_ss']) : '',
		],
		'num_pagibig' => [
			'label' => 'Pag-IBIG Number',
			'type' => 'text',
			'value' => $is_update && isset($data['num_pagibig']) ? htmlspecialchars($data['num_pagibig']) : '',
		],
		'num_philhealth' => [
			'label' => 'PhilHealth Number',
			'type' => 'text',
			'value' => $is_update && isset($data['num_philhealth']) ? htmlspecialchars($data['num_philhealth']) : '',
		],
		'num_tin' => [
			'label' => 'Tax Identification Number',
			'type' => 'text',
			'value' => $is_update && isset($data['num_tin']) ? htmlspecialchars($data['num_tin']) : '',
		],
		'wage_daily' => [
			'label' => 'Daily Wage',
			'type' => 'number',
			'value' => $is_update && isset($data['wage_daily']) ? htmlspecialchars($data['wage_daily']) : '',
			'attributes' => ['step' => '0.01'], // Adding attributes for decimal values
		],
		'user_lvl' => [
			'label' => 'User Level',
			'type' => 'select',
			'options' => [
				['value' => 'Admin', 'label' => 'Admin', 'selected' => ($is_update && isset($data['user_lvl']) && $data['user_lvl'] == 'Admin')],
				['value' => 'Employee', 'label' => 'Employee', 'selected' => ($is_update && isset($data['user_lvl']) && $data['user_lvl'] == 'Employee')],
			],
			'value' => $is_update && isset($data['user_lvl']) ? $data['user_lvl'] : '',
		],
		'username' => [
			'label' => 'Default Username',
			'type' => 'text',
			'readonly' => true,			
			'value' => $is_update && isset($data['username']) ? htmlspecialchars($data['username']) : '',
		],
		'password' => [
			'label' => 'Default Password',
			'type' => 'password',		
			'value' => $is_update && isset($data['password']) ? htmlspecialchars($data['password']) : '',
		],	
	],	
	
	'user' => [
		'first_nm' => [
			'label' => 'First Name',
			'type' => 'text',
			'readonly' => true,
			'value' => $is_update && isset($data['first_nm']) ? htmlspecialchars($data['first_nm']) : '',
		],
		'last_nm' => [
			'label' => 'Last Name',
			'type' => 'text',
			'readonly' => true,
			'value' => $is_update && isset($data['last_nm']) ? htmlspecialchars($data['last_nm']) : '',
		],
		'email' => [
			'label' => 'Email',
			'type' => 'email',
			'value' => $is_update && isset($data['email']) ? htmlspecialchars($data['email']) : '',
		],
		'user_lvl' => [
			'label' => 'User Level',
			'type' => 'select',
			'options' => [
				['value' => 'Admin', 'label' => 'Admin', 'selected' => ($is_update && isset($data['user_lvl']) && $data['user_lvl'] == 'Admin')],
				['value' => 'Employee', 'label' => 'Employee', 'selected' => ($is_update && isset($data['user_lvl']) && $data['user_lvl'] == 'Employee')],
			],
			'value' => $is_update && isset($data['user_lvl']) ? $data['user_lvl'] : '',
		],
		'username' => [
			'label' => 'Default Username',
			'type' => 'text',
			'readonly' => true,			
			'value' => $is_update && isset($data['username']) ? htmlspecialchars($data['username']) : '',
		],
		'password' => [
			'label' => 'Default Password',
			'type' => 'text',		
			'value' => $is_update && isset($data['password']) ? htmlspecialchars($data['password']) : '',
		],	
	],
	
	
	'employee_r' => [ //request for OT
/*		'file_ticket' => [
			'label' => 'File Ticket',
			'type' => 'text',
			'value' => $is_update && isset($data['file_ticket']) ? htmlspecialchars($data['file_ticket']) : '',
			'readonly' => true,
		],
		'employee_id' => [
			'label' => 'Employee',
			'type' => 'select',
			'options' => array_map(function($employee) use ($is_update, $data) {
				return [
					'value' => $employee['id'],
					'label' => htmlspecialchars($employee['full_name']),
					'selected' => ($is_update && isset($data['employee_id']) && $data['employee_id'] == $employee['id']) ? 'selected' : ''
				];
			}, $employees),
			'value' => $is_update && isset($data['employee_id']) ? $data['employee_id'] : '',
		],
		'record_type' => [
			'label' => 'Record Type',
			'type' => 'text',
			'value' => $is_update && isset($data['record_type']) ? htmlspecialchars($data['record_type']) : '',
			'readonly' => true,
		],		
		'date_filed' => [
			'label' => 'Date Filed',
			'type' => 'date',
			'value' => $is_update && isset($data['date_filed']) ? htmlspecialchars($data['date_filed']) : date('Y-m-d'), // Default to today's date
		],
		'leave_type' => [
			'label' => 'Leave Type',
			'type' => 'text',
			'value' => $is_update && isset($data['leave_type']) ? htmlspecialchars($data['leave_type']) : '',
		],
		'start_dt' => [
			'label' => 'Start Date',
			'type' => 'date',
			'value' => $is_update && isset($data['start_dt']) ? htmlspecialchars($data['start_dt']) : '',
		],
		'end_dt' => [
			'label' => 'End Date',
			'type' => 'date',
			'value' => $is_update && isset($data['end_dt']) ? htmlspecialchars($data['end_dt']) : '',
		],
		'reason' => [
			'label' => 'Reason',
			'type' => 'textarea',
			'value' => $is_update && isset($data['reason']) ? htmlspecialchars($data['reason']) : '',
		],*/
		'status' => [
			'label' => 'Status',
			'type' => 'select',
			'options' => ['Approved', 'Denied', 'Pending'],
			'value' => $is_update && isset($data['status']) ? $data['status'] : '',
		],	
		'remarks' => [
			'label' => 'Remarks',
			'type' => 'textarea',
			'value' => 	$is_update && isset($data['remarks']) ? htmlspecialchars($data['remarks']) : '',
		],
	],	
	
	
	'finance_b' => [
		'year' => [
			'label' => 'Year',
			'type' => 'number',
			'value' => $is_update && isset($data['year']) ? htmlspecialchars($data['year']) : '',
			'attributes' => ['min' => '1900', 'max' => date('Y')], // Restrict to a valid range of years
		],
		'department' => [
			'label' => 'Department',
			'type' => 'text',
			'value' => $is_update && isset($data['department']) ? htmlspecialchars($data['department']) : '',
		],
		'expenses_cat' => [
			'label' => 'Expense Category',
			'type' => 'text',
			'value' => $is_update && isset($data['expenses_cat']) ? htmlspecialchars($data['expenses_cat']) : '',
		],
		'amount' => [
			'label' => 'Amount',
			'type' => 'number',
			'value' => $is_update && isset($data['amount']) ? htmlspecialchars($data['amount']) : '',
			'attributes' => ['step' => '0.01'], // Allow decimal amounts
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'attachment' => [
			'label' => 'Attachment',
			'type' => 'file', // For file uploads
			'value' => '', // File fields generally do not pre-populate
		],
	],
	
	'finance_e' => [
		'date' => [
			'label' => 'Date',
			'type' => 'date',
			'value' => $is_update && isset($data['date']) ? htmlspecialchars($data['date']) : '',
		],
		'department' => [
			'label' => 'Department',
			'type' => 'text',
			'value' => $is_update && isset($data['department']) ? htmlspecialchars($data['department']) : '',
		],
		'expenses_cat' => [
			'label' => 'Expense Category',
			'type' => 'text',
			'value' => $is_update && isset($data['expenses_cat']) ? htmlspecialchars($data['expenses_cat']) : '',
		],
		'amount' => [
			'label' => 'Amount',
			'type' => 'number',
			'value' => $is_update && isset($data['amount']) ? htmlspecialchars($data['amount']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal input
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'attachment' => [
			'label' => 'Attachment',
			'type' => 'file', // File upload field
			'value' => '', // File fields typically don't have a pre-populated value
		],
	],
	
	'finance_r' => [
		'date' => [
			'label' => 'Date',
			'type' => 'date',
			'value' => $is_update && isset($data['date']) ? htmlspecialchars($data['date']) : '',
		],
		'source' => [
			'label' => 'Source',
			'type' => 'text',
			'value' => $is_update && isset($data['source']) ? htmlspecialchars($data['source']) : '',
		],
		'revenue_cat' => [
			'label' => 'Revenue Category',
			'type' => 'text',
			'value' => $is_update && isset($data['revenue_cat']) ? htmlspecialchars($data['revenue_cat']) : '',
		],
		'amount' => [
			'label' => 'Amount',
			'type' => 'number',
			'value' => $is_update && isset($data['amount']) ? htmlspecialchars($data['amount']) : '',
			'attributes' => ['step' => '0.01'], // Allow decimal amounts
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'attachment' => [
			'label' => 'Attachment',
			'type' => 'file', // File upload field
			'value' => '', // No pre-populated value for file uploads
		],
	],
	
	'finance_p' => [
		'year' => [
			'label' => 'Year',
			'type' => 'number',
			'value' => $is_update && isset($data['year']) ? htmlspecialchars($data['year']) : '',
			'attributes' => ['min' => '1900', 'max' => date('Y')], // Restrict to valid year range
		],
		'department' => [
			'label' => 'Department',
			'type' => 'text',
			'value' => $is_update && isset($data['department']) ? htmlspecialchars($data['department']) : '',
		],
		'amount' => [
			'label' => 'Amount',
			'type' => 'number',
			'value' => $is_update && isset($data['amount']) ? htmlspecialchars($data['amount']) : '',
			'attributes' => ['step' => '0.01'], // Allow decimal input
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'textarea',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'attachment' => [
			'label' => 'Attachment',
			'type' => 'file', // For file uploads
			'value' => '', // No pre-populated value for file fields
		],
	],
	
	'allocation_c' => [
		'crop_id' => [
			'label' => 'Crop',
			'type' => 'select',
			'options' => array_map(function($crop) use ($data, $is_update) {
				return [
					'value' => $crop['id'],
					'label' => htmlspecialchars($crop['crop_nm']),
					'selected' => ($is_update && isset($data['crop_id']) && $data['crop_id'] == $crop['id']) ? true : false,
				];
			},$crop_list ?: []),  // Assuming $crops is populated, use empty array if null
			'value' => $is_update && isset($data['crop_id']) ? $data['crop_id'] : '',
		],
		'allocation_land' => [
			'label' => 'Land Allocation',
			'type' => 'number',
			'value' => $is_update && isset($data['allocation_land']) ? htmlspecialchars($data['allocation_land']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal input
		],
		'allocation_water' => [
			'label' => 'Water Allocation',
			'type' => 'number',
			'value' => $is_update && isset($data['allocation_water']) ? htmlspecialchars($data['allocation_water']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal input
		],
		'allocation_ferti' => [
			'label' => 'Fertilizer Allocation',
			'type' => 'number',
			'value' => $is_update && isset($data['allocation_ferti']) ? htmlspecialchars($data['allocation_ferti']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal input
		],
		'start_date' => [
			'label' => 'Start Date',
			'type' => 'date',
			'value' => $is_update && isset($data['start_date']) ? htmlspecialchars($data['start_date']) : '',
		],
		'end_date' => [
			'label' => 'End Date',
			'type' => 'date',
			'value' => $is_update && isset($data['end_date']) ? htmlspecialchars($data['end_date']) : '',
		],
	],
	
	'allocation_e' => [
		'equipment_id' => [
			'label' => 'Equipment',
			'type' => 'select',
			'options' => array_map(function($equipment) {
				return [
					'value' => $equipment['id'],
					'label' => htmlspecialchars($equipment['equipment_nm'])
				];
			}, $equipment_list ?: []), // Use empty array if $equipment_list is null
			'value' => $is_update && isset($data['equipment_id']) ? $data['equipment_id'] : '',
		],
		'model' => [
			'label' => 'Equipment Model',
			'type' => 'text',
			'value' => $is_update && isset($data['model']) ? htmlspecialchars($data['model']) : '',
		],
		'field_nm' => [
			'label' => 'Field Name',
			'type' => 'text',
			'value' => $is_update && isset($data['field_nm']) ? htmlspecialchars($data['field_nm']) : '',
		],
	],
	
	'allocation_f' => [
		'item_id' => [
			'label' => 'Item',
			'type' => 'select',
			'options' => array_map(function($ferti) use ($data, $is_update) {
				return [
					'value' => $ferti['id'],
					'label' => htmlspecialchars($ferti['item_name']),
					'selected' => ($is_update && isset($data['item_id']) && $data['item_id'] == $ferti['id']) ? true : false,
				];
			},$fertilizer_list ?: []),  // Assuming $crops is populated, use empty array if null
			'value' => $is_update && isset($data['item_id']) ? $data['item_id'] : '',
		],
		'quantity' => [
			'label' => 'Total Quantity',
			'type' => 'number',
			'value' => $is_update && isset($data['quantity']) ? htmlspecialchars($data['quantity']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal values if needed
		],
		'allocation_qty' => [
			'label' => 'Allocated Quantity',
			'type' => 'number',
			'value' => $is_update && isset($data['allocation_qty']) ? htmlspecialchars($data['allocation_qty']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal values if needed
		],
		'percentage' => [
			'label' => 'Percentage',
			'type' => 'number',
			'value' => $is_update && isset($data['percentage']) ? htmlspecialchars($data['percentage']) : '',
			'attributes' => ['step' => '0.01', 'min' => '0', 'max' => '100'], // Percentage input
		],
		'allocation_date' => [
			'label' => 'Allocation Date',
			'type' => 'date',
			'value' => $is_update && isset($data['allocation_date']) ? htmlspecialchars($data['allocation_date']) : '',
		],
	],
	
	'allocation_l' => [
		'employee_id' => [
			'label' => 'Employee',
			'type' => 'select',
			'options' => array_map(function($employee) use ($is_update, $data) {
				return [
					'value' => $employee['id'],
					'label' => htmlspecialchars($employee['full_name']),
					'selected' => ($is_update && isset($data['employee_id']) && $data['employee_id'] == $employee['id']) ? 'selected' : ''
				];
			}, $employees),
			'value' => $is_update && isset($data['employee_id']) ? $data['employee_id'] : '',
		],
		'allocation_task' => [
			'label' => 'Allocation Task',
			'type' => 'text',
			'value' => $is_update && isset($data['allocation_task']) ? htmlspecialchars($data['allocation_task']) : '',
		],
		'work_hrs' => [
			'label' => 'Work Hours',
			'type' => 'number',
			'value' => $is_update && isset($data['work_hrs']) ? htmlspecialchars($data['work_hrs']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal values if needed
		],
		'prod_rate' => [
			'label' => 'Production Rate',
			'type' => 'number',
			'value' => $is_update && isset($data['prod_rate']) ? htmlspecialchars($data['prod_rate']) : '',
			'attributes' => ['step' => '0.01'], // To allow decimal values if needed
		],
	],
	
	'allocation_b' => [
		'expenses_cat' => [
			'label' => 'Expense Category',
			'type' => 'text',
			'value' => $is_update && isset($data['expenses_cat']) ? htmlspecialchars($data['expenses_cat']) : '',
		],
		'amnt_budgeted' => [
			'label' => 'Amount Budgeted',
			'type' => 'number',
			'value' => $is_update && isset($data['amnt_budgeted']) ? htmlspecialchars($data['amnt_budgeted']) : '',
			'attributes' => ['step' => '0.01'], // Allowing decimal input
		],
		'amnt_actual' => [
			'label' => 'Actual Amount',
			'type' => 'number',
			'value' => $is_update && isset($data['amnt_actual']) ? htmlspecialchars($data['amnt_actual']) : '',
			'attributes' => ['step' => '0.01'], // Allowing decimal input
		],
		'amnt_remaining' => [
			'label' => 'Remaining Amount',
			'type' => 'number',
			// Auto-compute based on budgeted and actual amounts
			'value' => $is_update && isset($data['amnt_budgeted'], $data['amnt_actual']) 
				? htmlspecialchars($data['amnt_budgeted'] - $data['amnt_actual']) 
				: '',
			'attributes' => ['step' => '0.01'], // Allowing decimal input
		],
	],
	
	
	'purchases' => [
		'date_filed' => [
			'label' => 'Date Filed',
			'type' => 'date',
			'value' => $is_update && isset($data['date_filed']) ? htmlspecialchars($data['date_filed']) : '',
			'attributes' => ['readonly' => true], // Date is auto-generated
		],
		'employee_id' => [
			'label' => 'Employee',
			'type' => 'select',
			'options' => array_map(function($employee) use ($is_update, $data) {
				return [
					'value' => $employee['id'],
					'label' => htmlspecialchars($employee['full_name']),
					'selected' => ($is_update && isset($data['employee_id']) && $data['employee_id'] == $employee['id']) ? 'selected' : ''
				];
			}, $employees),
			'value' => $is_update && isset($data['employee_id']) ? $data['employee_id'] : '',
		],
		'product_nm' => [
			'label' => 'Product Name',
			'type' => 'text',
			'value' => $is_update && isset($data['product_nm']) ? htmlspecialchars($data['product_nm']) : '',
		],
		'quantity' => [
			'label' => 'Quantity',
			'type' => 'number',
			'value' => $is_update && isset($data['quantity']) ? htmlspecialchars($data['quantity']) : '',
		],
		'unit' => [
			'label' => 'Unit',
			'type' => 'text',
			'value' => $is_update && isset($data['unit']) ? htmlspecialchars($data['unit']) : '',
		],
		'notes' => [
			'label' => 'Notes',
			'type' => 'text',
			'value' => $is_update && isset($data['notes']) ? htmlspecialchars($data['notes']) : '',
		],
		'status' => [
			'label' => 'Status',
			'type' => 'select',
			'options' => [
				['value' => 'Pending', 'label' => 'Pending', 'selected' => ($is_update && isset($data['status']) && $data['status'] == 'Pending')],
				['value' => 'Denied', 'label' => 'Denied', 'selected' => ($is_update && isset($data['status']) && $data['status'] == 'Denied')],
				['value' => 'Approved', 'label' => 'Approved', 'selected' => ($is_update && isset($data['status']) && $data['status'] == 'Approved')],
			],
			'value' => $is_update && isset($data['status']) ? $data['status'] : '',
		],
		'remarks' => [
			'label' => 'Remarks',
			'type' => 'text',
			'value' => $is_update && isset($data['remarks']) ? htmlspecialchars($data['remarks']) : '',
		],
	],

	'distribution' => [
		'date' => [
			'label' => 'Date',
			'type' => 'date',
			'value' => $is_update && isset($data['date']) ? htmlspecialchars($data['date']) : '',
			'attributes' => ['readonly' => true], // Date is auto-generated
		],
		'employee_id' => [
			'label' => 'Employee',
			'type' => 'select',
			'options' => array_map(function($employee) use ($is_update, $data) {
				return [
					'value' => $employee['id'],
					'label' => htmlspecialchars($employee['full_name']),
					'selected' => ($is_update && isset($data['employee_id']) && $data['employee_id'] == $employee['id']) ? 'selected' : ''
				];
			}, $employees),
			'value' => $is_update && isset($data['employee_id']) ? $data['employee_id'] : '',
		],
		'product_nm' => [
			'label' => 'Product Name',
			'type' => 'text',
			'value' => $is_update && isset($data['product_nm']) ? htmlspecialchars($data['product_nm']) : '',
		],
		'quantity' => [
			'label' => 'Quantity',
			'type' => 'number',
			'value' => $is_update && isset($data['quantity']) ? htmlspecialchars($data['quantity']) : '',
		],
		'unit' => [
			'label' => 'Unit',
			'type' => 'text',
			'value' => $is_update && isset($data['unit']) ? htmlspecialchars($data['unit']) : '',
		],
		'unit_prc' => [
			'label' => 'Unit Price',
			'type' => 'number',
			'attributes' => ['step' => '0.01'],
			'value' => $is_update && isset($data['unit_prc']) ? htmlspecialchars($data['unit_prc']) : '',
		],
		'total_prc' => [
			'label' => 'Total Price',
			'type' => 'number',
			'value' => $is_update && isset($data['quantity'], $data['unit_prc']) 
				? htmlspecialchars($data['quantity'] * $data['unit_prc']) 
				: '',
			'attributes' => [
				'step' => '0.01',  // Allow decimals
				'readonly' => true, // Readonly because it's auto-computed
				'id' => 'total_prc', // Add an ID for JS targeting
			],
		],
		'destination' => [
			'label' => 'Destination',
			'type' => 'text',
			'value' => $is_update && isset($data['destination']) ? htmlspecialchars($data['destination']) : '',
		],
		'status' => [
			'label' => 'Status',
			'type' => 'select',
			'options' => [
				['value' => 'Pending', 'label' => 'Pending', 'selected' => ($is_update && isset($data['status']) && $data['status'] == 'Pending')],
				['value' => 'Shipped', 'label' => 'Shipped', 'selected' => ($is_update && isset($data['status']) && $data['status'] == 'Shipped')],
				['value' => 'Delivered', 'label' => 'Delivered', 'selected' => ($is_update && isset($data['status']) && $data['status'] == 'Delivered')],
				['value' => 'Cancelled', 'label' => 'Cancelled', 'selected' => ($is_update && isset($data['status']) && $data['status'] == 'Cancelled')],
			],
			'value' => $is_update && isset($data['status']) ? $data['status'] : '',
		],
		'remarks' => [
			'label' => 'Remarks',
			'type' => 'text',
			'value' => $is_update && isset($data['remarks']) ? htmlspecialchars($data['remarks']) : '',
		],
	],



];	


	
?>


