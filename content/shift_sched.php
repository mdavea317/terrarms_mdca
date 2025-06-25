<?php
	$title = "SHIFT SCHEDULE | ";
	$title_h1 = "Shift Schedule";
	$title_parent = "Employee";
	$menu_toggle = 'emp-on';
	$breadc_if_active = "style='display:none'";

	include 'includes/db.php';


	// Query to fetch employee names
	$query = "SELECT id, CONCAT(first_nm, ' ', last_nm) AS employee_name FROM employee";
	$result = mysqli_query($conn, $query);

	// Check if the query was successful
	if ($result && mysqli_num_rows($result) > 0) {
		$employees = [];
		$employee_name = [];
		$employee_id = [];
		while ($row = mysqli_fetch_assoc($result)) {
			$employee_name[] = $row['employee_name'];
			$employee_id[] = $row['id'];
		}
	}

    // Initialize $error to prevent warnings
    $error = null; 

    if (isset($_GET['error'])) {
        $error = $_GET['error'];  // If error is passed in URL, assign it to $error
    }
    
    if (isset($_GET['success'])) {
        $success_message = $_GET['success'];  // If success message is passed, assign it
    }

?>

<div class="panel-big shift">
    <div class="header">
        <h2>Create Shift Schedule</h2>
    </div>

		
		<?php if ($error): ?>
			<h2 style="color:red;"><?= htmlspecialchars($error) ?></h2>
		<?php endif; ?>

		<!-- Display success message if any -->
		<?php if (isset($_GET['success'])): ?>
			<h2 style="color:green;"><?= htmlspecialchars($_GET['success']) ?></h2>
			<br>
			<a href="index.php?page=read&txn=employee" class="btn btn-green">View Records</a>
		<?php else: ?>
	
    <div class="form-box">
        <label for="start_dt">Start Date</label>
        <input type="date" class="input-field" id="start_dt" name="start_dt">
        <label for="end_dt">End Date</label>
        <input type="date" class="input-field" id="end_dt" name="end_dt">
        <button onclick="generateSchedTable()" class="btn btn-green" style="width: 25%;">Generate Schedule</button>
    </div>
		<?php endif; ?>
	
		<div id="tableCollapse" style="display: none;">
			<form action="includes/save_schedule.php" method="POST">
				<div class="table-container">
					<table class="table-green" id="scheduleTable">
						<thead>
							<tr>
								<th>Date</th>
								<!-- Dynamic Employee headers will go here -->
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<button class="btn btn-green" type="submit">Save Schedule</button>
			</form>
		</div>

</div>

<script>
const employees = <?php echo json_encode($employee_name); ?>;
const employees_id = <?php echo json_encode($employee_id); ?>;
const tasks = ["Select task", "Team Leader", "Livestock Production", "Feeds Production", "Fertilizer Production", "Rabbitry", "Nursery", "Garden", "Admin Office", "Crops Trimming", "Driver", "Forage"];
const shifts = {
    "Select shift": {start: "", end: ""},
	"Morning": {start: "05:00", end: "14:00"},
    "Afternoon": {start: "13:00", end: "22:00"},
   /* "Graveyard": {start: "21:00", end: "06:00"}*/
};

function generateSchedTable() {
    const startDate = new Date(document.getElementById("start_dt").value);
    const endDate = new Date(document.getElementById("end_dt").value);
    const table = document.getElementById("scheduleTable");
    const theadRow = table.querySelector("thead tr");
    const tbody = table.querySelector("tbody");

    // Clear previous data
    theadRow.innerHTML = "<th>Date</th>";
    tbody.innerHTML = "";

    // Add employee headers
    employees.forEach(emp => {
        const th = document.createElement("th");
        th.textContent = emp;
        theadRow.appendChild(th);
    });

    // Create dropdown row (second row)
    const dropdownRow = document.createElement("tr");
    dropdownRow.innerHTML = "<td>Task / Shift Schedule</td>";

    employees.forEach(emp => {
        const cell = document.createElement("td");

        // Task dropdown
        const taskSelect = document.createElement("select");
        taskSelect.className = "input-field";
        taskSelect.dataset.employee = emp;

        tasks.forEach(task => {
            const option = document.createElement("option");
            option.value = task;
            option.textContent = task;
            taskSelect.appendChild(option);
			taskSelect.name = `task[${emp}][${cell.textContent}]`;  // e.g. task[John Doe][2024-11-18]
        });

        // Shift dropdown
        const shiftSelect = document.createElement("select");
        shiftSelect.className = "input-field";
        shiftSelect.dataset.employee = emp;

        Object.keys(shifts).forEach(shift => {
            const option = document.createElement("option");
            option.value = shift;
            option.textContent = `${shift} (${shifts[shift].start} - ${shifts[shift].end})`;
            shiftSelect.appendChild(option);
        });

        // Update all rows dynamically
        shiftSelect.addEventListener("change", (e) => updateShiftDefaults(e.target.dataset.employee, e.target.value));
        taskSelect.addEventListener("change", (e) => updateTaskDefaults(e.target.dataset.employee, e.target.value));

        cell.appendChild(taskSelect);
        cell.appendChild(shiftSelect);
        dropdownRow.appendChild(cell);
    });

    tbody.appendChild(dropdownRow);

	// Create rows for each date
	for (let d = startDate; d <= endDate; d.setDate(d.getDate() + 1)) {
		const row = document.createElement("tr");
		const dateCell = document.createElement("td");
		dateCell.textContent = d.toISOString().split("T")[0]; // Format YYYY-MM-DD
		row.appendChild(dateCell);

		// Add cells for each employee
		employees.forEach(emp => {
			const cell = document.createElement("td");

			// Shift start & end time
			const shiftStart = document.createElement("input");
			shiftStart.type = "time";
			shiftStart.className = "input-field";
			shiftStart.name = `shift_start[${emp}][${dateCell.textContent}]`; // e.g. shift_start[John Doe][2024-11-18]
			shiftStart.value = ""; // Default will be set dynamically
			shiftStart.dataset.employee = emp;

			const shiftEnd = document.createElement("input");
			shiftEnd.type = "time";
			shiftEnd.className = "input-field";
			shiftEnd.name = `shift_end[${emp}][${dateCell.textContent}]`; // Properly indexed for POST request
			shiftEnd.value = ""; // Default will be set dynamically
			shiftEnd.dataset.employee = emp;

			cell.appendChild(shiftStart);
			cell.appendChild(shiftEnd);
			row.appendChild(cell);
		});

		tbody.appendChild(row);
	}

    // Show the table
    document.getElementById("tableCollapse").style.display = "block";
}

function updateShiftDefaults(employee, shiftType) {
    const selectedShift = shifts[shiftType];
    const timeInputs = document.querySelectorAll(`input[data-employee="${employee}"]`);
    timeInputs.forEach(input => {
        if (input.name.startsWith("shift_start")) {
            input.value = selectedShift.start;
        } else if (input.name.startsWith("shift_end")) {
            input.value = selectedShift.end;
        }
    });
}

function updateTaskDefaults(employee, task) {
    // Implement task-related changes if needed.
}


const tableContainer = document.querySelector('.table-cont');

let isDragging = false;
let startX;
let scrollLeft;

tableContainer.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.pageX - tableContainer.offsetLeft; // Get starting mouse position
    scrollLeft = tableContainer.scrollLeft; // Get the current scroll position
    tableContainer.style.cursor = 'grabbing'; // Change cursor to grabbing
});

tableContainer.addEventListener('mouseleave', () => {
    isDragging = false;
    tableContainer.style.cursor = 'grab'; // Reset cursor when mouse leaves
});

tableContainer.addEventListener('mouseup', () => {
    isDragging = false;
    tableContainer.style.cursor = 'grab'; // Reset cursor when mouse is released
});

tableContainer.addEventListener('mousemove', (e) => {
    if (!isDragging) return; // Only trigger if the mouse is down
    e.preventDefault(); // Prevent selection or unwanted behavior
    const x = e.pageX - tableContainer.offsetLeft; // Get current mouse position
    const walk = (x - startX) * 2; // Adjust speed of scroll based on mouse movement
    tableContainer.scrollLeft = scrollLeft - walk; // Adjust scroll position
});

</script>


