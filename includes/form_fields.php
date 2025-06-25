<form action="" method="post">
    <?php echo '<input type="hidden" name="mode" value="' . $mode . '">' ?>
    <?php echo '<input type="hidden" name="txn" value="' . htmlspecialchars($txn) . '">' ?>
    
    <?php if ($is_update): ?>
        <?php echo '<input type="hidden" id="id" name="id" value="' . $data['id'] . '">' ?>
        <?php echo '<label>ID: </label><b>' . $data['id'] . '</b> <br>'; ?>
    <?php endif; ?>	
    
    <?php
        foreach ($form_fields[$txn] as $name => $field):
    ?>
        <?php echo '<label for="' . $name . '">' . $field['label'] . '</label>'; ?>

        <?php if ($field['type'] === 'select'): ?>
			<?php echo '<select id="' . $name . '" name="' . $name . '" class="input-field"  >'; ?>
			<?php echo '<option value="">Select</option>'; ?>
			<?php foreach ($field['options'] as $option): ?>
				<?php 
					// Check if $option is an array before trying to access keys
					if (is_array($option)) {
						$value = isset($option['value']) ? $option['value'] : '';
						$label = isset($option['label']) ? $option['label'] : $value; // Fallback to value if label doesn't exist
					} else {
						// If it's a string, assign it directly to value and label
						$value = $option;
						$label = $option;
					}
				?>
				<?php echo '<option value="' . htmlspecialchars($value) . '"' . (($field['value'] == $value) ? ' selected' : '') . '>' . htmlspecialchars($label) . '</option>'; ?>
			<?php endforeach; ?>
			<?php echo '</select>'; ?>



        <?php elseif ($field['type'] === 'textarea'): ?>
            <?php echo '<textarea class="input-field" id="' . $name . '" name="' . $name . '" >' . $field['value'] . '</textarea>'; ?>

        <?php else: ?>
            <?php echo '<input type="' . $field['type'] . '" class="input-field" id="' . $name . '" name="' . $name . '" value="' . $field['value'] . '" ' . (isset($field['readonly']) && $field['readonly'] ? 'readonly' : '') . ' ' . (isset($field['step']) ? 'step="' . $field['step'] . '"' : '') . ' >'; ?>
        <?php endif; ?>
        <br>
    <?php endforeach; ?>
	
	
	
	<!-- ADDITIONAL ATTACHMENTS -->
        <?php if ($txn === 'employee'): ?>
			<div class="image-box" id="button1-image-box" onclick="openCamera('button1');">
				<div class="preview-container">
					<img src="http://localhost/terrarms/wp-themes/img/default.png" alt="Default Image" id="button1-captured-image">
					<!-- Video will be added here by JavaScript -->
				</div>
				<div class="edit-icon">
					<i class="fas fa-camera" onclick="openCamera('button1');"></i>
				</div>
				<input type="hidden" id="button1-captured-image-input" name="capturedImage1" />
			</div>
			<div class="image-box" id="button2-image-box" onclick="openCamera('button2');">
				<div class="preview-container">
					<img src="http://localhost/terrarms/wp-themes/img/default.png" alt="Default Image" id="button2-captured-image">
					<!-- Video will be added here by JavaScript -->
				</div>
				<div class="edit-icon">
					<i class="fas fa-camera" onclick="openCamera('button2');"></i>
				</div>
				<input type="hidden" id="button2-captured-image-input" name="capturedImage2" />
			</div>
	
		<?php elseif ($txn === 'field'): ?>
			<label style="width: 100%;">Draw a portion here in this map for location</label>
			<div id="map" style="width: 100%; height: 300px;"></div>
        <?php endif; ?>



	
	
	<br>
	
    <button type="submit" class="btn btn-green" value="Save Record"> <?php echo ucfirst($mode) ?> Record</button>
    <a class="btn btn-red-outline" href="index.php?page=read&txn=<?php echo htmlspecialchars($txn)?>">Cancel</a>
</form>

<script src="wp-themes/js/field_draw.js"></script>

