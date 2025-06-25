<?php

	$tab_tog = "info-on";
	include 'includes/profile_header.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
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
            header("Location: index.php?page=profile_info&success=Personal info updated successfully.");
            exit;
        } else {
            $error = "Failed to update personal info: " . $conn->error;
        }
}
?>

<section class="profile dashboard-hm">
    <div class="panel-med">
            <div class="header">
                <h2>Personal Info</h2>
            </div>
		
            <div class="login-box">
                <form action="index.php?page=profile_info" method="POST">
                    <!-- Pre-populate fields with user data -->
					<input type="hidden" name="id" value="<?php echo isset($data['id']) ? htmlspecialchars($data['id']) : ''; ?>">
                    <input type="text" name="first_nm" placeholder="First Name" class="input-field" value="<?php echo isset($data['first_nm']) ? htmlspecialchars($data['first_nm']) : ''; ?>" readonly>
                    <input type="text" name="last_nm" placeholder="Last Name" class="input-field" value="<?php echo isset($data['last_nm']) ? htmlspecialchars($data['last_nm']) : ''; ?>" readonly>

                    <div class="birthday-group">
						<!-- Populate the birth month -->
						<select name="birth_month" class="birthday-dropdown" readonly>
							<option value="">Month</option>
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
						<input type="number" name="birth_day" placeholder="Day" class="birthday-input" value="<?php echo isset($data['birthdate']) ? date('d', strtotime($data['birthdate'])) : ''; ?>" min="1" max="31" readonly>

						<!-- Populate the birth year -->
						<input type="number" name="birth_year" placeholder="Year" class="birthday-input" value="<?php echo isset($data['birthdate']) ? date('Y', strtotime($data['birthdate'])) : ''; ?>" min="1900" max="2024" readonly>

                    </div>

                    <!-- Populate address and phone number -->
                    <input type="text" name="address" placeholder="Address" class="input-field" value="<?php echo isset($data['address']) ? htmlspecialchars($data['address']) : ''; ?>" readonly>
                    <input type="text" name="phone_num" placeholder="Phone Number" class="input-field" value="<?php echo isset($data['phone_num']) ? htmlspecialchars($data['phone_num']) : ''; ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-field" value="<?php echo isset($data['email']) ? htmlspecialchars($data['email']) : ''; ?>" required>

                    <button type="submit" class="btn btn-green">Save Infro</button>
                </form>
            </div>
    </div>
</section>