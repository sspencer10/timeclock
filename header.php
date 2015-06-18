<?php
require_once 'connect.php';
require_once 'functions.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<link href="styles.css" rel="stylesheet" type="text/css" />
	<meta name="viewport" content="initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="scripts.js"></script>
</head>
<body>
	<div id='cssmenu'>
		<ul>
		   <li><a href='index.php'><span>Home</span></a></li>
		   <?php if (!isLoggedIn()) { echo "<li><a href='register.php'>Register</a></li>"; } ?>
		   <?php if (isLoggedIn()) {
						if (isAdministrator()) {
							echo "<li class='has-sub'><a href='#'>Admin</a>
								<ul>
									<li><a href='adminUsers.php'>User Admin</a></li>
									<li><a href='manageSupervisors.php'>Supervisor Manager</a></li>
									<li><a href='siteMessage.php'>Site-wide Message</a></li>
									<li><a href='companyInfo.php'>Company Information</a></li>
								</ul>
							</li>";
						}
						echo "<li class='has-sub'><a href='profile.php'>Welcome, ";getFirstName()."</a>";
						echo "<ul>
						<li><a href='profile.php'>My Profile</a></li>
						<li><a href='logout.php'>Logout</a></li>
						</ul>";
			} ?>
		</ul>
	</div>
	<div class="container">
