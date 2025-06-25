<?php

//UPDATE - RESOURCE ITEMS

// Get and validate the ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0; // Convert to integer
if ($id <= 0) {
    die("Invalid ID");
}

// Fetch the existing item data
$sql = "SELECT * FROM `items` WHERE `ID` = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$category = $_POST['category'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description']; // Added for description
    $unit = $_POST['unit']; // Added for unit
    $price = $_POST['price']; // Added for price
    $ideal_qty = $_POST['ideal_qty']; // Added for ideal_qty

    $sql = "UPDATE `items` 
            SET `category` = '$category', 
                `item_name` = '$item_name', 
                `description` = '$description', 
                `unit` = '$unit', 
                `price` = '$price', 
                `ideal_qty` = '$ideal_qty' 
            WHERE `id` = '$id'";


    if ($conn->query($sql) === TRUE) {
		header("Location: index.php?page=read&table=items&status=success");
		exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
		header("Location: index.php?page=read&table=items&status=error");
    	exit;
    }
}

?>
	<div class="panel-med">
		<div class="header">
			<h2> Create item record </h2>
		</div>
        <div class="form-box">
			<form method="POST" action="index.php?page=update&table=items&id=<?php echo $id;?>">
				
    		<h3>Item ID: <?php echo htmlspecialchars($user['id']); ?></h3> <!-- Display ID -->


			<label for="category">Category</label>
			<select id="category" name="category" class="input-field" required>
				<option value="">Select</option>
				<option value="Supplies" <?php echo ($user['category'] == 'Supplies') ? 'selected' : ''; ?>>Supplies</option>
				<option value="Fertilizer" <?php echo ($user['category'] == 'Fertilizer') ? 'selected' : ''; ?>>Fertilizer</option>
				<option value="Equipment" <?php echo ($user['category'] == 'Equipment') ? 'selected' : ''; ?>>Equipment</option>
				<option value="Livestock" <?php echo ($user['category'] == 'Livestock') ? 'selected' : ''; ?>>Livestock</option>
			</select>
			<br>

			<label for="item_name">Item Name</label>
			<input type="text" id="item_name" name="item_name" class="input-field" value="<?php echo htmlspecialchars($user['item_name']); ?>" required> <br>

			<label for="description">Description</label>
			<textarea id="description" name="description" class="input-field" required><?php echo htmlspecialchars($user['description']); ?></textarea> <br>

			<label for="unit">Unit</label>
			<input type="text" id="unit" name="unit" class="input-field" value="<?php echo htmlspecialchars($user['unit']); ?>" required><br>

			<label for="price">Price</label>
			<input type="number" step="0.01" id="price" name="price" class="input-field" value="<?php echo htmlspecialchars($user['price']); ?>" required><br>

			<label for="ideal_qty">Ideal Quantity</label>
			<input type="number" step="0.01"  id="ideal_qty" name="ideal_qty" class="input-field" value="<?php echo htmlspecialchars($user['ideal_qty']); ?>" required><br>									

				
                <button type="submit" class="btn btn-green" value="Save Record">Save Record</button>
				<a class="btn btn-red-outline" href="index.php?page=read&table=items"> Cancel </a>
            </form>
		</div>
		
    </div>					