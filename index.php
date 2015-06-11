<?php
require 'connect.php';
require 'functions.php';

if (!isLoggedIn()) {
	$pageTitle = "Login";
	include 'login.php';
	die();
}
$pageTitle = "Home";
include 'header.php';
?>
		Welcome, <?php echo getFirstName(); ?>. You are now logged in.<br><br>
		<small><strong>Last login: </strong><?php echo getLastLogin(); ?>.</small>
<?php
include 'footer.php';
?>