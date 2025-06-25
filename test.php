<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Table by Date</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .filter-container {
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Filter Table by Date</h1>

    <div class="filter-container">
        <label for="month">Select Month: </label>
        <select id="month">
            <option value="all">All</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
        </select>

        <label for="year">Select Year: </label>
        <select id="year">
            <option value="all">All</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
        </select>
    </div>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <tr>
                <td>Event 1</td>
                <td>2023-01-15</td>
            </tr>
            <tr>
                <td>Event 2</td>
                <td>2023-02-10</td>
            </tr>
            <tr>
                <td>Event 3</td>
                <td>2024-03-05</td>
            </tr>
            <tr>
                <td>Event 4</td>
                <td>2024-11-22</td>
            </tr>
            <tr>
                <td>Event 5</td>
                <td>2022-12-01</td>
            </tr>
            <tr>
                <td>Event 6</td>
                <td>2023-11-15</td>
            </tr>
            <tr>
                <td>Event 7</td>
                <td>2024-09-10</td>
            </tr>
            <tr>
                <td>Event 8</td>
                <td>2023-07-20</td>
            </tr>
        </tbody>
    </table>

   <script>
	// Elements
const monthDropdown = document.getElementById('month');
const yearDropdown = document.getElementById('year');
const tableBody = document.getElementById('table-body');

// Get current month and year
const currentDate = new Date();
const currentMonth = String(currentDate.getMonth() + 1).padStart(2, '0'); // getMonth() returns 0-11, so add 1
const currentYear = currentDate.getFullYear();

// Set default values for month and year dropdowns to current month and year
monthDropdown.value = currentMonth;
yearDropdown.value = currentYear;

// Function to filter the table rows based on selected month and year
function filterTable() {
    const selectedMonth = monthDropdown.value;
    const selectedYear = yearDropdown.value;

    const rows = tableBody.getElementsByTagName('tr'); // Get all rows in the table body
    for (let row of rows) {
        const dateCell = row.cells[1].textContent; // The date is in the second cell
        const [yearCell, monthCell] = dateCell.split('-'); // Split the date into year and month

        // Show the row if it matches the selected month and year, or if "all" is selected
        const matchesMonth = selectedMonth === 'all' || monthCell === selectedMonth;
        const matchesYear = selectedYear === 'all' || yearCell === selectedYear;

        // Hide or show row based on the filters
        if (matchesMonth && matchesYear) {
            row.style.display = ''; // Show the row
        } else {
            row.style.display = 'none'; // Hide the row
        }
    }
}

// Event listeners for dropdown changes
monthDropdown.addEventListener('change', filterTable);
yearDropdown.addEventListener('change', filterTable);

// Initial render of the table with the default filters
filterTable();

	</script>
</body>
</html>
