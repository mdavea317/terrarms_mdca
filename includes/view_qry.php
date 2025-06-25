<?php


$empID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 0;


$view_qry = [
 
	#BOTH - EQUIPMENT
    'items' => [
		'sql' => "SELECT item_name, description, category, unit FROM items WHERE id = ?;",
        'thead' => ['ID', 'Category', 'Item Name', 'Description', 'Unit', 'Price', 'Ideal Quantity'],
		'panel_b' => [
			'type' => 'timeline-trans',
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
			'sql' => "SELECT * FROM items WHERE id = ?",
			'rows' => [], 
		],		
		'panel_c' => [
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
		],		
    ],
	
	
	#BOTH - FIELDS
	
	'field' => [
		'sql' => "SELECT id, field_nm, area, soil_type, irrigation, date_added FROM field WHERE id = ?;",
        'thead' => ['ID', 'Field Name', 'Area (in sqm)', 'Soil Type', 'Irrigation', 'Date Added'],
		'panel_b' => [
			'type' => "maps",
			'display' => "", //ibig sabihin, default display: block;
			'sql' => "SELECT geometry FROM field WHERE id = ?;",
			'rows' => ['geometry'], 
		],	
		'panel_c' => [
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
		],	
	],	
	
	
	#BOTH - EQUIPMENT
    'equipment' => [
		'sql' => "SELECT `equipm`.`id`, `equipm`.`equipment_nm`, `equipm`.`model`, 
                           `equipm`.`manufacturer`, `equipm`.`purchase_dt`, 
                           `equipm`.`warranty_end`, `field`.`field_nm` 
                    FROM `equipm` 
                    LEFT JOIN `field` 
                    ON `equipm`.`field_id` = `field`.`id` WHERE `equipm`.`id` = ?;",
        'thead' => ['ID', 'Category', 'Item Name', 'Description', 'Unit', 'Price', 'Ideal Quantity'],
		'panel_b' => [
			'type' => 'timeline-trans',
			'display' => "", //ibig sabihin, default display: block;
			'sql' => "SELECT
							el.id,
							el.log_date,
							el.log_type,
							el.employee_id,
							CONCAT(el.status, ': ', el.maint_type, ' by ', e.first_nm, ' ', e.last_nm) AS details
						FROM
							equipm_log el
						LEFT JOIN
							employee e ON el.employee_id = e.id
						WHERE
							el.equipment_id = ?",
			'rows' => ['log_date','log_type','details', 'employee_id'], 
		],		
		'panel_c' => [
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
		],		
    ],
	
	#BOTH - CROP
    'crop' => [
		'sql' => "SELECT `crop`.`id`, `crop`.`crop_nm`, `crop`.`est_yield`, 
                           `field`.`field_nm`
                    FROM `crop` 
                    LEFT JOIN `field` 
                    ON `crop`.`field_id` = `field`.`id` WHERE `crop`.`id` = ?;",
        'thead' => ['ID', 'Crop Name', 'Estimated Yield (in kg)', 'Location'],
		'panel_b' => [
			'type' => 'timeline-trans',
			'display' => "", //ibig sabihin, default display: block;
			'sql' => "SELECT
						crop_log.id,
						crop_log.record_type,
						crop_log.dt_applied,
						crop_log.employee_id,
						CONCAT(
							crop_log.treatment, 
							crop_log.fertilizer_type, ', ', 
							crop_log.notes, ' by ', 
							employee.first_nm, ' ', 
							employee.last_nm
						) AS details
					FROM crop_log
					LEFT JOIN employee ON crop_log.employee_id = employee.id
					WHERE crop_log.crop_id = ?;",
			'rows' => ['dt_applied','record_type','details','employee_id'], 
		],
		'panel_c' => [
			'display' => "", //ibig sabihin, default display: block;
		],
	],		
	

	#BOTH - LIVESTOCK
    'livestock' => [
		'sql' => "SELECT 
						id,
						livestock_type,
						livestock_nm,
						quantity,
						birthdate
					FROM 
						livestock
					WHERE 
						id = ?;",
        'thead' => ['ID', 'Livestock Type', 'Livestock Batch Code', 'Batch Quantity', 'Birthdate'],
		'panel_b' => [
			'type' => 'timeline-trans',
			'display' => "", //ibig sabihin, default display: block;
			'sql' => "SELECT
						livestock_log.id,
						livestock_log.record_type,
						livestock_log.record_dt,
						livestock_log.employee_id,
						CONCAT(
							IFNULL(vaccine_type, ''), 
							IF(vaccine_type IS NOT NULL AND feed_type IS NOT NULL, ' ', ''), 
							IFNULL(feed_type, ''), 
							IF(feed_qty IS NOT NULL, CONCAT(' ', feed_qty, 'kg'), ''), 
							' by ', 
							COALESCE(employee.first_nm, ''), 
							' ', 
							COALESCE(employee.last_nm, '')
						) AS details
					FROM
						livestock_log
					LEFT JOIN
						employee ON livestock_log.employee_id = employee.id
					WHERE
						livestock_log.livestock_id = ?
					ORDER BY
						livestock_log.record_dt DESC;",
			'rows' => ['record_dt','record_type','details','employee_id'], 
		],
		'panel_c' => [
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
		],	
	],		
	
	#BOTH - PAY PERIOD
    'attendance_p' => [
		'sql' => "SELECT
					CONCAT(DATE_FORMAT(pay_period_st, '%b %d, %Y'),  '-' ,DATE_FORMAT(pay_period_ed, '%b %d, %Y')) AS pay_period,
					wage_daily,
					wage_ot,
					total_days_worked,
					total_overtime_hours,
					gross_pay,
					sss,
					pagibig,
					philhealth,
					total_deductions,
					take_home_pay
				FROM 
					payroll_data
 				WHERE id = ?",
        'title' => "payroll",
        'thead' => ['Pay Period', 'Daily Rate', 'OT Rate','Total Days Worked', 'Total Overtime Hours', '*TOTAL GROSS PAY', 'SSS','PagIbig','Philhealth', '*TOTAL DEDUCTIONS', '*TAKE HOME PAY'],
		'panel_b' => [
			'type' => 'timeline-trans',
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
			'sql' => "SELECT * FROM employee WHERE id = ?",
			'rows' => ['record_dt','record_type','details','employee_id'], 
		],	
		'panel_c' => [
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
		],	
    ],
	
	
	
	#ADMIN - EMPLOYEE
    'employee' => [
		'sql' => "SELECT 
					id,
					CONCAT(first_nm, ' ', last_nm) AS full_name,
					birthdate,
					address,
					phone_num,
					email,
					CONCAT(emerg_name, ' - ', emerg_num) AS emergency_contact,
					CONCAT(position, ' - ', department) AS job_info,
					employee_dt,
					num_ss,
					num_pagibig,
					num_philhealth,
					num_tin,
					wage_daily
				FROM 
					employee
 				WHERE id = ?",
        'thead' => ['ID', 'Name', 'Birthdate', 'Address','Phone Number','Email','In case of emergency', 'Position / Department','Employment Date','SSS #','PAG IBIG #','PHILHEALTH #', 'TIN #', 'Daily Wage'],
		'panel_b' => [
			'type' => 'timeline-trans',
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
			'sql' => "SELECT * FROM employee WHERE id = ?",
			'rows' => ['record_dt','record_type','details','employee_id'], 
		],	
		'panel_c' => [
			'display' => "style='display:none;'", //ibig sabihin, default display: block;
		],	
    ],		
	
];
?>
