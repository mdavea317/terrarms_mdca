<?php

// Handle form submission for both create and update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data for the new fields
    $field_nm = $_POST['field_nm'];
    $area = $_POST['area'];
    $soil_type = $_POST['soil_type'];
    $irrigation = $_POST['irrigation'];
    $date_added = $_POST['date_added'];

    if ($mode === 'create') {
        // Insert new record into the `field` table
        $sql = "INSERT INTO `field` (field_nm, area, soil_type, irrigation, date_added) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisss', $field_nm, $area, $soil_type, $irrigation, $date_added);

        if ($stmt->execute()) {
            // Redirect to avoid duplicate form submission
            header("Location: index.php?page=create&txn=$txn&success=Record created successfully.");
            exit; // Stop execution after redirect
        } else {
            $error = "Failed to create record.";
        }
    } elseif ($mode === 'update') {
        // Update existing record in the `field` table
        $id = $_POST['id'];
        $sql = "UPDATE `field` SET field_nm = ?, area = ?, soil_type = ?, irrigation = ?, date_added = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sisssi', $field_nm, $area, $soil_type, $irrigation, $date_added, $id);

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
        <h2> <?= ucfirst($mode) ?> field record </h2>
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

            <!-- Field Name -->
            <label for="field_nm">Field Name</label>
            <input type="text" class="input-field" id="field_nm" name="field_nm" value="<?= $is_update ? htmlspecialchars($data['field_nm']) : '' ?>" required>
            <br>

            <!-- Area -->
            <label for="area">Area (sq meters)</label>
            <input type="number" class="input-field" id="area" name="area" value="<?= $is_update ? htmlspecialchars($data['area']) : '' ?>" required>
            <br>

            <!-- Soil Type -->
            <label for="soil_type">Soil Type</label>
            <select id="soil_type" name="soil_type" class="input-field" required>
                <option value="">Select</option>
                <option value="Loam" <?= ($is_update && $data['soil_type'] == 'Loam') ? 'selected' : '' ?>>Loam</option>
                <option value="Clay" <?= ($is_update && $data['soil_type'] == 'Clay') ? 'selected' : '' ?>>Clay</option>
                <option value="Sandy Loam" <?= ($is_update && $data['soil_type'] == 'Sandy Loam') ? 'selected' : '' ?>>Sandy Loam</option>
                <option value="Loamy Sand" <?= ($is_update && $data['soil_type'] == 'Loamy Sand') ? 'selected' : '' ?>>Loamy Sand</option>
                <option value="Silt" <?= ($is_update && $data['soil_type'] == 'Silt') ? 'selected' : '' ?>>Silt</option>
            </select>
            <br>

            <!-- Irrigation Type -->
            <label for="irrigation">Irrigation Type</label>
            <select id="irrigation" name="irrigation" class="input-field" required>
                <option value="">Select</option>
                <option value="Sprinkler" <?= ($is_update && $data['irrigation'] == 'Sprinkler') ? 'selected' : '' ?>>Sprinkler</option>
                <option value="Furrow" <?= ($is_update && $data['irrigation'] == 'Furrow') ? 'selected' : '' ?>>Furrow</option>
                <option value="Deep Irrigation" <?= ($is_update && $data['irrigation'] == 'Deep Irrigation') ? 'selected' : '' ?>>Deep Irrigation</option>
                <option value="Drip Irrigation" <?= ($is_update && $data['irrigation'] == 'Drip Irrigation') ? 'selected' : '' ?>>Drip Irrigation</option>
            </select>
            <br>

            <!-- Date Added -->
            <label for="date_added">Date Added</label>
            <input type="date" class="input-field" id="date_added" name="date_added" value="<?= $is_update ? htmlspecialchars($data['date_added']) : '' ?>" required>
            <br>

            <button type="submit" class="btn btn-green" value="Save Record"><?= ucfirst($mode) ?> Record</button>
            <a class="btn btn-red-outline" href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>">Cancel</a>
        </form>
        <?php endif; ?>
    </div>
</div>

<div class="panel-med">
    Mapa
</div>

