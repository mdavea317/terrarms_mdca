<?php
// Handle form submission for both create and update in `crop_log`
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $crop_id = $_POST['crop_id'];
    $record_type = 'fertilizer'; // Set to fertilizer
    $dt_applied = $_POST['dt_applied'];
    $fertilizer_type = $_POST['fertilizer_type']; // Changed from treatment to fertilizer_type
    $notes = $_POST['notes'];

    if ($mode === 'create') {
        // Insert new crop log record
        $sql = "INSERT INTO `crop_log` (crop_id, record_type, dt_applied, fertilizer_type, notes) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issss', $crop_id, $record_type, $dt_applied, $fertilizer_type, $notes);

        if ($stmt->execute()) {
            header("Location: index.php?page=create&success=Crop log created successfully.");
            exit;
        } else {
            $error = "Failed to create crop log.";
        }
    } elseif ($mode === 'update') {
        // Update existing crop log record
        $id = $_POST['id'];
        $sql = "UPDATE `crop_log` SET crop_id = ?, record_type = ?, dt_applied = ?, fertilizer_type = ?, notes = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('issssi', $crop_id, $record_type, $dt_applied, $fertilizer_type, $notes, $id);

        if ($stmt->execute()) {
            header("Location: index.php?page=update&id=$id&success=Crop log updated successfully.");
            exit;
        } else {
            $error = "Failed to update crop log.";
        }
    }
}

// Fetch all available crops for the crop dropdown
$crop_sql = "SELECT id, crop_nm FROM `crop`"; // Fetching crop names from the crop table
$crop_result = $conn->query($crop_sql);
$crops = [];
if ($crop_result->num_rows > 0) {
    while ($row = $crop_result->fetch_assoc()) {
        $crops[] = $row;
    }
}
?>


<div class="panel-med">
    <div class="header">
        <h2><?= ucfirst($mode) ?> fertilizer record</h2>
    </div>

    <div class="form-box">
        <?php if ($error): ?>
            <h2 style="color:red;"><?= htmlspecialchars($error) ?></h2>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <h2 style="color:green;"><?= htmlspecialchars($success) ?></h2> <br>
            <a href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>" class="btn btn-green">View Logs</a>
        <?php else: ?>

        <!-- The form for create/update -->
        <form action="" method="post">
            <input type="hidden" name="mode" value="<?= $mode ?>">
            <input type="hidden" name="txn" value="<?= htmlspecialchars($txn) ?>">

            <?php if ($is_update): ?>
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <h2>ID: <?= htmlspecialchars($data['id']) ?></h2>
            <?php endif; ?>

            <!-- Crop Dropdown -->
            <label for="crop_id">Crop</label>
            <select id="crop_id" name="crop_id" class="input-field" required>
                <option value="">Select Crop</option>
                <?php foreach ($crops as $crop): ?>
                    <option value="<?= $crop['id'] ?>" <?= ($is_update && $data['crop_id'] == $crop['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($crop['crop_nm']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <!-- Record Type (Hidden as it's always fertilizer) -->
            <input type="hidden" name="record_type" value="fertilizer">
            
            <!-- Date Applied -->
            <label for="dt_applied">Date Applied</label>
            <input type="date" class="input-field" id="dt_applied" name="dt_applied" value="<?= $is_update ? htmlspecialchars($data['dt_applied']) : '' ?>" required>
            <br>

            <!-- Fertilizer Type -->
            <label for="fertilizer_type">Fertilizer Type</label>
            <input type="text" class="input-field" id="fertilizer_type" name="fertilizer_type" value="<?= $is_update ? htmlspecialchars($data['fertilizer_type']) : '' ?>" required>
            <br>

            <!-- Notes -->
            <label for="notes">Notes</label>
            <textarea class="input-field" id="notes" name="notes" required><?= $is_update ? htmlspecialchars($data['notes']) : '' ?></textarea>
            <br>

            <button type="submit" class="btn btn-green" value="Save Log"><?= ucfirst($mode) ?> Log</button>
            <a class="btn btn-red-outline" href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>">Cancel</a> <!-- Revised cancel button link -->
        </form>
        <?php endif; ?>
    </div>
</div>

<div class="panel-med"></div>