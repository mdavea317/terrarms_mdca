<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $crop_id = $_POST['crop_id'];
    $crop_nm = $_POST['crop_nm'];
    $est_yield = $_POST['est_yield'];
    $planting_dt = $_POST['planting_dt'];
    $harvest_dt = $_POST['harvest_dt'];
    $field_id = $_POST['field_id']; // Foreign key to field table

    if ($mode === 'create') {
        // Insert new crop record
        $sql = "INSERT INTO `crop` (crop_id, crop_nm, est_yield, planting_dt, harvest_dt, field_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issssi', $crop_id, $crop_nm, $est_yield, $planting_dt, $harvest_dt, $field_id);

        if ($stmt->execute()) {
            header("Location: index.php?page=create&success=Crop created successfully.");
            exit;
        } else {
            $error = "Failed to create crop.";
        }
    } elseif ($mode === 'update') {
        // Update existing crop record
        $id = $_POST['id'];
        $sql = "UPDATE `crop` SET crop_id = ?, crop_nm = ?, est_yield = ?, planting_dt = ?, harvest_dt = ?, field_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issssii', $crop_id, $crop_nm, $est_yield, $planting_dt, $harvest_dt, $field_id, $id);

        if ($stmt->execute()) {
            header("Location: index.php?page=update&id=$id&success=Crop updated successfully.");
            exit;
        } else {
            $error = "Failed to update crop.";
        }
    }
}

// Fetch all available fields for the field dropdown
$field_sql = "SELECT id, field_nm FROM `field`";
$field_result = $conn->query($field_sql);
$fields = [];
if ($field_result->num_rows > 0) {
    while ($row = $field_result->fetch_assoc()) {
        $fields[] = $row;
    }
}
?>

<div class="panel-med">
    <div class="header">
        <h2><?= ucfirst($mode) ?> crop record </h2>
    </div>

    <div class="form-box">
        <?php if ($error): ?>
            <h2 style="color:red;"><?= htmlspecialchars($error) ?></h2>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <h2 style="color:green;"><?= htmlspecialchars($_GET['success']) ?></h2> <br>
            <a href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>" class="btn btn-green">View Records</a>
		<?php else: ?>

        <!-- The form for create/update -->
        <form action="" method="post">
            <input type="hidden" name="mode" value="<?= $mode ?>">
            <input type="hidden" name="txn" value="<?= htmlspecialchars($txn) ?>">

            <?php if ($is_update): ?>
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <h2>ID: <?= htmlspecialchars($data['id']) ?></h2>
            <?php endif; ?>

            <!-- Crop Name -->
            <label for="crop_nm">Crop Name</label>
            <input type="text" class="input-field" id="crop_nm" name="crop_nm" value="<?= $is_update ? htmlspecialchars($data['crop_nm']) : '' ?>" required>
            <br>

            <!-- Estimated Yield -->
            <label for="est_yield">Estimated Yield</label>
            <input type="number" class="input-field" id="est_yield" name="est_yield" value="<?= $is_update ? htmlspecialchars($data['est_yield']) : '' ?>">
            <br>

            <!-- Planting Date -->
            <label for="planting_dt">Planting Date</label>
            <input type="date" class="input-field" id="planting_dt" name="planting_dt" value="<?= $is_update ? htmlspecialchars($data['planting_dt']) : '' ?>">
            <br>

            <!-- Harvest Date -->
            <label for="harvest_dt">Harvest Date</label>
            <input type="date" class="input-field" id="harvest_dt" name="harvest_dt" value="<?= $is_update ? htmlspecialchars($data['harvest_dt']) : '' ?>">
            <br>

            <!-- Field Dropdown -->
            <label for="field_id">Field</label>
            <select id="field_id" name="field_id" class="input-field" required>
                <option value="">Select Field</option>
                <?php foreach ($field_list as $field): ?>
                    <option value="<?= $field['id'] ?>" <?= ($is_update && $data['field_id'] == $field['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($field['field_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br> <br>

            <button type="submit" class="btn btn-green" value="Save Crop"><?= ucfirst($mode) ?> Crop</button>
            <a class="btn btn-red-outline" href="index.php?page=read&txn=<?php echo $txn?>">Cancel</a>
        </form>
        <?php endif; ?>
    </div>
</div>
