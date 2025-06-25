<?php
// Check if the session is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // Start the session if not already started
}

// Check if user is logged in; if not, allow access to forgot-pw.php
if (!isset($_SESSION['user_id'])) {
    // Prevent redirect loop by checking the current page
    $current_page = basename($_SERVER['PHP_SELF']);
    if ($current_page !== 'login.php' && $current_page !== 'forgot-pw.php') {
        header("Location: login.php");
        exit();
    }
}

date_default_timezone_set('Asia/Manila');

?>





<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title> <?php echo isset($title) ? $title : ''; ?> TERRARMS </title>
		<link rel="stylesheet" href="wp-themes/css/terrarms_style.css"> <!-- style  -->
		<link rel="stylesheet" href="wp-themes/css/terrarms_font.css"> <!-- font -->
		<link rel="stylesheet" type="text/css" href="wp-themes/fontawesome-free-6.2.1-web/css/all.min.css">
		<link rel="stylesheet" href="wp-themes/css/swiper-bundle.min.css">   
		<script type="text/javascript" src="wp-themes/js/jquery-3.7.1.min.js"></script>
		<link rel="icon" href="wp-themes/img/terrarms_icon.png">

	    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDZBPqE-Q13QGC4dktqSACm-nDYTN01qGA
&libraries=drawing"></script>

		
	  	<script src="wp-themes/js/cam_reg.js"></script>
  		<script src="wp-themes/js/face-api.min.js"></script>		
		
		
	</head>
	<body>