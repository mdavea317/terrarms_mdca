<?php

    $first_nm = $_POST['first_nm'];
    $last_nm = $_POST['last_nm'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $phone_num = $_POST['phone_num'];
    $email = $_POST['email'];
    $emerg_name = $_POST['emerg_name'];
    $emerg_num = $_POST['emerg_num'];
    $position = $_POST['position'];
    $department = $_POST['department'];
    $employee_dt = $_POST['employee_dt'];

  	$capturedImage1 = $_POST['capturedImage1'];
  	$capturedImage2 = $_POST['capturedImage2'];
  	$base64Data1 = explode(',', $capturedImage1)[1];
	$base64Data2 = explode(',', $capturedImage2)[1];
  	$imageData1 = base64_decode($base64Data1);
  	$imageData2 = base64_decode($base64Data2);

    $num_ss = $_POST['num_ss'];
    $num_pagibig = $_POST['num_pagibig'];
    $num_philhealth = $_POST['num_philhealth'];
    $num_tin = $_POST['num_tin'];
    $wage_daily = $_POST['wage_daily'];
    $wage_ot = $_POST['wage_ot'];
    $rt_ss = $_POST['rt_ss'];
    $rt_pagibig = $_POST['rt_pagibig'];
    $rt_philhealth = $_POST['rt_philhealth'];

	$firstName = $_POST['first_nm'];
	$first_name_part = strtolower(substr($firstName, 0, 4));
	$day_of_birth = substr($_POST['birthdate'], -2);

	$username = ucfirst(str_replace(' ', '', $firstName));
	$password = $first_name_part . $day_of_birth;
	$user_lvl = $_POST['user_lvl'];

	$date_regis = date("Y-m-d");

	  $folderPath = "wp-uploads/employees/{$last_nm}_{$first_nm}/";
	  if (!file_exists($folderPath)) {
		  mkdir($folderPath, 0777, true);
	  }
	  file_put_contents($folderPath . '1.png', $imageData1);
	  file_put_contents($folderPath . '2.png', $imageData2);


    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `employee` (first_nm, last_nm, birthdate, address, phone_num, email, 
                emerg_name, emerg_num, position, department, employee_dt, student_img1, student_img2, num_ss, num_pagibig, 
                num_philhealth, num_tin, wage_daily, wage_ot, rt_ss, rt_pagibig, rt_philhealth, username, password, user_lvl, date_regis) 
                VALUES ('$first_nm', '$last_nm', '$birthdate', '$address', '$phone_num', '$email', 
                '$emerg_name', '$emerg_num', '$position', '$department', '$employee_dt',
				'{$last_nm}_{$first_nm}_image1.png',
				'{$last_nm}_{$first_nm}_image2.png',
				'$num_ss', '$num_pagibig', '$num_philhealth', '$num_tin', '$wage_daily', '$wage_ot',
				'$rt_ss', '$rt_pagibig', '$rt_philhealth', '$username', '$password', '$user_lvl', '$date_regis')";
        
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `employee` SET 
                first_nm = '$first_nm', 
                last_nm = '$last_nm', 
                birthdate = '$birthdate', 
                address = '$address', 
                phone_num = '$phone_num', 
                email = '$email', 
                emerg_name = '$emerg_name', 
                emerg_num = '$emerg_num', 
                position = '$position', 
                department = '$department', 
                employee_dt = '$employee_dt', 
                num_ss = '$num_ss', 
                num_pagibig = '$num_pagibig', 
                num_philhealth = '$num_philhealth', 
                num_tin = '$num_tin', 
                wage_daily = '$wage_daily', 
                wage_ot = '$wage_ot', 
                rt_ss = '$rt_ss', 
                rt_pagibig = '$rt_pagibig', 
                rt_philhealth = '$rt_philhealth', 
                user_lvl = '$user_lvl' 
                WHERE id = $id";
    }
?>
