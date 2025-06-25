<?php

// Initialize variables for form display and submission handling
$mode = isset($mode) ? $mode : 'create'; // Default mode is 'create' if not set
$is_update = ($mode === 'update');
$error = '';
$success = '';
$data = [];
$txn = isset($_GET['txn']) ? $_GET['txn'] : ''; // Get transaction type from URL or preset

// If in update mode, fetch the record data for the given ID
if ($is_update && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM $txn WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc(); // Store the existing data for pre-populating form
    } else {
        $error = "Record not found.";
    }
}

// Handle form submission for both create and update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $category = $_POST['category'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $ideal_qty = $_POST['ideal_qty'];

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO $txn (category, item_name, description, unit, price, ideal_qty) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssdii', $category, $item_name, $description, $unit, $price, $ideal_qty);

        if ($stmt->execute()) {
            // Redirect to avoid duplicate form submission
            header("Location: index.php?page=create&txn=$txn&success=Record created successfully.");
            exit; // Stop execution after redirect
        } else {
            $error = "Failed to create record.";
        }
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE $txn SET category = ?, item_name = ?, description = ?, unit = ?, price = ?, ideal_qty = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssdiii', $category, $item_name, $description, $unit, $price, $ideal_qty, $id);

        if ($stmt->execute()) {
            // Redirect to avoid duplicate form submission
            header("Location: index.php?page=update&txn=$txn&id=$id&success=Record updated successfully.");
            exit; // Stop execution after redirect
        } else {
            $error = "Failed to update record.";
        }
    }
}
?>

	<div class="panel-med">
		<div class="header">
			<h2> <?= ucfirst($mode) ?> item record </h2>
		</div>
		
		<div class="form-box">
      	  	<?php if ($error): ?>
            <h2 style="color:red;"><?= htmlspecialchars($error) ?></h2>
       	 	<?php endif; ?>

        	<?php if (isset($_GET['success'])): ?>
            <h2 style="color:green;"><?= htmlspecialchars($_GET['success']) ?> </h2> <br>
            <a href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>" class="btn btn-green">View Records</a>
       	 	<?php else: ?>
			
            <!-- The form for create/update -->
            <form action="" method="post">
                <input type="hidden" name="mode" value="<?= $mode ?>">
                <input type="hidden" name="txn" value="<?= htmlspecialchars($txn) ?>">
                <?php if ($is_update): ?>
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
				<h2>ID: <?php echo $data['id'] ?> </h2>
                <?php endif; ?>

				<label for="category">Category</label>
				<select id="category" name="category" class="input-field" required>
					<option value="">Select</option>
					<option value="Supplies" <?= ($is_update && $data['category'] == 'Supplies') ? 'selected' : '' ?>>Supplies</option>
					<option value="Fertilizer" <?= ($is_update && $data['category'] == 'Fertilizer') ? 'selected' : '' ?>>Fertilizer</option>
					<option value="Equipment" <?= ($is_update && $data['category'] == 'Equipment') ? 'selected' : '' ?>>Equipment</option>
					<option value="Livestock" <?= ($is_update && $data['category'] == 'Livestock') ? 'selected' : '' ?>>Livestock</option>
				</select>
				<br>

				<label for="item_name">Item Name</label>
                <input type="text" class="input-field" id="item_name" name="item_name" value="<?= $is_update ? htmlspecialchars($data['item_name']) : '' ?>" required>
				<br>

                <label for="description">Description</label>
                <textarea class="input-field" id="description" name="description" required><?= $is_update ? htmlspecialchars($data['description']) : '' ?></textarea>
				<br>

				<label for="unit">Unit</label>
                <input type="text" class="input-field" id="unit" name="unit" value="<?= $is_update ? htmlspecialchars($data['unit']) : '' ?>" required>
				<br>

                <label for="price">Price</label>
                <input type="number" class="input-field" step="0.01" id="price" name="price" value="<?= $is_update ? htmlspecialchars($data['price']) : '' ?>" required>
				<br>

				<label for="ideal_qty">Ideal Quantity</label>
                <input type="number" class="input-field" step="0.01" id="ideal_qty" name="ideal_qty" value="<?= $is_update ? htmlspecialchars($data['ideal_qty']) : '' ?>" required>
				<br>
                

                <button type="submit" class="btn btn-green" value="Save Record"><?= ucfirst($mode) ?> Record</button>
                <a class="btn btn-red-outline" href="index.php?page=read&txn=items">Cancel</a>
            </form>
        <?php endif; ?>

		</div>
</div>
