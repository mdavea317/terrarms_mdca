<?php
include 'includes/db.php'; // Include database connection

// Assume you have variables for error and success messages
$error = "";  // Placeholder for the error message
$success = ""; // Placeholder for the success message

// Start session management
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Check for GET parameters to set error or success messages
if (isset($_GET['error'])) {
    $error = htmlspecialchars($_GET['error']); // Sanitize GET parameter
}

if (isset($_GET['success'])) {
    $success = htmlspecialchars($_GET['success']); // Sanitize GET parameter
}

// Check if the user is already logged in
if (isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Redirect to index if already logged in
    exit();
}

$error = ''; // Initialize an error variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, password FROM employee WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        // User exists, now retrieve the password and employee details
        $stmt->bind_result($user_id, $stored_password);
        $stmt->fetch();
        
        // Compare plain text password
        if ($password === $stored_password) {
            // Password is correct, fetch employee details
            $stmt->close(); // Close previous statement

            // Prepare a new query to fetch employee details
            $stmt = $conn->prepare("SELECT first_nm, last_nm, user_lvl FROM employee WHERE id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $stmt->bind_result($first_nm, $last_nm, $user_lvl);
            $stmt->fetch();

            // Store user information in session
            $_SESSION['user_id'] = $user_id;
            $_SESSION['first_nm'] = $first_nm;
            $_SESSION['last_nm'] = $last_nm;
			$_SESSION['user_lvl'] = $user_lvl;

            header("Location: index.php"); // Redirect to index
            exit();
        } else {
            $error = "Incorrect password."; // Incorrect password
        }
    } else {
        $error = "Username does not exist."; // Username does not exist
    }

    $stmt->close();
}
?>


<?php include_once 'includes/header.php'; ?>

<div class="login">
    <section class="login-container">
        <div class="login-box">
            <img src="wp-themes/img/terrarms_logo.png" alt="Terra RMS Logo" class="logo">
            <h1>Log-in</h1>
			
			<!-- Display Error Message -->
			<?php if (!empty($error)): ?>
				<p class="error"><?php echo htmlspecialchars($error); ?></p>
			<?php endif; ?>

			<!-- Display Success Message -->
			<?php if (!empty($success)): ?>
				<p class="success"><?php echo htmlspecialchars($success); ?></p>
			<?php endif; ?>
			
            <form action="" method="POST">
                <input type="text" name="username" placeholder="Username" class="input-field" required>
                <input type="password" name="password" placeholder="Password" class="input-field" required>
                <button type="submit" class="login-btn">Log-in</button>
            </form>
            <div class="links">
                <a href="forgot-pw.php">Forgot Password</a>
                <!--<span>|</span>
                <a href="signup.php">Create New Account</a-->
            </div>
        </div>
    </section>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    window.onload = function() {
        // Check if the URL contains a query string
        if (window.location.search.includes('success')) {
            // Remove the query string by replacing it with the URL without the search part
            history.replaceState(null, '', window.location.pathname);
        }
    }
</script>
