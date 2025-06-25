<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $livestock_nm = $_POST['livestock_nm'];
    $livestock_type = $_POST['livestock_type'];
    $vaccine_dt = $_POST['vaccine_dt'];
    $vaccine_type = $_POST['vaccine_type'];
    $notes = $_POST['notes'];

    if ($mode === 'create') {
        // Insert new livestock record
        $sql = "INSERT INTO `livestock` (livestock_nm, livestock_type, vaccine_dt, vaccine_type, notes) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssss', $livestock_nm, $livestock_type, $vaccine_dt, $vaccine_type, $notes);

        if ($stmt->execute()) {
            header("Location: index.php?page=create&success=Livestock created successfully.");
            exit;
        } else {
            $error = "Failed to create livestock.";
        }
    } elseif ($mode === 'update') {
        // Update existing livestock record
        $id = $_POST['id'];
        $sql = "UPDATE `livestock` SET livestock_nm = ?, livestock_type = ?, vaccine_dt = ?, vaccine_type = ?, notes = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssssi', $livestock_nm, $livestock_type, $vaccine_dt, $vaccine_type, $notes, $id);

        if ($stmt->execute()) {
            header("Location: index.php?page=update&id=$id&success=Livestock updated successfully.");
            exit;
        } else {
            $error = "Failed to update livestock.";
        }
    }
}

// Fetch all livestock types from the items table where category is 'Livestock'
$livestock_types_sql = "SELECT id, item_name FROM `items` WHERE category = 'Livestock'";
$livestock_types_result = $conn->query($livestock_types_sql);
$livestock_types = [];
if ($livestock_types_result->num_rows > 0) {
    while ($row = $livestock_types_result->fetch_assoc()) {
        $livestock_types[] = $row;
    }
}

?>

<div class="panel-med">
    <div class="header">
        <h2><?= ucfirst($mode) ?> Livestock Record</h2>
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

            <!-- Livestock Name -->
            <label for="livestock_nm">Livestock Name</label>
            <input type="text" class="input-field" id="livestock_nm" name="livestock_nm" value="<?= $is_update ? htmlspecialchars($data['livestock_nm']) : '' ?>" required>
            <br>

            <!-- Livestock Type (Dropdown from items table) -->
            <label for="livestock_type">Livestock Type</label>
            <select id="livestock_type" name="livestock_type" class="input-field" required>
                <option value="">Select Livestock Type</option>
                <?php foreach ($livestock_types as $type): ?>
                    <option value="<?= htmlspecialchars($type['item_name']) ?>" <?= ($is_update && $data['livestock_type'] == $type['item_name']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($type['item_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <!-- Vaccine Date -->
            <label for="vaccine_dt">Vaccine Date</label>
            <input type="date" class="input-field" id="vaccine_dt" name="vaccine_dt" value="<?= $is_update ? htmlspecialchars($data['vaccine_dt']) : '' ?>" required>
            <br>

            <!-- Vaccine Type -->
            <label for="vaccine_type">Vaccine Type</label>
            <input type="text" class="input-field" id="vaccine_type" name="vaccine_type" value="<?= $is_update ? htmlspecialchars($data['vaccine_type']) : '' ?>" required>
            <br>

            <!-- Notes -->
            <label for="notes">Notes</label>
            <textarea class="input-field" id="notes" name="notes" required><?= $is_update ? htmlspecialchars($data['notes']) : '' ?></textarea>
            <br>

            <button type="submit" class="btn btn-green" value="Save Livestock"><?= ucfirst($mode) ?> Livestock</button>
            <a class="btn btn-red-outline" href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>">Cancel</a>
        </form>
        <?php endif; ?>
    </div>
</div>
