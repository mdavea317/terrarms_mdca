	<div class="profile">
		  <div class="profile-name">
			<h3> Hi, <?php echo htmlspecialchars(ucwords(strtolower($_SESSION['first_nm']))) ?> </h3>
			<p> <?php echo $_SESSION['user_lvl']?> </p> <!-- pag click ng avatar, lalabas yung account settings and log-out -->
		  </div>
		  <a href="index.php?page=profile_info"> <img src="wp-themes/img/avatar_default.png" alt="Profile Picture" class="profile-picture"> </a>
		</div>