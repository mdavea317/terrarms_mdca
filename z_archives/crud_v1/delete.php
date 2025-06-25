<?php
	include 'includes/db.php'; 
	$section1_if_active = "style='display:none'";
	$breadc_if_active = "style='display:none'";
	$title = "DELETE RECORD | ";

	include 'includes/table_map.php';

$tabledb = $_GET['table']; // Get the database table name from the URL
$id = (int)$_GET['id']; // Typecast to ensure ID is an integer

// Check if the table exists in the array
if (array_key_exists($tabledb, $tablename)) {
    $dbTable = $tablename[$tabledb]['db']; // Get the actual database table name
	$nmTable = $tablename[$tabledb]['name'];

    // Check if the form is submitted (POST request)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Prepare the SQL DELETE statement
        $sql = "DELETE FROM `$dbTable` WHERE id=$id"; // Use the correct table name and ensure ID is sanitized

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            // Redirect to the read page with a status message
            header("Location: index.php?page=read&table=$nmTable&status=deleted");
            exit;
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }
} else {
    echo "Invalid table selected.";
}
?>


 <section class="delete">
    <div class="container">
        <div class="content">
            <h1 class="warning-icon"><i class="fa-solid fa-triangle-exclamation"></i></h1> <!-- Unicode warning symbol -->
            <h2>Delete Item?</h2>
            <p>Are you sure you want to delete the item?</p>
            <p><strong>You can’t undo this action</strong></p>
            <div class="warning-text">
               Deleting this item will also remove any related data.
            </div>

            <!-- Deletion form -->
            <form method="POST" action="index.php?page=delete&table=<?php echo $nmTable; ?>&id=<?php echo $id; ?>">
                <div class="actions">
                    <a href="index.php?page=read&table=<?php echo $nmTable; ?>" class="btn btn-grey">Cancel</a>
                    <button type="submit" class="btn btn-red-outline"><i class="fa-solid fa-trash"></i> Delete</button> <!-- Trigger PHP deletion -->
                </div>
            </form>
        </div>
    </div></section>