<?php
// Sample feed plans data for livestock with multiple tasks
$feedPlans = [
    [
        'id' => 'L23001',
        'name' => 'Holstein Cow CO-0523',
        'tasks' => [
            ['name' => 'Task A', 'start' => '2023-01-01', 'end' => '2023-03-31'],
            ['name' => 'Task B', 'start' => '2023-04-01', 'end' => '2023-06-30'],
            ['name' => 'Task C', 'start' => '2023-07-01', 'end' => '2023-09-30'],
            ['name' => 'Task D', 'start' => '2023-10-01', 'end' => '2023-12-31']
        ]
    ],
    [
        'id' => 'L23002',
        'name' => 'Broiler Chicken CH-0223',
        'tasks' => [
            ['name' => 'Task A', 'start' => '2023-02-01', 'end' => '2023-05-31'],
            ['name' => 'Task B', 'start' => '2023-06-01', 'end' => '2023-08-31']
        ]
    ],
    // Additional livestock with tasks...
];

// Get the current date to highlight active tasks
$currentDate = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Plan Gantt Chart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Feed Plan Gantt Chart</h1>

    <!-- Timeline Container -->
    <div class="timeline-container">
        <!-- Timeline Header Row for Months -->
        <div class="timeline-header">
            <div class="timeline-header-cell">Livestock ID</div>
            <div class="timeline-header-cell">Livestock Name</div>
            <?php
            // Define months headers
            $months = ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'];
            foreach ($months as $month) {
                echo "<div class='timeline-header-cell'>$month</div>";
            }
            ?>
        </div>

        <!-- Timeline Rows for Each Livestock -->
        <?php foreach ($feedPlans as $plan): ?>
            <div class="timeline-row">
                <div class="timeline-cell"><?php echo $plan['id']; ?></div>
                <div class="timeline-cell"><?php echo $plan['name']; ?></div>

                <!-- Generate bars for each task -->
                <?php foreach ($plan['tasks'] as $task): 
                    // Calculate the start and end month indexes for each task
                    $startMonthIndex = (int)date('m', strtotime($task['start'])) - 1;
                    $endMonthIndex = (int)date('m', strtotime($task['end'])) - 1;
                    
                    // Determine if the task is active based on the current date
                    $isCurrentTask = ($currentDate >= $task['start'] && $currentDate <= $task['end']);
                    ?>
					<div 
						class="timeline-bar <?php echo $isCurrentTask ? 'current' : ''; ?>"
						data-start="<?php echo $task['start']; ?>"
						data-end="<?php echo $task['end']; ?>"
						style="grid-column: <?php echo $startMonthIndex + 3; ?> / <?php echo $endMonthIndex + 4; ?>;"
						title="Start: <?php echo date('M d, Y', strtotime($task['start'])); ?> - End: <?php echo date('M d, Y', strtotime($task['end'])); ?>"
					>
						<span class="bar-label"><?php echo $task['name']; ?></span>
					</div>

                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
	
	<?php echo "<div>Current Date: $currentDate</div>"; // Just for debugging ?>

    <script src="script.js"></script>
</body>
</html>
