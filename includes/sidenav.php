<?php
$userLevel = isset($_SESSION['user_lvl']) ? $_SESSION['user_lvl'] : null;

?>

<section class="sidenav" id="sidenav">
	

	<div class="logo-box">
		<img src="wp-themes/img/terrarms_logo.png" id="logo">
	</div>

	
	
	<!-- FOR ALL -->
	<a href="index.php?page=dashboard"
	   class="menu-item <?php if ($menu_toggle == 'das-on') {echo "active";} else {echo "";}?>" >
			<i class="fa fa-dashboard"></i> My Dashboard
	</a>

	<a href="javascript:void(0)"
	   class="menu-item <?php if ($menu_toggle == 'res-on') {echo "active";} else {echo "";}?>" onclick="toggleSubnav('resource-subnav')">
		<i class="fa-solid fa-tags"></i> Resource Item
	</a>
	<div id="resource-subnav" class="subnav">
		<a href="index.php?page=read&txn=items"> Items List</a>
		<a href="index.php?page=read&txn=field">Fields</a>
	</div>

	<a href="javascript:void(0)"
	   class="menu-item <?php if ($menu_toggle == 'equ-on') {echo "active";} else {echo "";}?>" onclick="toggleSubnav('equipment-subnav')">
		<i class="fa-solid fa-tractor"></i> Equipment
	</a>
	<div id="equipment-subnav" class="subnav">
		<a href="index.php?page=read&txn=equipment">Records</a>
		<a href="index.php?page=read&txn=equipment_u">Availability</a>
		<a href="index.php?page=read&txn=equipment_m">Maintenance</a>
	</div>

	<a href="javascript:void(0)"
	   class="menu-item <?php if ($menu_toggle == 'cro-on') {echo "active";} else {echo "";}?>"
	   onclick="toggleSubnav('crops-subnav')">
		<i class="fa-solid fa-wheat-awn"></i> Crops
	</a>
	<div id="crops-subnav" class="subnav">
		<a href="index.php?page=read&txn=crop">Records</a>
		<a href="index.php?page=read&txn=crop_s">Schedule</a>
		<a href="index.php?page=read&txn=crop_p">Pest Control</a>
		<a href="index.php?page=read&txn=crop_f">Fertilization</a>
		<a href="index.php?page=read&txn=crop_h">Harvest Outcome</a>
	</div>

	<a href="javascript:void(0)"
	   class="menu-item <?php if ($menu_toggle == 'liv-on') {echo "active";} else {echo "";}?>" onclick="toggleSubnav('livestock-subnav')">
		<i class="fa-solid fa-cow"></i> Livestock
	</a>
	<div id="livestock-subnav" class="subnav">
		<a href="index.php?page=read&txn=livestock">Records</a>
		<a href="index.php?page=read&txn=livestock_v">Vaccination</a>
		<a href="index.php?page=read&txn=livestock_f">Feeding Plan</a>
	</div>	

	
	
	
	<!-- FOR USERS -->
	<?php if ($userLevel === 'Employee'): ?>
		<a href="javascript:void(0)"
		   class="menu-item <?php if ($menu_toggle == 'att-on') {echo "active";} else {echo "";}?>" onclick="toggleSubnav('attendance-subnav')">
			<i class="fa-solid fa-fingerprint"></i> Attendance
		</a>
		<div id="attendance-subnav" class="subnav">
			<a href="index.php?page=read&txn=attendance_c">Time In/Out</a>
			<a href="index.php?page=read&txn=attendance_t">Time Logs</a>
			<a href="index.php?page=read&txn=attendance_l">Leave Request</a>
			<a href="index.php?page=read&txn=attendance_p">Payroll Details</a>
			<a href="index.php?page=read&txn=attendance_s">Shift Schedule</a>
		</div>	

		<a href="javascript:void(0)"
		   class="menu-item <?php if ($menu_toggle == 'all-on') {echo "active";} else {echo "";}?>" onclick="toggleSubnav('allocate-subnav')">
			<i class="fa-solid fa-chart-pie"></i> Allocation
		</a>
		<div id="allocate-subnav" class="subnav">
			<a href="index.php?page=read&txn=allocation_c">Crop</a>
			<a href="index.php?page=read&txn=allocation_e">Equipment</a>
			<a href="index.php?page=read&txn=allocation_f">Fertilizer</a>
			<a href="index.php?page=read&txn=allocation_l">Labor</a>
		</div>	

	<?php endif; ?>
	
	
	<?php if ($userLevel === 'Admin'): ?>
		<a href="#"
		   class="menu-item <?php if ($menu_toggle == 'emp-on') {echo "active";} else {echo "";}?>"
		   onclick="toggleSubnav('employee-subnav')">
				<i class="fa-solid fa-briefcase"></i> Employee
		</a>
		<div id="employee-subnav" class="subnav">
			<a href="index.php?page=read&txn=employee">Records</a>
			<a href="index.php?page=read&txn=employee_p">Payroll</a>
			<!--a href="index.php?page=payroll_wiz">Payroll Wizard</a-->
			<a href="index.php?page=read&txn=employee_a">Attendance</a>
			<a href="index.php?page=read&txn=employee_s">Shift Schedule</a>
			<!--a href="index.php?page=read&txn=employee_t">Time Logs</a-->
			<a href="index.php?page=read&txn=employee_r">Requests</a>
		</div>	

		<a href="index.php?page=read&txn=user"
		   class="menu-item <?php if ($menu_toggle == 'user-on') {echo "active";} else {echo "";}?>" >
			<i class="fa-solid fa-user"></i> User Management
		</a>	
	
		<a href="#"
		   class="menu-item <?php if ($menu_toggle == 'fin-on') {echo "active";} else {echo "";}?>"
		   onclick="toggleSubnav('finance-subnav')">
				<i class="fa-solid fa-coins"></i> Finance
		</a>
		<div id="finance-subnav" class="subnav">
			<a href="index.php?page=read&txn=finance_b">Budget</a>
			<a href="index.php?page=read&txn=finance_e">Expense</a>
			<a href="index.php?page=read&txn=finance_r">Revenue</a>
			<a href="index.php?page=read&txn=finance_p">Profit</a>
		</div>
	
		<a href="javascript:void(0)"
		   class="menu-item <?php if ($menu_toggle == 'all-on') {echo "active";} else {echo "";}?>" onclick="toggleSubnav('allocate-subnav')">
			<i class="fa-solid fa-chart-pie"></i> Allocation
		</a>
		<div id="allocate-subnav" class="subnav">
			<a href="index.php?page=read&txn=allocation_c">Crop</a>
			<a href="index.php?page=read&txn=allocation_e">Equipment</a>
			<a href="index.php?page=read&txn=allocation_f">Fertilizer</a>
			<a href="index.php?page=read&txn=allocation_l">Labor</a>
			<a href="index.php?page=read&txn=allocation_b">Budget & Cost </a>
		</div>	


	<?php endif; ?>

		<a href="javascript:void(0)"
		   class="menu-item <?php if ($menu_toggle == 'sup-on') {echo "active";} ?>"
			onclick="toggleSubnav('supply-subnav')">
			<i class="fa-solid fa-box"></i> Supply Chain
		</a>
	
		<div id="supply-subnav" class="subnav">
			<a href="index.php?page=read&txn=purchases">Purchases Order</a>
			<a href="index.php?page=read&txn=distribution">Distribution Tracker</a>
		</div>		
	
	<a href="index.php?page=report"
	   class="menu-item <?php if ($menu_toggle == 'rep-on') {echo "active";} else {echo "";}?>" >
		<i class="fa-solid fa-file-lines"></i> Reports
	</a>
	
	<a href="index.php?page=profile_info"
	   class="menu-item <?php if ($menu_toggle == 'prof-on') {echo "active";} else {echo "";}?>" >
		<i class="fa-solid fa-user"></i> My Profile
	</a>	
	
</section>

<script>
function toggleSubnav(id) {
    var subnav = document.getElementById(id);
    var parent = subnav.previousElementSibling;

    // Close all other subnavs
    var allSubnavs = document.querySelectorAll('.subnav');
    allSubnavs.forEach(function(sn) {
        if (sn.id !== id) {
            sn.style.display = 'none';
            sn.previousElementSibling.classList.remove('active');
        }
    });

    // Toggle current subnav
    if (subnav.style.display === "block") {
        subnav.style.display = "none";
        parent.classList.remove('active');
    } else {
        subnav.style.display = "block";
        parent.classList.add('active');
    }
}
</script>


