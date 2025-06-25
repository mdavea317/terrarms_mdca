<?php


$empID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;
$today = date('Y-m-d');



$read_qry = [
    'items' => [
		'view' => "table",
        'thead' => ['Item Name', 'Category', 'Unit'],
		'row_s' => ['item_name','description', 'category', 'unit'],
		'act_e' => ['view'],
		'act_a' => ['view', 'update', 'delete'],
		'quick_ct' => "category",
		'status' => ['Supplies', 'Tools and Equipment', 'Fertilizer', 'Livestock'],		
	],
    
    'field' => [
		'view' => "table",
        'thead' => ['Field Name', 'Area (sqm)', 'Soil Type', 'Irrigation'],
		'row_s' => ['field_nm', '', 'soil_type', 'area', 'irrigation'],
		'act_e' => ['view'],
		'act_a' => ['view', 'update', 'delete'],
		'quick_ct' => "",
    ],

    'equipment' => [
		'view' => "table",
        'thead' => ['Equipment Name', 'Manufacturer', 'Purchase Date', 'Warranty End'],
		'row_s' => ['equipment_nm', 'model', 'manufacturer','purchase_dt','warranty_end',],
		'act_e' => ['view'],
		'act_a' => ['view', 'update', 'delete'],
		/*'join' => "LEFT JOIN `field` ON `equipm`.`field_id` = `field`.`id`",*/
		'quick_ct' => "",
    ],

    'equipment_u' => [
		'view' => "table",
        'thead' => ['Equipment Name', 'Status', 'Log Date', 'Employee'],
		'row_s' => ['equipment_nm', 'model', 'status','log_date2','employee_name'],
		'act_e' => ['update'],
		'act_a' => ['update'],
		'quick_ct' => "status",
		'concat' => ['MAX(log_date) AS log_date2',
					 'CONCAT(employee.first_nm, " ", employee.last_nm) AS employee_name'], 
		'join' => "RIGHT JOIN `equipm` ON `equipm`.`id` = `equipm_log`.`equipment_id`
				   LEFT JOIN `employee` ON `employee`.`id` = `equipm_log`.`employee_id`",
		'group' => "GROUP BY equipment_id",
		'order' => "ORDER BY equipment_id ASC", // Where condition from the original query
		'where' => "WHERE `equipm_log`.`status` NOT IN ('Pending', 'In Progress', 'Completed')",
		'status' => ['Returned', 'In Use', 'In Maintenance'],
    ],

    'equipment_m' => [
		'view' => "table",
        'thead' => ['Equipment Name', 'Status', 'Maintenance Type', 'Schedule Date', 'Log Date', 'Employee'],
		'row_s' => ['equipment_nm', 'model', 'status', 'maint_type', 'maint_sched_dt', 'log_date', 'employee_name'],
		'act_e' => ['update'],
		'act_a' => ['update'],
		'quick_ct' => "status",
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS employee_name'], 
		'join' => "RIGHT JOIN `equipm` ON `equipm`.`id` = `equipm_log`.`equipment_id`
				   RIGHT JOIN `employee` ON `employee`.`id` = `equipm_log`.`employee_id`",
		'where' => "WHERE `equipm_log`.`log_type` LIKE '%Maintenance%'",
		'status' => ['Pending', 'In Progress', 'Completed'],
    ],

    'crop' => [
		'view' => "table",
        'thead' => ['Crop Name', 'Estimated Yield (kg)', 'Planting Date', 'Est. Harvest Date'],
		'row_s' => ['crop_nm', '', 'est_yield', 'planting_dt', 'harvest_dt'],
		'act_e'   => ['view'],
		'act_a'   => ['view', 'update', 'delete'],
		'join' => "LEFT JOIN `field` ON `crop`.`field_id` = `field`.`id`",
    ],

    'crop_s' => [
		'view' => "gantt",
		'sql' => "SELECT `crop`.`id`, `crop`.`crop_nm`, `crop`.`planting_dt`, `crop`.`harvest_dt` FROM `crop`",
        'go_to' => 'crop',
		'rows' => ['id', 'crop_nm', 'planting_dt', 'harvest_dt', 'crop_nm'],
        'thead' => [],
		'row_s' => [],
		'add_col' =>  [
					['type' => 'string', 'id' => 'Crop'],
					['type' => 'string', 'id' => 'Type'],
					['type' => 'date', 'id' => 'Planting Date'],
					['type' => 'date', 'id' => 'Harvest Date']
				],
	],

    'crop_p' => [
		'view' => "table",
        'thead' => ['Crop Name', 'Treatment', 'Date Applied', 'Employee In Charge', 'Notes'],
		'row_s' => ['crop_nm', '', 'treatment', 'dt_applied', 'employee_name', 'notes'],
		'act_e' => ['update'],
		'act_a' => ['update'],
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS employee_name'], 
		'join' => "RIGHT JOIN `crop` ON `crop`.`id` = `crop_log`.`crop_id`
				   RIGHT JOIN `employee` ON `employee`.`id` = `crop_log`.`employee_id`",
		'where' => "WHERE `crop_log`.`record_type` LIKE '%pest_control%'",		
    ],

    'crop_f' => [
		'view' => "table",
        'thead' => ['Crop Name', 'Fertilizer Type',  'Date Applied', 'Employee In Charge', 'Remarks'],
		'row_s' => ['crop_nm', '', 'fertilizer_type', 'dt_applied', 'employee_name', 'notes'],
		'act_e' => ['update'],
		'act_a' => ['update'],
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS employee_name'], 
		'join' => "RIGHT JOIN `crop` ON `crop`.`id` = `crop_log`.`crop_id`
				   RIGHT JOIN `employee` ON `employee`.`id` = `crop_log`.`employee_id`",
		'where' => "WHERE `crop_log`.`record_type` LIKE '%fertilization%'",		
    ],
	
    'crop_h' => [
		'view' => "table",
        'thead' => ['Crop Name','Outcome', 'Est. Harvest Date', 'Actual Date', 'Actual Yield', 'Employee In Charge','Notes'],
		'row_s' => ['crop_nm', '', 'harvest_oc', 'harvest_dt', 'harvest_dt_act', 'act_yield', 'employee_name', 'notes'],
		'act_e' => ['update'],
		'act_a' => ['update'],
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS employee_name'], 
		'join' => "RIGHT JOIN `crop` ON `crop`.`id` = `crop_log`.`crop_id`
				   RIGHT JOIN `employee` ON `employee`.`id` = `crop_log`.`employee_id`",
		'where' => "WHERE `crop_log`.`record_type` LIKE '%harvest%'",		
		'quick_ct' => "harvest_oc",		
		'status' => ['Pending', 'Harvested','Failed'],		
    ],

    'livestock' => [
		'view' => "table",
        'thead' => ['Livestock', 'Batch Quantity', 'Birthdate'],
		'row_s' => ['livestock_nm', 'livestock_type', 'quantity', 'birthdate'],
		'act_e' => ['view'],
		'act_a' => ['view', 'update', 'delete'],	
    ],

    'livestock_v' => [
		'view' => "table",
        'thead' => ['Livestock', 'Vaccine Date', 'Vaccine Type', 'Employee In Charge', 'Notes'],
		'row_s' => ['livestock_nm',  '', 'record_dt', 'vaccine_type', 'employee_name', 'notes'],
		'act_e' => [],
		'act_a' => ['update'],
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS employee_name'], 
		'join' => "RIGHT JOIN `livestock` ON `livestock`.`id` = `livestock_log`.`livestock_id`
					RIGHT JOIN `employee` ON `employee`.`id` = `livestock_log`.`employee_id`",
		'where' => "WHERE `livestock_log`.`record_type` LIKE '%vaccination%'",
    ],

    'livestock_f' => [
		'view' => "gantt",
		'sql' => "SELECT 
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
					ll.record_type LIKE '%feed%'",
		'go_to' => 'livestock_f',
		'rows' => ['id', 'livestock_nm', 'feed_start_dt', 'feed_end_dt', 'feed_type'],
		'add_col' =>  [
					['type' => 'string', 'id' => 'Livestock Id'],
					['type' => 'string', 'id' => 'Type'],
					['type' => 'date', 'id' => 'Start'],
					['type' => 'date', 'id' => 'End']
				],

    ],

    'attendance_c' => [
		'view' => "table",
        'thead' => ['Date', 'Shift Starts', 'Shift Ends', 'Time In', 'Time Out', 'Total Hours'],
		'act_e' => [],
		'act_a' => [],
		'quick_ct' => "",
		'row_s' => ['log_date', '', 'shift_st', 'shift_ed', 'clock_in', 'clock_out', 'hrs_worked'], // column names
		'concat' => [], // No concatenation needed
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `employee_log`.`employee_id` = '$empID'", // Where condition from the original query
		'order' => "ORDER BY log_date DESC" // Where condition from the original query
	],

    'attendance_t' => [
		'view' => "table",		
        'thead' => ['Date', 'Duration', 'Overtime', 'Undertime', 'Late', 'Reason', 'Status', 'Remarks'],
		'act_e' => ['request'],
		'act_a' => ['request'],
		'row_s' => ['log_date', '', 'hrs_worked', 'hrs_ot', 'hrs_ut', 'hrs_late', 'reason', 'status', 'remarks'], // column names
		'concat' => "", // No concatenation needed
		'join' => "RIGHT JOIN `employee_log` ON `employee_log`.`file_ticket` = `employee_record`.`file_ticket`", // Join condition
		'where' => "WHERE `employee_log`.`employee_id` = '$empID'", // Where condition from the original query
		'order' => "ORDER BY log_date DESC" // Where condition from the original query
	],

    'attendance_l' => [
		'view' => "table",		
        'thead' => ['Leave Type', 'Status', 'Start Date', 'End Date', 'Reason', 'Remarks'],
		'act_e' => ['update'],
		'act_a' => ['update'],
		'row_s' => ['leave_type', 'date_filed', 'status', 'start_dt', 'end_dt', 'reason', 'remarks'], // column names
		'concat' => [], // No concatenation needed
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `employee_record`.`record_type` LIKE '%leave%' AND `employee_record`.`employee_id` = '$empID'",
		'quick_ct' => "status",
		'status' => ['Pending', 'Approved', 'Denied'],
		'order' => "ORDER BY date_filed DESC" // Where condition from the original query
    ],

    'attendance_p' => [
		'view' => "table",		
        'thead' => ['Pay Period', 'Days Worked', 'Total OT', 'Daily Rate', 'OT Rate', 'Gross Pay', 'Deduction', 'Take Home Pay'],
        'act_e'   => ['view'],
		'quick_ct' => "",
		'row_s' => ['pay_period', '', 'total_days_worked', 'total_overtime_hours', 'wage_daily', 'wage_ot', 'gross_pay','total_deductions','take_home_pay'],
		'concat' => ['CONCAT(DATE_FORMAT(pay_period_st, "%b %d, %Y"), " - ",DATE_FORMAT(pay_period_ed, "%b %d, %Y")) AS pay_period'],
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `employee_id` = '$empID'",
		'order' => "ORDER BY pay_period_st DESC" // Where condition from the original query
    ],
	
    'attendance_s' => [
		'view' => "table",		
        'thead' => ['Date', 'Shift Start', 'Shift End', 'Task'],
        'act_e'   => [],
		'quick_ct' => "",
		'row_s' => ['log_date', '', 'shift_st','shift_ed','task'],
		'concat' => [],
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `employee_id` = '$empID'", // Where condition from the original query
		'order' => "ORDER BY log_date DESC" // Where condition from the original query
    ],

	'allocation_b' => [
		'view' => "table",
        'thead' => ['ID', 'Expense Category', 'Budgeted Amount', 'Actual Amount', 'Remaining Amount'],
		'act_e' => [],
		'act_a' => ['update'],
		'quick_ct' => "",
		'row_s' => ['id', 'expenses_cat', 'amnt_budgeted', 'amnt_actual', 'amnt_remaining'], // column names
		'concat' => [], // No concatenation needed
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `allocation_type` = 'budget'" // Where condition from the original query
    ],
	
	
    'allocation_c' => [
		'view' => "table",		
        'thead' => ['Crop Name', 'Land Allocation (sqm)', 'Water Allocation (L)', 'Fertilizer Allocation (kg)', 'Start Date', 'End Date'],
		'act_e' => [],
		'act_a' => ['update'],
		'quick_ct' => "",
		'row_s' => ['crop_nm', '', 'allocation_land', 'allocation_water', 'allocation_ferti', 'start_date', 'end_date'], // column names
		'concat' => [], // No concatenation needed
		'join' => "LEFT JOIN `crop` ON `crop`.`id` = `allocation_log`.`crop_id`", // Join condition
		'where' => "WHERE `allocation_log`.`allocation_type` LIKE '%crop%'" // Where condition from the original query
    ],

    'allocation_e' => [
		'view' => "table",		
        'thead' => ['Equipment Name', 'Field'],
		'act_e' => [],
		'act_a' => ['update'],
		'quick_ct' => "",
		'row_s' => ['equipment_nm', 'model', 'field_nm'], // column names
		'concat' => [], // No concatenation needed
		'join' => "LEFT JOIN `equipm` ON `allocation_log`.`equipment_id` = `equipm`.`id` LEFT JOIN `field` ON `allocation_log`.`field_id` = `field`.`id`", // Join conditions
		'where' => "WHERE `allocation_log`.`allocation_type` LIKE '%equipment%'" // Where condition from the original query
    ],

    'allocation_f' => [
		'view' => "table",		
        'thead' => ['Fertlizer Name', 'Quantity (kg)', 'Allocated Quantity (kg)', 'Percentage', 'Date Allocated'],
		'act_e' => [],
		'act_a' => ['update'],
		'quick_ct' => "",
		'row_s' => ['item_name', '', 'quantity', 'allocation_qty', 'percentage', 'allocation_date'], // column names
		'concat' => [], // No concatenation needed
		'join' => "LEFT JOIN `items` ON `items`.`id` =  `allocation_log`.`item_id`", // Join condition
		'where' => "WHERE `allocation_log`.`allocation_type` LIKE '%fertilizer%'" // Where condition from the original query
    ],

    'allocation_l' => [
		'view' => "table",		
        'thead' => ['Employee Name', 'Task Allocation', 'Work Hours'],
		'act_e' => [],
		'act_a' => ['update'],
		'quick_ct' => "",
		'row_s' => ['employee_name', 'pos_dept', 'allocation_task', 'work_hrs'], // column names
		'concat' => [
			'CONCAT(employee.first_nm, " ", employee.last_nm) AS employee_name',
			'CONCAT(employee.position, " / ", employee.department) AS pos_dept'
		], // concat in array
		'join' => "LEFT JOIN `employee` ON `employee`.`id` =  `allocation_log`.`employee_id`", // Join condition
		'where' => "WHERE `allocation_log`.`allocation_type` LIKE '%labor%'" // Where condition from the original query
    ],

    'purchases' => [
		'view' => "table",		
        'thead' => ['Product Name', 'Status', 'Quantity', 'UOM', 'Remarks from Admin'],
		'row_s' => ['product_nm', 'date_filed', 'status','quantity', 'unit', 'remarks'], // column names		
		'act_e' => ['update', 'delete'],
		'act_a' => ['update'],
		'quick_ct' => "status",
		'status' => ['Pending', 'Approved', 'Denied'],
		'concat' => [],
		'join' => "LEFT JOIN `employee` ON `employee`.`id` = `sc_purchases`.`employee_id`", // Join condition
		'where' => "WHERE `employee_id` = '$empID'" // Where condition from the original query
	],

    'distribution' => [
		'view' => "table",		
        'thead' => ['Employee in Charge', 'Status', 'Product Name', 'Total Price', 'Destination', 'Remarks'],
		'row_s' => ['full_name', 'date', 'status', 'product_nm', 'total_prc', 'destination', 'remarks'], 	
		'act_e' => ['view'],
		'act_a' => ['view','update','delete'],
		'quick_ct' => "status",
		'status' => ['Pending', 'Shipped', 'Delivered', 'Cancelled'],
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name'], // concat in array
		'join' => "LEFT JOIN `employee` ON `employee`.`id` = `sc_distribution`.`employee_id`", // Join condition
		'where' => ""
    ],
	
	#ADMIN - EMPLOYEE
    'employee' => [
		'view' => "table",		
		'sql_v' => "SELECT * FROM employee WHERE id = ?",
        'thead' => ['Employee Name', 'Employment Date', 'Daily Wage'],
		'row_s' => ['full_name', 'position_dept', 'employee_dt', 'wage_daily'], // column names
        'act_a'   => ['view','update','delete'],
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name', 'CONCAT(employee.position, " / ", employee.department) AS position_dept'], // concat in array
		'quick_ct' => "department",
		'status' => ['Operation', 'Admin'],
		'where' => "",		
    ],	
	
    'employee_a' => [
		'view' => "table",		
        'thead' => ['Employee Name', 'Time In', 'Time Out','Total Hours Worked'],
        'act'   => ['view'],
		'quick_ct' => "",
		'row_s' => ['full_name', 'log_date', 'clock_in', 'clock_out', 'hrs_worked'], // column names
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name', 'CONCAT(employee.position, " / ", employee.department) AS position_dept'], // concat in array
		'join' => "RIGHT JOIN `employee` ON `employee`.`id` = `employee_log`.`employee_id`", // Join condition
		'where' => "WHERE NOT `employee_id` = '$empID'",
		'order' => "ORDER BY log_date DESC" // Where condition from the original query
	],	
	
    'employee_p' => [
		'view' => "table",		
        'thead' => ['Employee Name', 'Daily Rate', 'Gross Pay', 'Deduction', 'Take Home Pay'],
        'act_a'   => ['view'],
		'quick_ct' => "",
		'row_s' => ['full_name', 'pay_period', 'wage_daily','gross_pay','total_deductions','take_home_pay',],
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name',
					 'CONCAT(DATE_FORMAT(pay_period_st, "%b %d, %Y"), " - ",DATE_FORMAT(pay_period_ed, "%b %d, %Y")) AS pay_period'],
		'join' => "RIGHT JOIN `employee` ON `employee`.`id` = `payroll_data`.`employee_id`",
		'where' => "",	
    ],	
	
    'employee_s' => [
		'view' => "table",		
        'thead' => ['Employee Name', 'Shift Start', 'Shift End',' Task'],
        'act_a'   => ['update'],
		'quick_ct' => "",
		'row_s' => ['full_name', 'log_date', 'shift_st', 'shift_ed', 'task'], // column names
		'concat' => [
			'CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name', 
			'CONCAT(employee.position, " / ", employee.department) AS position_dept'
		], // concat in array
		'join' => "RIGHT JOIN `employee` ON `employee`.`id` = `employee_log`.`employee_id`", // Join condition
		//'where' => "WHERE `log_date` = '$today'",
		'order' => "ORDER BY log_date DESC" // Where condition from the original query
    ],	
	
    'employee_t' => [
		'view' => "table",		
        'thead' => ['Employee Name', 'Date', 'Hours Worked', 'Late',' Overtime','Undertime'],
        'act_a'   => ['view'],
		'quick_ct' => "",
		'row_s' => ['full_name', 'position_dept', 'log_date', 'hrs_worked', 'hrs_late', 'hrs_ot', 'hrs_ut'], // column names
		'concat' => [
			'CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name', 
			'CONCAT(employee.position, " / ", employee.department) AS position_dept'
		], // concat in array
		'join' => "RIGHT JOIN `employee` ON `employee`.`id` = `employee_log`.`employee_id`", // Join condition
		'where' => "WHERE NOT `employee_id` = '$empID'",
    ],		
	
	'employee_r' => [
		'view' => "table",		
        'thead' => ['Employee Name', 'Status', 'Request Type', 'Date Filed', 'Reason', 'Remarks'],
		'act_a' => ['update'],
		'quick_ct' => "status",
		'status' => ['Pending', 'Approved', 'Denied'],
		'row_s' => ['full_name', '', 'status', 'record_type', 'date_filed', 'reason', 'remarks'], // column names
		'concat' => ['CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name'], // concat in array
		'join' => "RIGHT JOIN `employee` ON `employee`.`id` = `employee_record`.`employee_id`", // Join condition
		'where' => "" // No WHERE clause in the provided query
    ],	
	
	
	#ADMIN - FINANCE
	
	'finance_b' => [
		'view' => "table",		
        'thead' => ['Year', 'Expense', 'Planned Budget','Notes','Attachment'],
        'act_a'   => ['view','update'],
		'quick_ct' => "",
		'row_s' => ['year', 'department', 'expenses_cat', 'amount', 'notes', 'attachment'], // column names
		'concat' => [], // No concatenation needed
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `transaction_type` = 'budget'" // Where condition from the original query
    ],	
	
	'finance_e' => [
		'view' => "table",		
        'thead' => ['Date', 'Expense Category', 'Amount','Notes','Attachment'],
        'act_a'   => ['view','update'],
		'quick_ct' => "",
		'row_s' => ['date', 'department', 'expenses_cat', 'amount', 'notes', 'attachment'], // column names
		'concat' => [], // No concatenation needed
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `transaction_type` = 'expense'" // Where condition from the original query
    ],	
	
	'finance_r' => [
		'view' => "table",		
        'thead' => ['Date',  'Source', 'Amount','Notes','Attachment'],
        'act_a'   => ['view','update'],
		'quick_ct' => "",
		'row_s' => ['date', 'revenue_cat', 'source', 'amount', 'notes', 'attachment'], // column names
		'concat' => [], // No concatenation needed
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `transaction_type` = 'revenue'" // Where condition from the original query
    ],	
	
	'finance_p' => [
		'view' => "table",		
        'thead' => ['Year', 'Net Profit ', 'Notes','Attachment'],
        'act_a'   => ['view','update'],
		'quick_ct' => "",
		'row_s' => ['year', 'department', 'amount', 'notes', 'attachment'], // column names
		'concat' => [], // No concatenation needed
		'join' => "", // No JOIN in the provided query
		'where' => "WHERE `transaction_type` = 'profit'" // Where condition from the original query
    ],

	'user' => [
		'view' => "table",
		'sql_v' => "SELECT * FROM employee WHERE id = ?",
        'thead' => ['Name', 'User Level', 'E-Mail', 'Username'],
		'act_e' => [],
        'act_a'   => ['update'],
		'quick_ct' => "user_lvl",
		'status' => ['Employee', 'Admin'],
		'row_s' => ['full_name', 'position_dept', 'user_lvl', 'email', 'username'], // column names
		'concat' => [
			'CONCAT(employee.first_nm, " ", employee.last_nm) AS full_name', 
			'CONCAT(employee.position, " / ", employee.department) AS position_dept'
		], // concat in array
		'join' => "", // No JOIN in the provided query
		'where' => "" 
    ],	
]
?>
