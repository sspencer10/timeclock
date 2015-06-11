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
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
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
									<li><a href='import.php'>Import</a></li>
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
