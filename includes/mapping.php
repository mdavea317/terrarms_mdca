<?php

$txn = isset($_GET['txn']) ? $_GET['txn'] : null; // txn=? on the link, hindi ito table galing sa db

/* -- TRANSACTION TITLES -- */
$transactions = [
	
	/*-- GENERAL --*/
    'items' => 'items', // txn = items -> table = items
	'field' => 'field',
	'equipment' => 'equipm',
	'equipment_u' => 'equipm_log',
	'equipment_m' => 'equipm_log',
	'crop' => 'crop',
	'crop_s' => 'crop',
	'crop_p' => 'crop_log',
	'crop_f' => 'crop_log',
	'crop_h' => 'crop_log',
	'livestock' => 'livestock',
	'livestock_v' => 'livestock_log',
	'livestock_f' => 'livestock_log',
	
	'purchases' => 'sc_purchases',
	'distribution' => 'sc_distribution',
	
	/*-- USER: VIEW --*/
	'attendance_c' => 'employee_log',
	'attendance_t' => 'employee_record',
	'attendance_l' => 'employee_record',
	'attendance_p' => 'payroll_data',
	'attendance_s' => 'employee_log',
	'allocation_b' => 'allocation_log',
	'allocation_c' => 'allocation_log',
	'allocation_e' => 'allocation_log',
	'allocation_f' => 'allocation_log',
	'allocation_l' => 'allocation_log',

	/*-- ADMIN: VIEW --*/
	'employee' => 'employee',		 //employee list
	'employee_p' => 'payroll_data',	 //payroll
	'employee_a' => 'employee_log',  //attendance
	'employee_s' => 'employee_log',  //schedule
	'employee_t' => 'employee_log',  //time logs
	'employee_r' => 'employee_record', //requests
	'payroll_wiz' => 'payroll',
	
	'finance_b' => 'finance_log',
	'finance_e' => 'finance_log',
	'finance_r' => 'finance_log',
	'finance_p' => 'finance_log',

	'user' => 'employee',

	
	
	
];

// Check if txn exists in the transactions array
if (!isset($txn) || !array_key_exists($txn, $transactions)) {
    echo "Error: Missing or invalid transaction type.";
    exit;
}

$table = $transactions[$txn]; // Get the corresponding table name



/* -- TITLES AS H1 -- */
$titles = [
	'items' => [
		'h1' => 'Item list', 
		'parent' => 'Resource Item', 
		'toggle' => 'res-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
	],
	'field' => [
		'h1' => 'Farm field', 
		'parent' => 'Resource Item', 
		'toggle' => 'res-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'equipment' => [
		'h1' => 'Record', 
		'parent' => 'Equipment', 
		'toggle' => 'equ-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'add_btn' => 'Add Record',
		'drop_tog' => 'style="display:none;"',

	],
	'equipment_u' => [
		'h1' => 'Availability Tracker', 
		'parent' => 'Equipment', 
		'toggle' => 'equ-on',
		'add_tog_e' => '',
		'add_tog_a' => '',
		'add_btn' => 'Book An Equipment',
	],
	'equipment_m' => [
		'h1' => 'Maintenance', 
		'parent' => 'Equipment', 
		'toggle' => 'equ-on',
		'add_tog_e' => '',
		'add_tog_a' => '',
		'add_btn' => 'Book For Repair',		
	],
	'crop' => [
		'h1' => 'Records', 
		'parent' => 'Crops', 
		'toggle' => 'cro-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'crop_s' => [
		'h1' => 'Crop Schedule', 
		'parent' => 'Crops', 
		'toggle' => 'cro-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"',
		'drop_tog' => 'style="display:none;"',
		'srch_tog' => 'style="display:none;"',			
	],
	'crop_p' => [
		'h1' => 'Pest Control', 
		'parent' => 'Crops', 
		'toggle' => 'cro-on',
		'add_tog_e' => '',
		'add_btn' => 'Add Record',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'crop_f' => [
		'h1' => 'Fertilizer', 
		'parent' => 'Crops', 
		'toggle' => 'cro-on',
		'add_tog_e' => '',
		'add_tog_a' => '',
		'add_btn' => 'Add Record',
		'drop_tog' => 'style="display:none;"',		
	],
	'crop_h' => [
		'h1' => 'Harvest Outcome', 
		'parent' => 'Crops', 
		'toggle' => 'cro-on',
		'add_tog_e' => '',
		'add_tog_a' => '',
		'add_btn' => 'Add Record',
	],
	'livestock' => [
		'h1' => 'Records', 
		'parent' => 'Livestock', 
		'toggle' => 'liv-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'livestock_v' => [
		'h1' => 'Vaccination', 
		'parent' => 'Livestock', 
		'toggle' => 'liv-on',
		'add_tog_e' => '',
		'add_tog_a' => '',
		'add_btn' => 'Add Log',
		'drop_tog' => 'style="display:none;"',		
	],
	'livestock_f' => [
		'h1' => 'Feeding Plan', 
		'parent' => 'Livestock', 
		'toggle' => 'liv-on',
		'add_tog_e' => '',
		'add_tog_a' => '',
		'add_btn' => 'Add Feed Plan Record',		
		'drop_tog' => 'style="display:none;"',		
		'srch_tog' => 'style="display:none;"',		
	],


	'purchases' => [
		'h1' => 'Purchase Order', 
		'parent' => 'Supply Chain', 
		'toggle' => 'sup-on',
		'add_tog_e' => '',
		'add_tog_a' => '',
		'add_btn' => 'Request Purchases Order',
	],
	'distribution' => [
		'h1' => 'Distribution Tracker', 
		'parent' => 'Supply Chain', 
		'toggle' => 'sup-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'add_btn' => '',
	],
	
	/*-- USER: VIEW --*/
	'attendance_c' => [
		'h1' => 'Time In/Out', 
		'parent' => 'Attendance', 
		'toggle' => 'att-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
		'srch_tog' => '',		
	],
	'attendance_t' => [
		'h1' => 'Time Logs', 
		'parent' => 'Attendance', 
		'toggle' => 'att-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"',
		'drop_tog' => 'style="display:none;"',
		'srch_tog' => '',		
	],
	'attendance_l' => [
		'h1' => 'Leave Requests', 
		'parent' => 'Attendance', 
		'toggle' => 'att-on',
		'add_tog_e' => '',
		'add_tog_a' => '',		
		'add_btn' => 'Request Leave',		
		'srch_tog' => 'style="display:none;"',		
	],
	'attendance_p' => [
		'h1' => 'Payroll Details', 
		'parent' => 'Attendance', 
		'toggle' => 'att-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
		'srch_tog' => '',	
	],
	'attendance_s' => [
		'h1' => 'Shift Schedule', 
		'parent' => 'Attendance', 
		'toggle' => 'att-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
		'srch_tog' => '',	
	],

		
	'allocation_b' => [
		'h1' => 'Budget', 
		'parent' => 'Resource Allocation', 
		'toggle' => 'all-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
	],
	'allocation_c' => [
		'h1' => 'Crop', 
		'parent' => 'Resource Allocation', 
		'toggle' => 'all-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'allocation_e' => [
		'h1' => 'Equipment', 
		'parent' => 'Resource Allocation', 
		'toggle' => 'all-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'allocation_f' => [
		'h1' => 'Fertilizer', 
		'parent' => 'Resource Allocation', 
		'toggle' => 'all-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'allocation_l' => [
		'h1' => 'Labor', 
		'parent' => 'Resource Allocation', 
		'toggle' => 'all-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],

	/*-- ADMIN: VIEW --*/
	'employee' => [
		'h1' => 'Record', 
		'parent' => 'Employee', 
		'toggle' => 'emp-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
	],
	'employee_p' => [
		'h1' => 'Payroll', 
		'parent' => 'Employee', 
		'toggle' => 'emp-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"', //payroll wizard
		'drop_tog' => 'style="display:none;"',		
		'srch_tog' => '',
	],
	'employee_a' => [
		'h1' => 'Attendance', 
		'parent' => 'Employee', 
		'toggle' => 'emp-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"',
		'drop_tog' => 'style="display:none;"',		
	],
	'employee_s' => [
		'h1' => 'Shift Schedule', 
		'parent' => 'Employee', 
		'toggle' => 'emp-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"',
		'drop_tog' => 'style="display:none;"',	
	],
	'employee_t' => [
		'h1' => 'Time log', 
		'parent' => 'Employee', 
		'toggle' => 'emp-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"',
		'drop_tog' => 'style="display:none;"',
	],
	'employee_r' => [
		'h1' => 'Employee Requests', 
		'parent' => 'Employee', 
		'toggle' => 'emp-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"',
	],
	
	
	'finance_b' => [
		'h1' => 'Budget', 
		'parent' => 'Finance', 
		'toggle' => 'fin-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'finance_e' => [
		'h1' => 'Expenses', 
		'parent' => 'Finance', 
		'toggle' => 'fin-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'finance_r' => [
		'h1' => 'Revenue', 
		'parent' => 'Finance', 
		'toggle' => 'fin-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	'finance_p' => [
		'h1' => 'Profit', 
		'parent' => 'Finance', 
		'toggle' => 'fin-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => '',
		'drop_tog' => 'style="display:none;"',
	],
	
	'user' => [
		'h1' => 'User Management', 
		'parent' => 'Employee', 
		'toggle' => 'user-on',
		'add_tog_e' => 'style="display:none;"',
		'add_tog_a' => 'style="display:none;"',
	],	
];


include 'includes/read_qry.php';
include 'includes/view_qry.php';


	if (isset($titles[$txn])) {
         /*$titles[$txn]['tab'];*/
        $title_h1 = $titles[$txn]['h1'];
		$title_parent = $titles[$txn]['parent'];
		$title = strtoupper($title_h1). " | ".strtoupper($title_parent) ." | ";
		$menu_toggle = $titles[$txn]['toggle'];
    }


?>