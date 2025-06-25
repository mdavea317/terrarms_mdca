document.addEventListener('DOMContentLoaded', function () {
    function generateSchedule() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        if (!startDate || !endDate) {
            alert('Please select both start and end dates.');
            return;
        }
        console.log(`Start Date: ${startDate}, End Date: ${endDate}`);

    const start = new Date(startDate);
    const end = new Date(endDate);

    // Validate the dates
    if (start > end) {
        alert('Start date cannot be after end date.');
        return;
    }

    const scheduleContainer = document.getElementById('scheduleContainer');
    scheduleContainer.innerHTML = ""; // Clear previous schedule

    let dateList = [];
    let currentDate = new Date(start);
    
    while (currentDate <= end) {
        dateList.push(new Date(currentDate));
        currentDate.setDate(currentDate.getDate() + 1); // Increment day by 1
    }

    // Sample employees list (this can be dynamic as well)
    const employees = ["Alice", "Bob", "Charlie", "David"];

    // Task options (dropdown)
    const tasks = [
        "Team Leader", "Livestock Production", "Feeds Production", "Fertilizer Production", 
        "Rabbitry", "Nursery", "Garden", "Admin Office", "Crops Trimming", 
        "Driver", "Forage"
    ];

    // Shift options
    const shifts = [
        { value: 'morning', label: 'Morning (5 AM - 2 PM)' },
        { value: 'afternoon', label: 'Afternoon (1 PM - 10 PM)' },
        { value: 'graveyard', label: 'Graveyard (9 PM - 6 AM)' }
    ];

    // Create table header with task and shift dropdowns
    let table = "<table border='1' cellpadding='5' cellspacing='0'>";
    table += "<thead><tr><th>Employee</th>";

    // Create task and shift dropdowns for each employee
    for (const employee of employees) {
        table += `
            <th>
                <label>${employee}</label>
                <select class="task-dropdown" data-employee="${employee}">
                    <option value="">Select Task</option>
                    ${tasks.map(task => `<option value="${task}">${task}</option>`).join('')}
                </select>
                <br>
                <select class="shift-dropdown" data-employee="${employee}">
                    <option value="morning">Morning (5 AM - 2 PM)</option>
                    <option value="afternoon">Afternoon (1 PM - 10 PM)</option>
                    <option value="graveyard">Graveyard (9 PM - 6 AM)</option>
                </select>
            </th>
        `;
    }
    table += "</tr></thead>";

    // Generate schedule rows for dates
    table += "<tbody>";
    for (let i = 0; i < dateList.length; i++) {
        table += `<tr><td>${dateList[i].toDateString()}</td>`; // Date column
        
        // For each employee, set shift times based on selected task
        for (let j = 0; j < employees.length; j++) {
            const employee = employees[j];
            const shift = document.querySelector(`.shift-dropdown[data-employee='${employee}']`).value;

            table += `
                <td id="shift-cell-${employee}-${dateList[i].toDateString()}">
                    ${getShiftTimes(shift)}
                </td>
            `;
        }

        table += "</tr>";
    }
    table += "</tbody></table>";
    scheduleContainer.innerHTML = table;

    // Attach event listeners for task and shift changes
    const taskDropdowns = document.querySelectorAll('.task-dropdown');
    taskDropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', handleTaskChange);
    });

    const shiftDropdowns = document.querySelectorAll('.shift-dropdown');
    shiftDropdowns.forEach(dropdown => {
        dropdown.addEventListener('change', handleShiftChange);
    });
}

// Handle task change (could impact shift timing logic)
function handleTaskChange(event) {
    const employee = event.target.getAttribute('data-employee');
    const task = event.target.value;
    const shiftDropdown = document.querySelector(`.shift-dropdown[data-employee='${employee}']`);

    // You could adjust shift times based on the task (if needed)
    // For simplicity, we'll just set a default shift (morning)
    shiftDropdown.value = 'morning'; // Default to morning
    handleShiftChange({ target: shiftDropdown });
}

// Handle shift change (update shift times for all dates)
function handleShiftChange(event) {
    const employee = event.target.getAttribute('data-employee');
    const shift = event.target.value;
    const shiftCells = document.querySelectorAll(`#shift-cell-${employee}`);

    // Update shift time for each date
    shiftCells.forEach(cell => {
        cell.innerHTML = getShiftTimes(shift);
    });
}

// Helper function to get shift times based on selection
function getShiftTimes(shift) {
    switch (shift) {
        case 'morning':
            return '5 AM - 2 PM';
        case 'afternoon':
            return '1 PM - 10 PM';
        case 'graveyard':
            return '9 PM - 6 AM';
        default:
            return '';
    }
    }
    // Attach event listener to button if necessary
document.getElementById('generateSchedule').addEventListener('click', generateSchedule);
});