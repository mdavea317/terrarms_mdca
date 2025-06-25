<?php include 'includes/header.php';?>

<div class="login">
    <section class="login-container">
        <div class="signup-box">
            <img src="wp-themes/img/terrarms_logo.png" alt="Terra RMS Logo" class="logo">
            <h1>Create New Account</h1>
            <form class="signup-form">
                <div class="form-group">
                    <input type="text" placeholder="First Name" class="input-field" required>
                    <input type="text" placeholder="Last Name" class="input-field" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Mobile Number" class="input-field" required>
                    <input type="email" placeholder="Email Address" class="input-field" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Username" class="input-field" required>
                    <input type="password" placeholder="Password" class="input-field" required>
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Position" class="input-field" required>
                    <select class="input-field" required>
                        <option value="" disabled selected>Access Level</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="form-group">
					<select class="birthday-dropdown" required>
                        <option value="" disabled selected>Month</option>
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
                    <input type="number" placeholder="Day" class="birthday-input" min="1" max="31" required>
                    <input type="number" placeholder="Year" class="birthday-input" min="1900" max="2024" required>
                </div>

                <button type="submit" class="login-btn">Sign Up</button>
            </form>
            <div class="links">
                <a href="login.php">Already have an account? Log-in</a>
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>
