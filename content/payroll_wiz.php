<?php
	$title = "PAYROLL WIZARD | ";
	$title_h1 = "Payroll Wizard";
	$title_parent = "Employee";
	$menu_toggle = 'emp-on';
	$breadc_if_active = "style='display:none'";

	include 'includes/db.php';
?>
<div class="payroll-wiz">
    <div class="panel-med">
		
        <!-- Step 1: Gross Pay Calculation -->
        <div id="step1" class="step">
			<div class="header">
				<h2> Step 1: Set pay period </h2>
			</div>
			<div class="form-box">
				<form id="payPeriodForm">
					<label for="pay_period_st"> Period start: </label>
					<input type="date" class="input-field" id="pay_period_st" name="pay_period_st"> <br>
					<label for="pay_period_ed"> Period end: </label>
					<input type="date" class="input-field" id="pay_period_ed" name="pay_period_ed"> <br>
				</form>
			</div>
        </div>

        <!-- Step 2: Deduction Calculation -->
        <div id="step2" class="step" style="display: none;">
			<div class="header">
				<h2> Step 2: Gross pay </h2>
			</div>
			<div class="form-box">
                <!-- Display the selected pay period dates from Step 1 here -->
                <h3><strong>Pay Period:</strong> From <span id="display_start_date"></span> to <span id="display_end_date"></span></h3>
				
				<table class="table-green">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Daily Rate</th>
							<th>OT Rate</th>
							<th>Total Days Worked</th>
							<th>Total OT Hours</th>
							<th>Gross Pay</th>
						</tr>
					</thead>
					<tbody id="employeeTableBody">
						<!-- Rows will be added here by JavaScript -->
					</tbody>
				</table> 
				
				
			</div>
        </div>

        <!-- Step 3: Final Review -->
        <div id="step3" class="step" style="display: none;">
			<div class="header">
				<h2> Step 3: Deduction </h2>
			</div>
			<div class="form-box">
                <!-- Display the selected pay period dates from Step 1 here -->
                <h3><strong>Pay Period:</strong> <span id="payPeriodDates"></span></h3>

				<table class="table-green">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>SSS Deduction</th>
							<th>Pagibig Deduction</th>
							<th>PhilHealth Deduction</th>
							<th>Total Deductions</th>
						</tr>
					</thead>
					<tbody id="employeeDeductionsTableBody">
						<!-- Rows will be added here by JavaScript -->
					</tbody>
					
				</table> 				
			</div>			
        </div>

		
        <!-- Step 3: Final Review -->
        <div id="step4" class="step" style="display: none;">
			<div class="header">
				<h2> Step 4 </h2>
			</div>
			<div class="form-box">
                <!-- Display the selected pay period dates from Step 1 here -->
                <h3><strong>Pay Period:</strong> <span id="payPeriodDates2"></span></h3>

				<table class="table-green">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Gross Pay</th>
							<th>Total Deductions</th>
							<th>Take Home Pay</th>
						</tr>
					</thead>
					<tbody id="updateSummaryTable">
						<!-- Rows will be added here by JavaScript  "-->
					</tbody>
					
				</table> 
				
				<table>
					<tbody id="tableFinalHide" style="display: none;">
					</tbody>
				</table>
			</div>			
        </div>        <!-- Navigation Buttons -->
        <div class="navigation">
            <button class="btn btn-grey" onclick="prevStep()" id="prevBtn" style="display: none;">Previous</button>
            <button class="btn btn-green" onclick="nextStep()" id="nextBtn">Next</button>
        </div>
    </div>
</div>
    <script>
	let currentStep = 1;

	function showStep(step) {
		// Hide all steps, and display the current one
		document.querySelectorAll('.step').forEach(el => el.style.display = 'none');
		document.getElementById('step' + step).style.display = 'block';

		// Show or hide the 'previous' button based on the current step
		document.getElementById('prevBtn').style.display = step > 1 ? 'inline-block' : 'none';

		// Change 'Next' button to 'Finish' on the last step
		document.getElementById('nextBtn').innerText = step < 4 ? 'Next' : 'Finish';

		// Trigger data fetching for Step 3 and Step 4
		if (step === 3 || step === 4) {
			const payPeriodSt = document.querySelector('input[name="pay_period_st"]').value;
			const payPeriodEd = document.querySelector('input[name="pay_period_ed"]').value;

			if (payPeriodSt && payPeriodEd) {
				const payPeriodText = `From ${payPeriodSt} to ${payPeriodEd}`;
				document.getElementById('payPeriodDates').textContent = payPeriodText;
				document.getElementById('payPeriodDates2').textContent = payPeriodText;
			}

			// Fetch data for Step 3 and Step 4
			fetchData('includes/fetch_emplog.php', { pay_period_st: payPeriodSt, pay_period_ed: payPeriodEd }, updateEmployeeDeductionsTable);
			fetchData('includes/fetch_emplog.php', { pay_period_st: payPeriodSt, pay_period_ed: payPeriodEd }, updateSummaryTable);
			fetchData('includes/fetch_emplog.php', { pay_period_st: payPeriodSt, pay_period_ed: payPeriodEd }, tableFinalHide);
		}
	}

	function nextStep() {
		if (currentStep === 1) {
			const startDate = document.getElementById('pay_period_st').value;
			const endDate = document.getElementById('pay_period_ed').value;
			document.getElementById('display_start_date').innerText = startDate;
			document.getElementById('display_end_date').innerText = endDate;
			currentStep++;
		} else if (currentStep === 2) {
			currentStep++;
		} else if (currentStep === 3) {
			currentStep++;
		} else if (currentStep === 4) {
			saveData();  // Call the function to save data when the user clicks the "Save" button
		}
		showStep(currentStep);
	}

	function prevStep() {
		currentStep--;
		showStep(currentStep);
	}

	document.getElementById('pay_period_st').addEventListener('change', fetchEmployeeLogData);
	document.getElementById('pay_period_ed').addEventListener('change', fetchEmployeeLogData);

	function fetchEmployeeLogData() {
		const startDate = document.getElementById('pay_period_st').value;
		const endDate = document.getElementById('pay_period_ed').value;

		if (startDate && endDate) {
			fetchData('includes/fetch_emplog.php', { pay_period_st: startDate, pay_period_ed: endDate }, updateEmployeeTable);
		}
	}

	// Generic function to handle the AJAX fetch and process the response
	function fetchData(url, requestData, callback) {
		fetch(url, {
			method: 'POST',
			headers: { 'Content-Type': 'application/json' },
			body: JSON.stringify(requestData)
		})
		.then(response => response.json())
		.then(data => callback(data))
		.catch(error => console.error('Error fetching data:', error));
	}

	function updateEmployeeTable(data) {
		updateTable('employeeTableBody', [
			{ label: 'id', value: row => row.id },
			{ label: 'Name', value: row => `${row.first_nm} ${row.last_nm}` },
			{ label: 'Daily Wage', value: row => row.wage_daily },
			{ label: 'Overtime Wage', value: row => row.wage_ot },
			{ label: 'Total Days Worked', value: row => row.total_days_worked },
			//{ label: 'dds', value: row => row.regular_pay },
			{ label: 'Overtime Hours', value: row => row.total_overtime_hours },
			//{ label: 'ddd', value: row => row.overtime_pay },
			{ label: 'Gross Pay', value: row => `<b>${row.gross_pay}</b>` }
		], data);
	}

	function updateEmployeeDeductionsTable(data) {
		updateTable('employeeDeductionsTableBody', [
			{ label: 'id', value: row => row.id },
			{ label: 'Name', value: row => `${row.first_nm} ${row.last_nm}` },
			{ label: 'SSS', value: row => row.sss },
			{ label: 'Pag-Ibig', value: row => row.pagibig },
			{ label: 'PhilHealth', value: row => row.philhealth },
			{ label: 'Total Deductions', value: row => `<b>${row.total_deductions}</b>` }
		], data);
	}

	function updateSummaryTable(data) {
		updateTable('updateSummaryTable', [
			{ label: 'id', value: row => row.id },
			{ label: 'Name', value: row => `${row.first_nm} ${row.last_nm}` },
			{ label: 'Gross Pay', value: row => row.gross_pay },
			{ label: 'Total Deductions', value: row => row.total_deductions },
			{ label: 'Take-Home Pay', value: row => `<b>${row.take_home_pay}</b>` }
		], data);
	}
		
	function tableFinalHide(data) {
		updateTable('tableFinalHide', [
			{ label: 'id', value: row => row.id },
			{ label: 'Daily Wage', value: row => row.wage_daily },
			{ label: 'Overtime Wage', value: row => row.wage_ot },
			{ label: 'Total Days Worked', value: row => row.total_days_worked },
			{ label: 'Overtime Hours', value: row => row.total_overtime_hours },
			{ label: 'Gross Pay', value: row => row.gross_pay },
			{ label: 'SSS', value: row => row.sss },
			{ label: 'Pag-Ibig', value: row => row.pagibig },
			{ label: 'PhilHealth', value: row => row.philhealth },
			{ label: 'Total Deductions', value: row => row.total_deductions },
			{ label: 'Take-Home Pay', value: row => row.take_home_pay }
		], data);
	}

	// Generic table update function to handle creating table rows
	function updateTable(tableId, columns, data) {
		const tableBody = document.getElementById(tableId);
		tableBody.innerHTML = '';

		data.forEach(row => {
			const tr = document.createElement('tr');
			columns.forEach(col => {
				const td = document.createElement('td');
				td.innerHTML = col.value(row);
				tr.appendChild(td);
			});
			tableBody.appendChild(tr);
		});
	}

	function saveData() {
		// Collect the data from the form (pay period dates, employee info, etc.)
		const payPeriodSt = document.getElementById('pay_period_st').value;
		const payPeriodEd = document.getElementById('pay_period_ed').value;
		const startDate = document.getElementById('display_start_date').innerText;
		const endDate = document.getElementById('display_end_date').innerText;

		// Collect all employee data from the table dynamically
		const employeeData = [];
		const rows = document.querySelectorAll('#tableFinalHide tr');  // Get all rows in the employee table body

		rows.forEach(row => {
			const id = row.querySelector('td:nth-child(1)').innerText;
			const wageDaily = parseFloat(row.querySelector('td:nth-child(2)').innerText.replace(/,/g, '')) || 0;
			const wageOt = parseFloat(row.querySelector('td:nth-child(3)').innerText.replace(/,/g, '')) || 0;
			const totalDaysWorked = parseInt(row.querySelector('td:nth-child(4)').innerText.replace(/,/g, '')) || 0;
			const totalOtHours = parseInt(row.querySelector('td:nth-child(5)').innerText.replace(/,/g, '')) || 0;
			const grossPay = parseFloat(row.querySelector('td:nth-child(6)').innerText.replace(/,/g, '')) || 0;
			const sssDed = parseFloat(row.querySelector('td:nth-child(7)').innerText.replace(/,/g, '')) || 0;
			const pagIbigDed = parseFloat(row.querySelector('td:nth-child(8)').innerText.replace(/,/g, '')) || 0;
			const philHealthDed = parseFloat(row.querySelector('td:nth-child(9)').innerText.replace(/,/g, '')) || 0;
			const totalDeductions = parseFloat(row.querySelector('td:nth-child(10)').innerText.replace(/,/g, '')) || 0;
			const takeHomePay = parseFloat(row.querySelector('td:nth-child(11)').innerText.replace(/,/g, '')) || 0;


			// Add employee data to the array
			employeeData.push({
				id: id,
				gross_pay: grossPay,
				wage_daily: wageDaily,
				wage_ot: wageOt,
				total_days_worked: totalDaysWorked,
				total_overtime_hours: totalOtHours,
				gross_pay: grossPay,
				sss: sssDed,
				pagibig: pagIbigDed,
				philhealth: philHealthDed,
				total_deductions: totalDeductions,
				take_home_pay: takeHomePay
			});
		});

		// Send the data to the server using XMLHttpRequest (XHR)
		const requestData = {
			pay_period_st: payPeriodSt,
			pay_period_ed: payPeriodEd,
			start_date: startDate,
			end_date: endDate,
			employees: employeeData
		};

		// Log the data to the console for debugging
		console.log(requestData);

		// Create a new XMLHttpRequest object
		const xhr = new XMLHttpRequest();

		// Set up the request
		xhr.open('POST', 'includes/save_payroll_data.php', true);
		xhr.setRequestHeader('Content-Type', 'application/json');  // Tell the server we're sending JSON data


		// Handle the server's response
		xhr.onload = function() {
			console.log("Response text:", xhr.responseText); // For debugging

			try {
				const data = JSON.parse(xhr.responseText);

				if (data.success) {
					alert('Payroll data saved successfully!');
				} else {
					alert(`Error saving payroll data: ${data.message}`);
				}
			} catch (e) {
				console.error('Error parsing JSON response:', e);
				alert('Unexpected response format from server.');
			}
		};

		// Define what happens in case of an error
		xhr.onerror = function() {
			alert('An error occurred during the request. Please try again.');
		};

		// Send the request with the data as a JSON string
		xhr.send(JSON.stringify(requestData));
	}





    </script>

