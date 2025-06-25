<?php
// Handle form submission for both create and update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $equipment_nm = $_POST['equipment_nm'];
    $model = $_POST['model'];
    $manufacturer = $_POST['manufacturer'];
    $purchase_dt = $_POST['purchase_dt'];
    $warranty_end = $_POST['warranty_end'];
    $field_id = $_POST['field_id']; // Foreign key to field table

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `equipment` (equipment_nm, model, manufacturer, purchase_dt, warranty_end, field_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $equipment_nm, $model, $manufacturer, $purchase_dt, $warranty_end, $field_id);

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
        $sql = "UPDATE `equipment` SET equipment_nm = ?, model = ?, manufacturer = ?, purchase_dt = ?, warranty_end = ?, field_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssssiii', $equipment_nm, $model, $manufacturer, $purchase_dt, $warranty_end, $field_id, $id);

        if ($stmt->execute()) {
            // Redirect to avoid duplicate form submission
            header("Location: index.php?page=update&txn=$txn&id=$id&success=Record updated successfully.");
            exit; // Stop execution after redirect
        } else {
            $error = "Failed to update record.";
        }
    }
}

// Fetch all available fields for the field dropdown
$fields_sql = "SELECT id, field_nm FROM `field`";
$fields_result = $conn->query($fields_sql);
$fields = [];
if ($fields_result->num_rows > 0) {
    while ($row = $fields_result->fetch_assoc()) {
        $fields[] = $row;
    }
}
?>

<div class="panel-med">
    <div class="header">
        <h2> <?= ucfirst($mode) ?> equipment record </h2>
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
                <h2>ID: <?= htmlspecialchars($data['id']) ?> </h2>
            <?php endif; ?>

            <!-- Equipment Name -->
            <label for="equipment_nm">Equipment Name</label>
            <input type="text" class="input-field" id="equipment_nm" name="equipment_nm" value="<?= $is_update ? htmlspecialchars($data['equipment_nm']) : '' ?>" required>
            <br>

            <!-- Model -->
            <label for="model">Model</label>
            <input type="text" class="input-field" id="model" name="model" value="<?= $is_update ? htmlspecialchars($data['model']) : '' ?>" required>
            <br>

            <!-- Manufacturer -->
            <label for="manufacturer">Manufacturer</label>
            <input type="text" class="input-field" id="manufacturer" name="manufacturer" value="<?= $is_update ? htmlspecialchars($data['manufacturer']) : '' ?>" required>
            <br>

            <!-- Purchase Date -->
            <label for="purchase_dt">Purchase Date</label>
            <input type="date" class="input-field" id="purchase_dt" name="purchase_dt" value="<?= $is_update ? htmlspecialchars($data['purchase_dt']) : '' ?>" required>
            <br>

            <!-- Warranty End -->
            <label for="warranty_end">Warranty End Date</label>
            <input type="date" class="input-field" id="warranty_end" name="warranty_end" value="<?= $is_update ? htmlspecialchars($data['warranty_end']) : '' ?>" required>
            <br>

            <!-- Field Dropdown (Foreign Key) -->
            <label for="field_id">Location</label>
            <select id="field_id" name="field_id" class="input-field" required>
                <option value="">Select a Field</option>
                <?php foreach ($fields as $field): ?>
                    <option value="<?= $field['id'] ?>" <?= ($is_update && $data['field_id'] == $field['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($field['field_nm']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br> <br>

            <button type="submit" class="btn btn-green" value="Save Record"><?= ucfirst($mode) ?> Record</button>
            <a class="btn btn-red-outline" href="index.php?page=read&txn=<?php echo $txn?>">Cancel</a>
        </form>
        <?php endif; ?>
    </div>
</div>
