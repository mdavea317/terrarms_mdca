<?php
	$title = "REPORTS | ";
	$title_h1 = "Reports";
	$breadc_if_active = "style='display:none'";
	$menu_toggle = 'rep-on';
?>

	<section class="dashboard-hm">
		
	<!-- FOR USERS -->
	<?php if ($userLevel === 'Employee'): ?>	
        <div class="info-panels">
            <a href="index.php?page=report_gen&report=crop" class="panel">
				<h1> Crop Yield</h1>
				<i class="fa-solid fa-wheat-awn"></i>
			</a>
			
			<a href="index.php?page=report_gen&report=schedule" class="panel">
				<h1> Schedule</h1>
				<i class="fa-solid fa-warehouse"></i>
			</a>
        </div>
		
		<div class="info-panels">
			<a href="index.php?page=report_gen&report=payslip" class="panel">
				<h1> Payslip</h1>
				<i class="fa-solid fa-credit-card"></i>
			</a>

        </div>		
	<?php endif; ?>
		
	<!-- FOR ADMIN -->
	<?php if ($userLevel === 'Admin'): ?>	
        <div class="info-panels">

			<a href="#" class="panel">
				<h1> Maintenance Report</h1>
				<i class="fa-solid fa-screwdriver-wrench"></i>
			</a>
			
			<a href="index.php?page=report_gen&report=crop" class="panel">
				<h1> Crop Yield</h1>
				<i class="fa-solid fa-wheat-awn"></i>
			</a>
					
			<a href="#" class="panel">
				<h1> Field Allocation </h1>
				<i class="fa-solid fa-warehouse"></i>
			</a>			
        </div>
		
		<div class="info-panels">
			<a href="#" class="panel">
				<h1> Compensation </h1>
				<i class="fa-solid fa-credit-card"></i>
			</a>
			
			<a href="#" class="panel">
				<h1> Payout Monitoring </h1>
				<i class="fa-solid fa-money-bill-transfer"></i>
			</a>
			
			<a href="#" class="panel">
				<h1> Financial Monitoring </h1>
				<i class="fa-solid fa-coins"></i>
			</a>			

        </div>		
	<?php endif; ?>		
		
    </section>
