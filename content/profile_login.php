<?php
// Check if session is already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start session only if not already started
}

$tab_tog = "login-on";
include 'includes/profile_header.php';

// Check if user_id is set in the session
if (!isset($_SESSION['user_id'])) {
    die("User not logged in.");
}

$id = $_SESSION['user_id']; // Assuming user ID is stored in session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle login credentials update
    $username = $_POST['username'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Fetch current password from the database
    $sql = "SELECT password FROM employee WHERE id = $id"; // Note: Using direct variable injection
    $result = $conn->query($sql);

    if ($result === false) {
        // SQL error
        die("SQL error: " . htmlspecialchars($conn->error));
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $db_password = $row['password'];

        // Verify if the current password matches the one in the database
        if ($current_password === $db_password) {
            // Check if new password and confirm password match
            if ($new_password === $confirm_password) {
                // Update the username and password
                $username = $conn->real_escape_string($username); // Escape username
                $new_password = $conn->real_escape_string($new_password); // Escape new password

                $sql_update = "UPDATE employee SET username = '$username', password = '$new_password' WHERE id = $id"; // Direct injection
                if ($conn->query($sql_update) === true) {
                    // Success
                    header("Location: index.php?page=profile_login&success=Login credentials updated successfully.");
                    exit;
                } else {
                    $error = "Failed to update login credentials: " . htmlspecialchars($conn->error);
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
?>

<section class="profile dashboard-hm">
    <div class="panel-med">
        <div class="header">
            <h2>Log-in Credentials</h2>
        </div>

        <div class="login-box">
			<!-- Step 1: Phone Verification -->
			<form id="verify-phone-form" method="POST">
				<input type="text" id="phone_num" name="phone_num" placeholder="Mobile Number (e.g., +639876543210)" class="input-field" required>
				<button type="button" class="btn btn-green" onclick="sendVerificationCode()">Send Verification Code</button>
			</form>

			<!-- Step 2: Verification Code -->
			<form id="verify-code-form" method="POST" style="display: none;">
				<input type="text" id="verification_code" name="verification_code" placeholder="Enter Verification Code" class="input-field" required>
				<button type="button" class="btn btn-green" onclick="verifyCode()">Verify Code</button>
			</form>

			<!-- Step 3: Change Credentials -->
			<form id="change-credentials-form" action="index.php?page=profile_login" method="POST" style="display: none;">
				<!-- Username field -->
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
</section>


<script>
    async function sendVerificationCode() {
        const phoneNum = document.getElementById('phone_num').value;
        const response = await fetch('twilio-php/send_verification.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ phone_num: phoneNum })
        });
        const result = await response.json();
        if (result.success) {
            alert('Verification code sent to your phone!');
            document.getElementById('verify-phone-form').style.display = 'none';
            document.getElementById('verify-code-form').style.display = 'block';
        } else {
            alert('Error: ' + result.error);
        }
    }

    async function verifyCode() {
        const phoneNum = document.getElementById('phone_num').value;
        const verificationCode = document.getElementById('verification_code').value;
        const response = await fetch('twilio-php/verify_code.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ phone_num: phoneNum, verification_code: verificationCode })
        });
        const result = await response.json();
        if (result.success) {
            alert('Phone number verified!');
            document.getElementById('verify-code-form').style.display = 'none';
            document.getElementById('change-credentials-form').style.display = 'block';
        } else {
            alert('Verification failed: ' + result.error);
        }
    }
</script>
