<?php

// Define the content page to include
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$contentPage = "content/{$page}.php";

// Fallback if the content page doesn't exist
if (!file_exists($contentPage)) {
    $contentPage = "content/dashboard.php";
}

// Include the content file first to fetch the $title variable
ob_start(); // Start output buffering
include $contentPage;
ob_end_clean(); // Capture the content and discard it, but we have the title
// Include header
include_once 'includes/header.php';
?>

 <div class="overlay"></div>

<button class="sidebar-toggle" id="sidebarToggle">☰ Menu</button>

<?php include 'includes/sidenav.php'; ?>


<main class="wrapper">
	
	<section class="section1" <?php echo isset($section1_if_active) ? $section1_if_active : '';?>>	
		<div class="title">
		  <h3><?php echo isset($title_parent) ? $title_parent : '';?></h3>
		  <h1><?php echo isset($title_h1) ? $title_h1 : '';?></h1>
		</div>
		
		<?php include 'includes/profile_bn.php'; ?>
		
	</section>
	
	<?php include 'includes/breadcrumbs.php';?>
	<?php include $contentPage; ?>
</main>
    
<?php include 'includes/footer.php'; ?>
