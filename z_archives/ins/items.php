<?php

// Handle form submission for both create and update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $category = $_POST['category'];
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $unit = $_POST['unit'];
    $price = $_POST['price'];
    $ideal_qty = $_POST['ideal_qty'];

    if ($mode === 'create') {
        // Insert new record
        $sql = "INSERT INTO `items` (category, item_name, description, unit, price, ideal_qty) 
                VALUES ('$category', '$item_name', '$description', '$unit', '$price', '$ideal_qty')";

		include 'includes/ok_create.php';
		
    } elseif ($mode === 'update') {
        // Update existing record
        $id = $_POST['id'];
        $sql = "UPDATE `items` SET 
                category = '$category', 
                item_name = '$item_name', 
                description = '$description', 
                unit = '$unit', 
                price = '$price', 
                ideal_qty = '$ideal_qty' 
                WHERE id = $id";

		include 'includes/ok_update.php';
    }
}

?>

<div class="panel-med">
    <div class="header">
        <h2><?= ucfirst($mode) ?> item record</h2>
    </div>

    <div class="form-box">
        <!-- Display error message if any -->
        <?php if ($error):
            include 'includes/prompt_error.php';
        endif; ?>

        <!-- Display success message if any -->
        <?php if (isset($_GET['success'])):
            include 'includes/prompt_success.php';
        else: ?>
            <!-- The form for create/update -->
            <form action="" method="post">
                <input type="hidden" name="mode" value="<?= $mode ?>">
                <input type="hidden" name="txn" value="<?= htmlspecialchars($txn) ?>">
                <?php if ($is_update): ?>
                    <input type="hidden" name="id" value="<?= $data['id'] ?>">
                    <h2>ID: <?= $data['id'] ?></h2>
                <?php endif; ?>

                <label for="category">Category</label>
                <select id="category" name="category" class="input-field" required>
                    <option value="">Select</option>
                    <?php 
                    // Define categories and loop through to create options
                    $categories = ['Supplies', 'Fertilizer', 'Tools and Equipment', 'Livestock'];
                    foreach ($categories as $cat): ?>
                        <option value="<?= $cat ?>" <?= ($is_update && $data['category'] == $cat) ? 'selected' : '' ?>>
                            <?= $cat ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <br>

                <label for="item_name">Item Name</label>
                <input type="text" class="input-field" id="item_name" name="item_name" 
                       value="<?= $is_update ? htmlspecialchars($data['item_name']) : '' ?>" required>
                <br>

                <label for="description">Description</label>
                <textarea class="input-field" id="description" name="description" required>
                    <?= $is_update ? htmlspecialchars($data['description']) : '' ?>
                </textarea>
                <br>

                <label for="unit">Unit</label>
                <input type="text" class="input-field" id="unit" name="unit" 
                       value="<?= $is_update ? htmlspecialchars($data['unit']) : '' ?>" required>
                <br>

                <label for="price">Price</label>
                <input type="number" class="input-field" step="0.01" id="price" name="price" 
                       value="<?= $is_update ? htmlspecialchars($data['price']) : '' ?>" required>
                <br>

                <label for="ideal_qty">Ideal Quantity</label>
                <input type="number" class="input-field" step="0.01" id="ideal_qty" name="ideal_qty" 
                       value="<?= $is_update ? htmlspecialchars($data['ideal_qty']) : '' ?>" required>
                <br>

				<?php include 'includes/save_btn.php';?>
            </form>
        <?php endif; ?>
    </div>
</div>

