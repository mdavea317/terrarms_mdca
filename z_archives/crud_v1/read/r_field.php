<?php
// Fetch and display data for items
$sql = "SELECT * FROM $dbTable"; // Use the dbTable variable set earlier
$result = $conn->query($sql);

// Output headers
$headers = ['ID', 'Farm Field', 'Area (sqm)', 'Soil Type', 'Irrigation', 'Date Added']; // Adjust headers as needed
foreach ($headers as $header) {
    echo "<th>" . $header . "</th>";
}
echo "<th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['field_nm']) . "</td>";
    echo "<td>" . htmlspecialchars($row['area']) . "</td>";
    echo "<td>" . htmlspecialchars($row['soil_type']) . "</td>";
    echo "<td>" . htmlspecialchars($row['irrigation']) . "</td>";
    echo "<td>" . htmlspecialchars($row['date_added']) . "</td>";
    echo "<td>
            <a href='index.php?page=view&table=$nmTable&id={$row['id']}' title='View'><i class='fa-solid fa-eye'></i></a> 
			<a href='index.php?page=update&table=$nmTable&id={$row['id']}' title='Edit'><i class='fa fa-pen'></i></a> 
            <a href='index.php?page=delete&table=$nmTable&id={$row['id']}' title='Delete'><i class='fa fa-trash'></i></a>
          </td>";
    echo "</tr>";
}
?>
