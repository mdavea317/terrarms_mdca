<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $livestock_nm = $_POST['livestock_nm'];
    $livestock_type = $_POST['livestock_type'];
    $quantity = $_POST['quantity'];
    $birthdate = $_POST['birthdate'];

    if ($mode === 'create') {
        // Insert new livestock record
        $sql = "INSERT INTO `livestock` (livestock_nm, livestock_type, quantity, birthdate) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssis', $livestock_nm, $livestock_type, $quantity, $birthdate);

        if ($stmt->execute()) {
            header("Location: index.php?page=create&txn=$txn&success=Livestock created successfully.");
            exit;
        } else {
            $error = "Failed to create livestock.";
        }
    } elseif ($mode === 'update') {
        // Update existing livestock record
        $id = $_POST['id'];
        $sql = "UPDATE `livestock` SET livestock_nm = ?, livestock_type = ?, quantity = ?, birthdate = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssisi', $livestock_nm, $livestock_type, $quantity, $birthdate, $id);

        if ($stmt->execute()) {
            header("Location: index.php?page=create&txn=$txn&id=$id&success=Livestock updated successfully.");
            exit;
        } else {
            $error = "Failed to update livestock.";
        }
    }
}

// Fetch all livestock types from the items table where category is 'Livestock'
/*$livestock_types_sql = "SELECT id, item_name FROM `items` WHERE category = 'Livestock'";
$livestock_types_result = $conn->query($livestock_types_sql);
$livestock_types = [];
if ($livestock_types_result->num_rows > 0) {
    while ($row = $livestock_types_result->fetch_assoc()) {
        $livestock_types[] = $row;
    }
}*/



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
                <option value="Goat" <?= ($is_update && $data['livestock_type'] == 'Goat') ? 'selected' : '' ?>>Goat</option>
                <option value="Cow" <?= ($is_update && $data['livestock_type'] == 'Cow') ? 'selected' : '' ?>>Cow</option>
                <option value="Chicken" <?= ($is_update && $data['livestock_type'] == 'Chicken') ? 'selected' : '' ?>>Chicken</option>
				<option value="Pig" <?= ($is_update && $data['livestock_type'] == 'Pig') ? 'selected' : '' ?>>Pig</option>
				<option value="Sheep" <?= ($is_update && $data['livestock_type'] == 'Sheep') ? 'selected' : '' ?>>Sheep</option>
				

            </select>
            <br>

            <!-- Quantity -->
            <label for="quantity">Quantity</label>
            <input type="number" class="input-field" id="quantity" name="quantity" value="<?= $is_update ? htmlspecialchars($data['quantity']) : '' ?>" required>
            <br>

            <!-- Birthdate -->
            <label for="birthdate">Birthdate</label>
            <input type="date" class="input-field" id="birthdate" name="birthdate" value="<?= $is_update ? htmlspecialchars($data['birthdate']) : '' ?>" required>
            <br>

            <button type="submit" class="btn btn-green" value="Save Livestock"><?= ucfirst($mode) ?> Livestock</button>
            <a class="btn btn-red-outline" href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>">Cancel</a>
        </form>
        <?php endif; ?>
    </div>
</div>
