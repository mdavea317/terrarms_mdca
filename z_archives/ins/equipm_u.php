<?php
// Handle form submission for both create and update in `equipm_log`
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $equipment_id = $_POST['equipment_id'];
    $log_type = 'usage'; // Since the log type is restricted to 'usage'
    $log_date = $_POST['log_date'];
    $status = $_POST['status'];
    $employee_id = $_POST['employee_id']; // Foreign key to employee table

    if ($mode === 'create') {
        // Insert new log record
        $sql = "INSERT INTO `equipm_log` (equipment_id, log_type, log_date, status, employee_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isssi', $equipment_id, $log_type, $log_date, $status, $employee_id);

        if ($stmt->execute()) {
            // Redirect to avoid duplicate form submission
            header("Location: index.php?page=create&txn=$txn&success=Log created successfully.");
            exit; // Stop execution after redirect
        } else {
            $error = "Failed to create log.";
        }
    } elseif ($mode === 'update') {
        // Update existing log record
        $id = $_POST['id'];
        $sql = "UPDATE `equipm_log` SET equipment_id = ?, log_type = ?, log_date = ?, status = ?, employee_id = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('isssii', $equipment_id, $log_type, $log_date, $status, $employee_id, $id);

        if ($stmt->execute()) {
            // Redirect to avoid duplicate form submission
            header("Location: index.php?page=update&txn=$txn&id=$id&success=Log updated successfully.");
            exit; // Stop execution after redirect
        } else {
            $error = "Failed to update log.";
        }
    }
}

// Fetch all available employees for the employee dropdown
$employees_sql = "SELECT id, CONCAT(first_nm, ' ', last_nm) AS full_name FROM `employee`";
$employees_result = $conn->query($employees_sql);
$employees = [];
if ($employees_result->num_rows > 0) {
    while ($row = $employees_result->fetch_assoc()) {
        $employees[] = $row;
    }
}

// Fetch all available equipment for the equipment dropdown
$equipment_sql = "SELECT id, equipment_nm FROM `equipm`";
$equipment_result = $conn->query($equipment_sql);
$equipment_list = [];
if ($equipment_result->num_rows > 0) {
    while ($row = $equipment_result->fetch_assoc()) {
        $equipment_list[] = $row;
    }
}
?>

<div class="panel-med">
    <div class="header">
        <h2> <?= ucfirst($mode) ?> usage log </h2>
    </div>

    <div class="form-box">
        <?php if ($error): ?>
            <h2 style="color:red;"><?= htmlspecialchars($error) ?></h2>
        <?php endif; ?>

        <?php if (isset($_GET['success'])): ?>
            <h2 style="color:green;"><?= htmlspecialchars($_GET['success']) ?> </h2> <br>
            <a href="index.php?page=read&txn=<?= htmlspecialchars($txn) ?>" class="btn btn-green">View Logs</a>
        <?php else: ?>

        <!-- The form for create/update -->
        <form action="" method="post">
            <input type="hidden" name="mode" value="<?= $mode ?>">
            <input type="hidden" name="txn" value="<?= htmlspecialchars($txn) ?>">

            <?php if ($is_update): ?>
                <input type="hidden" name="id" value="<?= $data['id'] ?>">
                <h2>ID: <?= htmlspecialchars($data['id']) ?> </h2>
            <?php endif; ?>

            <!-- Equipment Dropdown -->
            <label for="equipment_id">Equipment</label>
            <select id="equipment_id" name="equipment_id" class="input-field" required>
                <option value="">Select Equipment</option>
                <?php foreach ($equipment_list as $equipment): ?>
                    <option value="<?= $equipment['id'] ?>" <?= ($is_update && $data['equipment_id'] == $equipment['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($equipment['equipment_nm']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>

            <!-- Log Date -->
            <label for="log_date">Log Date</label>
            <input type="date" class="input-field" id="log_date" name="log_date" value="<?= $is_update ? htmlspecialchars($data['log_date']) : '' ?>" required>
            <br>

            <!-- Status -->
			<label for="status">Status</label>
			<select id="status" name="status" class="input-field" required>
				<option value="">Select Status</option>
				<option value="In Maintenance" <?= $is_update && $data['status'] == 'In Maintenance' ? 'selected' : '' ?>>In Maintenance</option>
				<option value="Available" <?= $is_update && $data['status'] == 'Available' ? 'selected' : '' ?>>Available</option>
				<option value="In Use" <?= $is_update && $data['status'] == 'In Use' ? 'selected' : '' ?>>In Use</option>
			</select>
			<br>

            <!-- Employee Dropdown (Foreign Key) -->
            <label for="employee_id">Employee</label>
            <select id="employee_id" name="employee_id" class="input-field" required>
                <option value="">Select Employee</option>
                <?php foreach ($employees as $employee): ?>
                    <option value="<?= $employee['id'] ?>" <?= ($is_update && $data['employee_id'] == $employee['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($employee['full_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br> <br>

            <button type="submit" class="btn btn-green" value="Save Log"><?= ucfirst($mode) ?> Log</button>
            <a class="btn btn-red-outline" href="index.php?page=read&txn=<?php echo $txn?>">Cancel</a>
		</form>
        <?php endif; ?>
    </div>
</div>

<div class="panel-med">
Timelines
</div>
