<?php

include 'includes/db.php';
include 'includes/mapping.php';

// Initialize the error and success messages
$error = '';
$success = '';

$section1_if_active = "style='display:none'";
$breadc_if_active = "style='display:none'";
$title = "DELETE RECORD | ";

if (isset($_GET['id']) && isset($_GET['txn'])) {
    $id = $_GET['id'];  // Get the ID from the URL
    $txn = $_GET['txn'];  // Get the transaction type from the URL

    // Fetch the correct table from the mapping array
    $table = $transactions[$txn]; // Assuming $table_mapping exists in includes/mapping.php
} else {
    // Handle the error if id or txn is not provided in the URL
    $error = " ";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $txn = $_POST['txn'];  // Get txn from POST as well
    $table = $transactions[$txn];  // Ensure correct table is used

    // SQL query to delete the record
    $sql = "DELETE FROM $table WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id); // Bind the ID to the query

    if ($stmt->execute()) {
        // Record successfully deleted
        $success = "Record deleted successfully.";
        header("Location: index.php?page=delete&txn=$txn&success=Record delete successfully.");
    } else {
        // Deletion failed
        $error = "Failed to update record. Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<section class="delete">
    <div class="container">
        <div class="content">

            <!-- Display error or success message -->
			<?php if ($error): ?>
				<p style="color:red;"><?= htmlspecialchars($error) ?></p>
			<?php endif; ?>

			<?php if (isset($_GET['success'])): ?>
				<p style="color:green;"><?= htmlspecialchars($_GET['success']) ?></p>
				<a href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>" class="btn btn-primary">View Records</a>
            <?php else: ?>
                <h1 class="warning-icon"><i class="fa-solid fa-triangle-exclamation"></i></h1> <!-- Warning symbol -->
                <h2>Delete Item?</h2>
                <p>Are you sure you want to delete this item?</p>
                <p><strong>You can’t undo this action</strong></p>
                <div class="warning-text">
                   Deleting this item will also remove any related data.
                </div>

                <!-- Deletion form -->
                <form method="POST" action="index.php?page=delete&txn=<?= htmlspecialchars($txn) ?>&id=<?= htmlspecialchars($id) ?>">
                    <!-- Hidden inputs to pass values -->
                    <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
                    <input type="hidden" name="txn" value="<?= htmlspecialchars($txn) ?>">

                    <div class="actions">
                        <a href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>" class="btn btn-grey">Cancel</a>
                        <button type="submit" class="btn btn-red-outline"><i class="fa-solid fa-trash"></i> Delete</button> <!-- Trigger PHP deletion -->
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>
</section>

