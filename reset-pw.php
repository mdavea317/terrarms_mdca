<?php
include 'includes/db.php'; // Include your database connection
session_start(); // Start the session

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the input values from the form
    $phone_num = $_POST['phone_num'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the new password and confirm password match
    if ($new_password !== $confirm_password) {
        die("Passwords do not match!");
    }

    // Prepare a SQL statement to verify user identity
    $stmt = $conn->prepare("SELECT id FROM employee WHERE username = ? AND email = ? AND phone_num = ?");
    $stmt->bind_param("sss", $username, $email, $phone_num);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows > 0) {
        // User exists, update the password
        // Here we are not hashing the password
        // Directly assigning the new password
        $password_to_store = $new_password; // Direct assignment

        // Retrieve user ID
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Update password in the database
        $update_stmt = $conn->prepare("UPDATE employee SET password = ? WHERE id = ?");
        $update_stmt->bind_param("si", $password_to_store, $user_id);
        
        if ($update_stmt->execute()) {
            echo "Password updated successfully!";
            // Optionally redirect to the login page
            header("Location: login.php?success=Password updated successfully!");
            exit();
        } else {
            echo "Error updating password!";
        }
        $update_stmt->close();
    } else {
        echo "Invalid details provided!";
    }
    $stmt->close();
}
?>
