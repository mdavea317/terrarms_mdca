<?php
// Fetch and display data for items
$sql = "SELECT `equipm_log`.*, `equipm`.*, `employee`.*, `equipm_log`.`log_type`
FROM `equipm_log` 
	LEFT JOIN `equipm` ON `equipm_log`.`equipment_id` = `equipm`.`id` 
	LEFT JOIN `employee` ON `equipm_log`.`employee_id` = `employee`.`id`
WHERE `equipm_log`.`log_type` LIKE '%usage%'"; 
$result = $conn->query($sql);

// Output headers
$headers = ['ID', 'Equipment Name', 'Model', 'Status', 'Date', 'Name']; // Adjust headers as needed
foreach ($headers as $header) {
    echo "<th>" . $header . "</th>";
}
echo "<th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['equipment_nm']) . "</td>";
    echo "<td>" . htmlspecialchars($row['model']) . "</td>";
    echo "<td>" . htmlspecialchars($row['status']) . "</td>";
    echo "<td>" . htmlspecialchars($row['log_date']) . "</td>";
	echo "<td>" . htmlspecialchars($row['first_nm'] . ' ' . $row['last_nm']) . "</td>";
    echo "<td>
            <a href='index.php?page=update&table=$nmTable&id={$row['id']}' title='Edit'><i class='fa fa-pen'></i></a> 
            <a href='index.php?page=delete&table=$nmTable&id={$row['id']}' title='Delete'><i class='fa fa-trash'></i></a>
          </td>";
    echo "</tr>";
}
?>
