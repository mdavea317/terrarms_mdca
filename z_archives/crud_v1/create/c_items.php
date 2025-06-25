<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$category = $_POST['category'];
	$item_name = $_POST['item_name'];
	$description = $_POST['description']; // Added for description
	$unit = $_POST['unit']; // Added for unit
	$price = $_POST['price']; // Added for price
	$ideal_qty = $_POST['ideal_qty']; // Added for ideal_qty

    $sql = "INSERT INTO  `items` (`category`, `item_name`, `description`, `unit`, `price`, `ideal_qty`) VALUES ('$category', '$item_name', '$description', '$unit', '$price', '$ideal_qty')";

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
			<form method="POST" action="index.php?page=create&table=items">
				
				<!--label for="ID">ID</label>
				<input type="number" id="ID" name="ID" required-->

				<label for="category">Category</label>
				<select id="category" name="category" class="input-field" required>
					<option value="">Select</option>
					<option value="Supplies">Supplies</option>
					<option value="Fertilizer">Fertilizer</option>
					<option value="Equipment">Equipment</option>
					<option value="Livestock">Livestock</option>
				</select>
				<br>

				<label for="item_name">Item Name</label>
				<input type="text" id="item_name" name="item_name" class="input-field" required> <br>

				<label for="description">Description</label>
				<textarea id="description" name="description" class="input-field" required></textarea> <br>

				<label for="unit">Unit</label>
				<input type="text" id="unit" name="unit" class="input-field" required><br>

				<label for="price">Price</label>
				<input type="number" step="0.01" id="price" name="price" class="input-field" required><br>

				<label for="ideal_qty">Ideal Quantity</label>
				<input type="number" step="0.01" id="ideal_qty" name="ideal_qty" class="input-field" required><br>

				
                <button type="submit" class="btn btn-green" value="Save Record">Save Record</button>
				<a class="btn btn-red-outline" href="index.php?page=read&table=items"> Cancel </a>
            </form>
		</div>
		
    </div>			