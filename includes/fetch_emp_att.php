<?php

header('Content-Type: application/json');

	include '../includes/db.php';


// Fetch employee names and IDs from the database
$sql = "SELECT id, CONCAT(last_nm, '_', first_nm) AS employee_name FROM employee";
$result = $conn->query($sql);

// Arrays to hold employee names and IDs
$names = [];
$ids = [];

// Loop through the results and store them in arrays
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $names[] = $row['employee_name'];
        $ids[] = $row['id'];
    }
}

// Close connection
$conn->close();

// Return the names and IDs as a JSON response
echo json_encode(['names' => $names, 'ids' => $ids]);
?>