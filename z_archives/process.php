<?php
	include 'includes/db.php';
	include 'includes/mapping.php'; // Include your database connection

// Get the mode (create/update) and the transaction type
$mode = $_POST['mode'];
$txn = $_POST['txn'];

if ($mode === 'create') {
    // Insert new record
    $sql = "INSERT INTO $txn (category, item_name, description, unit, price, ideal_qty) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssdii', $_POST['category'], $_POST['item_name'], $_POST['description'], $_POST['unit'], $_POST['price'], $_POST['ideal_qty']);

    if ($stmt->execute()) {
        header("Location: read.php?txn=$txn&action=create&status=success");
        exit;
    } else {
        header("Location: read.php?txn=$txn&action=create&status=error");
        exit;
    }
} elseif ($mode === 'update') {
    // Update existing record
    $id = $_POST['id'];
    $sql = "UPDATE $txn SET category = ?, item_name = ?, description = ?, unit = ?, price = ?, ideal_qty = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssdiii', $_POST['category'], $_POST['item_name'], $_POST['description'], $_POST['unit'], $_POST['price'], $_POST['ideal_qty'], $id);

    if ($stmt->execute()) {
        header("Location: read.php?txn=$txn&action=update&status=success");
        exit;
    } else {
        header("Location: read.php?txn=$txn&action=update&status=error");
        exit;
    }
}
?>
