<?php include 'includes/header.php';?>



<div class="login">
    <section class="login-container">
		<div class="login-box">
			<img src="wp-themes/img/terrarms_logo.png" alt="Terra RMS Logo" class="logo">
			<h1> Forgot Password? </h1>
			
			<?php if (!empty($error)): ?>
				<p class="error"><?php echo htmlspecialchars($error); ?></p>
			<?php endif; ?>			
			
			<!-- Step 1: Phone Verification -->
			<form id="send-code-form" method="POST">
				<input type="text" id="phone_num" name="phone_num" placeholder="Mobile Number (e.g., +639876543210)" class="input-field" required>
				<button type="button" class="login-btn" onclick="sendVerificationCode()">Send Verification Code</button>
			</form>

			<form id="verify-code-form" method="POST" style="display: none;">
				<input type="text" id="verification_code" name="verification_code" placeholder="Enter Verification Code" class="input-field" required>
				<button type="button" class="login-btn" onclick="verifyCode()">Verify Code</button>
			</form>

			<!-- Step 2: Reset Password -->
			<form id="reset-password-form" action="reset-pw.php" method="POST" style="display: none;">
				<input type="hidden" id="verified_phone_num" name="phone_num">
				<input type="email" name="email" placeholder="Email Address" class="input-field" required>
				<input type="text" name="username" placeholder="Username" class="input-field" required>
				<div class="birthday-group">
					<select name="month" class="birthday-dropdown" required>
						<option value="" disabled selected>Month</option>
						<!-- Month options -->
						<option value="January">January</option>
						<option value="February">February</option>
						<option value="March">March</option>
						<option value="April">April</option>
						<option value="May">May</option>
						<option value="June">June</option>
						<option value="July">July</option>
						<option value="August">August</option>
						<option value="September">September</option>
						<option value="October">October</option>
						<option value="November">November</option>
						<option value="December">December</option>
					</select>
					<input type="number" name="day" placeholder="Day" class="birthday-input" min="1" max="31" required>
					<input type="number" name="year" placeholder="Year" class="birthday-input" min="1900" max="2024" required>
				</div>			
				<input type="password" name="new_password" placeholder="New Password" class="input-field" required>
				<input type="password" name="confirm_password" placeholder="Confirm Password" class="input-field" required>							
				<button type="submit" class="login-btn">Reset Password</button>
			</form>
			<div class="links">
				<a href="login.php">Remember your password? Log-in</a>
			</div>
		</div>

    </section>
</div>


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
            document.getElementById('send-code-form').style.display = 'none';
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
            document.getElementById('reset-password-form').style.display = 'block';
            document.getElementById('verified_phone_num').value = phoneNum;
        } else {
            alert('Verification failed: ' + result.error);
        }
    }
</script>

<?php include 'includes/footer.php'; ?>
