<?php
// Fetch and display data for items
$sql = "SELECT * FROM $dbTable"; // Use the dbTable variable set earlier
$result = $conn->query($sql);

// Output headers
$headers = ['ID', 'Category', 'Item Name', 'Description', 'Unit', 'Price', 'Ideal <br> Quantity']; // Adjust headers as needed
foreach ($headers as $header) {
    echo "<th>" . $header . "</th>";
}
echo "<th>Actions</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
    echo "<td>" . htmlspecialchars($row['category']) . "</td>";
    echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
    echo "<td>" . htmlspecialchars($row['unit']) . "</td>";
    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
    echo "<td>" . htmlspecialchars($row['ideal_qty']) . "</td>";
    echo "<td>
            <a href='index.php?page=update&table=$nmTable&id={$row['id']}' title='Edit'><i class='fa fa-pen'></i></a> 
            <a href='index.php?page=delete&table=$nmTable&id={$row['id']}' title='Delete'><i class='fa fa-trash'></i></a>
          </td>";
    echo "</tr>";
}
?>
