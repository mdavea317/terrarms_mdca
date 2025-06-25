<div class="panel-med">
    <div class="header">
        <h2> <?= ucfirst($mode) ?> maintenance Log </h2>
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

            <!-- Status Dropdown -->
            <label for="status">Status</label>
            <select id="status" name="status" class="input-field" required>
                <option value="">Select Status</option>
                <option value="In Progress" <?= $is_update && $data['status'] == 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                <option value="Completed" <?= $is_update && $data['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
            </select>
            <br>

            <!-- Maintenance Type -->
            <label for="maint_type">Maintenance Type</label>
            <input type="text" class="input-field" id="maint_type" name="maint_type" value="<?= $is_update ? htmlspecialchars($data['maint_type']) : '' ?>">
            <br>

            <!-- Maintenance Scheduled Date -->
            <label for="maint_sched_dt">Maintenance Scheduled Date</label>
            <input type="date" class="input-field" id="maint_sched_dt" name="maint_sched_dt" value="<?= $is_update ? htmlspecialchars($data['maint_sched_dt']) : '' ?>">
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