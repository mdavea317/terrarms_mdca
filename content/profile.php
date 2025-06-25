<?php
	ob_start();

	$title = "YOUR PROFILE | ";
	$section1_if_active = "style='display:none'";
	$breadc_if_active = "style='display:none'";
	$menu_toggle = "prof-on";


	include 'includes/db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['transaction']) && $_GET['transaction'] === 'update_personal_info') {
        // Handle personal info update
        $first_nm = $_POST['first_nm'];
        $last_nm = $_POST['last_nm'];
        $birth_month = $_POST['birth_month'];
        $birth_day = $_POST['birth_day'];
        $birth_year = $_POST['birth_year'];
        $birthdate = "$birth_year-$birth_month-$birth_day";
        $address = $_POST['address'];
        $phone_num = $_POST['phone_num'];
        $email = $_POST['email'];
        $id = $_POST['id']; // Assuming ID is passed to identify user

        // Validate date
        if (checkdate((int)$birth_month, (int)$birth_day, (int)$birth_year)) {
            // Constructing birthdate in YYYY-MM-DD format
            $birthdate = "$birth_year-$birth_month-$birth_day";
        } else {
            echo "Invalid date provided.";
            exit; // Stop further processing
        }		
		
		
        $sql = "UPDATE `employee` SET 
                    first_nm = '$first_nm', 
                    last_nm = '$last_nm', 
                    birthdate = '$birthdate', 
                    address = '$address', 
                    phone_num = '$phone_num', 
                    email = '$email' 
                WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
			ob_clean();
            header("Location: index.php?page=profile&success=Personal info updated successfully.");
            exit;
        } else {
            $error = "Failed to update personal info: " . $conn->error;
        }
    } elseif (isset($_GET['transaction']) && $_GET['transaction'] === 'update_login_credentials') {
        // Handle login credentials update
        $username = $_POST['username'];
        $current_password = $_POST['current_password'];
        $new_password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $id = $_SESSION['user_id']; // Assuming user ID is stored in session

        // Fetch current password from the database
        $sql = "SELECT password FROM employee WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $db_password = $row['password'];

            // Verify if the current password matches the one in the database
            if ($current_password === $db_password) {
                // Check if new password and confirm password match
                if ($new_password === $confirm_password) {
                    // Update the username and password (since no hashing is used)
                    $sql_update = "UPDATE `employee` SET 
                                    username = ?, 
                                    password = ? 
                                    WHERE id = ?";
                    $stmt_update = $conn->prepare($sql_update);
                    $stmt_update->bind_param('ssi', $username, $new_password, $id);

                    if ($stmt_update->execute()) {
                        // Success
						ob_clean();
                        header("Location: index.php?page=profile&success=Login credentials updated successfully.");
                        exit;
                    } else {
                        $error = "Failed to update login credentials: " . $conn->error;
                    }
                } else {
                    $error = "New passwords do not match.";
                }
            } else {
                $error = "Current password is incorrect.";
            }
        } else {
            $error = "User not found.";
        }
    }
}


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
	
	<section class="breadcrumbs-cont"> <!--for convert into php-->
		<div class="tab">
		  <button class="tablinks" onclick="openCity(event, 'personal_info')" id="defaultOpen">Personal Information</button>
		  <button class="tablinks" onclick="openCity(event, 'log_in')">Change Log-in Credentials</button>
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

<section class="profile dashboard-hm">
    <div class="panel-med">
        <!-- Personal Info Form -->
        <div id="personal_info" class="tabcontent">
            <div class="header">
                <h2>Personal Info</h2>
            </div>

			
	
            <div class="login-box">
                <form action="index.php?page=profile&transaction=update_personal_info" method="POST">
                    <!-- Pre-populate fields with user data -->
					<input type="hidden" name="id" value="<?php echo isset($data['id']) ? htmlspecialchars($data['id']) : ''; ?>">
                    <input type="text" name="first_nm" placeholder="First Name" class="input-field" value="<?php echo isset($data['first_nm']) ? htmlspecialchars($data['first_nm']) : ''; ?>" required>
                    <input type="text" name="last_nm" placeholder="Last Name" class="input-field" value="<?php echo isset($data['last_nm']) ? htmlspecialchars($data['last_nm']) : ''; ?>" required>

                    <div class="birthday-group">
						<!-- Populate the birth month -->
						<select name="birth_month" class="birthday-dropdown" required>
							<option value="" disabled>Month</option>
							<?php
								$months = array(
									'01' => 'January', '02' => 'February', '03' => 'March',
									'04' => 'April', '05' => 'May', '06' => 'June',
									'07' => 'July', '08' => 'August', '09' => 'September',
									'10' => 'October', '11' => 'November', '12' => 'December'
								);
								$selected_month = isset($data['birthdate']) ? date('m', strtotime($data['birthdate'])) : '';
								foreach ($months as $month_num => $month_name) {
									echo "<option value='$month_num' " . ($selected_month == $month_num ? 'selected' : '') . ">$month_name</option>";

								}
							?>
						</select>

						<!-- Populate the birth day -->
						<input type="number" name="birth_day" placeholder="Day" class="birthday-input" value="<?php echo isset($data['birthdate']) ? date('d', strtotime($data['birthdate'])) : ''; ?>" min="1" max="31" required>

						<!-- Populate the birth year -->
						<input type="number" name="birth_year" placeholder="Year" class="birthday-input" value="<?php echo isset($data['birthdate']) ? date('Y', strtotime($data['birthdate'])) : ''; ?>" min="1900" max="2024" required>

                    </div>

                    <!-- Populate address and phone number -->
                    <input type="text" name="address" placeholder="Address" class="input-field" value="<?php echo isset($data['address']) ? htmlspecialchars($data['address']) : ''; ?>" required>
                    <input type="text" name="phone_num" placeholder="Phone Number" class="input-field" value="<?php echo isset($data['phone_num']) ? htmlspecialchars($data['phone_num']) : ''; ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-field" value="<?php echo isset($data['email']) ? htmlspecialchars($data['email']) : ''; ?>" required>

                    <button type="submit" class="btn btn-green">Save</button>
                </form>
            </div>
        </div>

        <!-- Login Credentials Form -->
        <div id="log_in" class="tabcontent">
            <div class="header">
                <h2>Log-in Credentials</h2>
            </div>

            <div class="login-box">
                <form action="index.php?page=profile&transaction=update_login_credentials" method="POST">
                    <!-- Populate username field -->
                    <input type="text" name="username" placeholder="Username" class="input-field" value="<?php echo isset($data['username']) ? htmlspecialchars($data['username']) : ''; ?>" required>

					<!-- Current password field -->
                    <input type="password" name="current_password" placeholder="Current Password" class="input-field" required>

					
                    <!-- New password fields -->
                    <input type="password" name="password" placeholder="New Password" class="input-field" required>
                    <input type="password" name="confirm_password" placeholder="Confirm New Password" class="input-field" required>

                    <button type="submit" class="btn btn-green">Save Credentials</button>
                </form>
            </div>
        </div>
    </div>
</section>


<script>
	function openCity(evt, cityName) {
	  var i, tabcontent, tablinks;
	  tabcontent = document.getElementsByClassName("tabcontent");
	  for (i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = "none";
	  }
	  tablinks = document.getElementsByClassName("tablinks");
	  for (i = 0; i < tablinks.length; i++) {
		tablinks[i].className = tablinks[i].className.replace(" active", "");
	  }
	  document.getElementById(cityName).style.display = "block";
	  evt.currentTarget.className += " active";
	}

	// Get the element with id="defaultOpen" and click on it
	document.getElementById("defaultOpen").click();
</script>

<?php ob_end_flush();  ?>