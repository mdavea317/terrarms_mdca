<?php

	$title = "YOUR PROFILE | ";
	$section1_if_active = "style='display:none'";
	$breadc_if_active = "style='display:none'";
	$menu_toggle = "prof-on";


	include 'includes/db.php';



// Fetch the record data for the given ID if in update mode
if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];  // Assuming you store user ID in session after login

    $sql = "SELECT * FROM employee WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $id); // Bind the ID to the prepared statement
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc(); // Store the existing data for pre-populating form
        } else {
            $error = "Record not found.";
        }
    } else {
        $error = "Failed to prepare SQL statement.";
    }
}


// Check for GET parameters to set error or success messages
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']); // Sanitize GET parameter
}

if (isset($_GET['success'])) {
    $success = htmlspecialchars($_GET['success']); // Sanitize GET parameter
}


?>

	<section class="profile-card">
		
		<div class="profile-banner"></div>
		<div class="profile-content">
			<div class="profile-avatar">
				<img src="http://localhost/terrarms/wp-themes/img/avatar_default.png" alt="Profile Picture">
			</div>
			<div class="profile-info">
				<h1><?php echo htmlspecialchars(ucwords(strtolower($_SESSION['first_nm'])))." ".htmlspecialchars(ucwords(strtolower($_SESSION['last_nm'])))?></h1>
				<p><?php echo $_SESSION['user_lvl']?></p>
			</div>
			<a href="logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>&nbsp;Log-out</a>
		</div>
	</section>
	


	<section class="profile-prompt">
			<!-- Display Error Message -->
			<?php if (!empty($error)): ?>
				<p class="prompt error"><?php echo htmlspecialchars($error); ?></p>
			<?php endif; ?>

			<!-- Display Success Message -->
			<?php if (!empty($success)): ?>
				<p class="prompt success"><?php echo htmlspecialchars($success); ?></p>
			<?php endif; ?>
	</section>

	<section class="breadcrumbs-cont"> <!--for convert into php-->
		<div class="tab">
			<a class="tablinks <?php if ($tab_tog == 'info-on') {echo "active";} else {echo "";}?>" href="index.php?page=profile_info">Personal Information</a>
			<a class="tablinks <?php if ($tab_tog == 'login-on') {echo "active";} else {echo "";}?>" href="index.php?page=profile_login">Change Log-in Credentials</a>
		</div>
	</section>

