		<script>
// Function to calculate the month index from a date (0 for January, 11 for December)
function getMonthIndex(dateString) {
    const date = new Date(dateString);
    return date.getMonth(); // Returns month index (0 = January, 11 = December)
}

// Function to calculate the duration in months between two dates
function getMonthSpan(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const months = (end.getFullYear() - start.getFullYear()) * 12 + (end.getMonth() - start.getMonth());
    return months + 1; // Include the starting month
}

// Sample task data with start and end dates from PHP
const tasks = <?php echo $js_array; ?>;  // This will output the JSON-encoded array directly into JavaScript
const txn = "<?php echo $read_qry[$txn]['go_to']; ?>";  // Pass the PHP variable `table` to JavaScript as `txn

// Function to generate Gantt chart rows dynamically based on tasks data
function generateGanttChart(tasks) {
    const tbody = document.getElementById('gantt-chart-body');
    
    tasks.forEach(task => {
        const row = document.createElement('tr');
        row.classList.add('task-row');

        // Create task name cell
        const taskNameCell = document.createElement('td');
        taskNameCell.textContent = task[1]; // Access crop_nm using index 1
        row.appendChild(taskNameCell);

        // Calculate task start month and duration
        const startMonthIndex = getMonthIndex(task[2]); // Access planting_dt using index 2
        const durationInMonths = getMonthSpan(task[2], task[3]); // Access harvest_dt using index 3

        // Create empty cells before the task bar starts
        for (let i = 0; i < startMonthIndex; i++) {
            const emptyCell = document.createElement('td');
            row.appendChild(emptyCell);
        }

        // Create task bar cell spanning the task duration
        const taskBarCell = document.createElement('td');
        taskBarCell.classList.add('bar');
        taskBarCell.colSpan = Math.min(durationInMonths, 12 - startMonthIndex); // Ensure it doesn't exceed 12 months
        taskBarCell.textContent = "Planted"; // You can set a status or similar here
        taskBarCell.setAttribute('data-tooltip', `${task[1]}: ${task[2]} - ${task[3]}`); // Tooltip using indices
        row.appendChild(taskBarCell);

        // Create remaining empty cells after the task bar
        for (let i = startMonthIndex + taskBarCell.colSpan; i < 12; i++) {
            const emptyCell = document.createElement('td');
            row.appendChild(emptyCell);
        }

        // Create action cell with anchor link
        const actionCell = document.createElement('td');
        const actionLink = document.createElement('a');
        actionLink.title = "Update";
        actionLink.href = `index.php?page=update&txn=${txn}&id=${task[0]}`; // Use txn variable here
        actionLink.target = '_self'; // Set target to _self to open in the same tab

        // Create the icon element
        const icon = document.createElement('i');
        icon.classList.add('fa', 'fa-pen'); // Add Font Awesome classes for the pen icon

        // Append the icon to the action link
        actionLink.appendChild(icon);
        actionCell.appendChild(actionLink);
        row.appendChild(actionCell); // Append action cell to the row

        tbody.appendChild(row);
    });
}

// Generate the Gantt chart
generateGanttChart(tasks);
</script>