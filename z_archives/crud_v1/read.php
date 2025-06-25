<?php

	include 'includes/db.php';
	include 'includes/prompt.php'; ?>



	<section class="search-bar">

            <div class="search-container">
                <input type="text" id="search" placeholder="Search item...">
                <button class="search-btn">
                    <i class="fa fa-search"></i>
                </button>
            </div>



<?php
	include 'includes/table_map.php';
		
		echo "<a class='btn btn-green' href='index.php?page=create&table=$nmTable'>";
		echo "<i class='fa fa-plus'></i> Add Record </a>";
  		echo "</section>";
	
	if (isset($titles[$tabledb])) {
        $title = $titles[$tabledb]['tab'];
        $title_h1 = $titles[$tabledb]['h1'];
		$title_parent = $titles[$tabledb]['parent'];
		$menu_toggle = $titles[$tabledb]['toggle'];
    }
	
		echo "<section class='panel-big'>";
		echo "<table class='table-green'>";
	 	include $filePath;
		echo "</table> </section>"

?>

</section>
