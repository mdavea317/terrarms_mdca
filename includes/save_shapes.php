<?php
include '../includes/db.php'; // Assuming this includes the database connection

// Get the data sent via POST (and `php://input` for JSON)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['shapes'])) {
        // Decode the JSON shape data (coordinates)
        $shapes = json_decode($_POST['shapes'], true);

        // Assuming the form data contains an ID of the field (this links the shape to the field)
        $field_id = isset($_POST['field_id']) ? $_POST['field_id'] : '';

        // Loop through the shapes and save each one
        foreach ($shapes as $shape) {
            if ($shape['type'] == 'polygon') {
                // Convert the coordinates to a JSON string
                $coordinates = json_encode($shape['path']);

                // Prepare the SQL insert query
                $sql = "INSERT INTO field_shapes (field_id, shape_type, shape_data)
                        VALUES (?, 'polygon', ?)";

                if ($stmt = $conn->prepare($sql)) {
                    // Bind parameters and execute the insert
                    $stmt->bind_param("is", $field_id, $coordinates);
                    if ($stmt->execute()) {
                        echo "Shape saved successfully!";
                    } else {
                        echo "Error saving shape: " . $stmt->error;
                    }
                    $stmt->close();
                } else {
                    echo "Error preparing statement: " . $conn->error;
                }
            }
        }
    } else {
        echo "No shape data received!";
    }
}

// Close the connection
$conn->close();
?>
