<?php
require_once 'connect.php';
require_once 'functions.php';

$pageTitle = "Employee Timecards";

if (isLoggedIn() && isAdministrator()) {	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}
include 'header.php';
?>
	<div class="time">
		<h2>Employee Time Card</h2>
		<br>
		<a href="searchTimecards.php"><input type="button" id="search" value="Search Timecards"></a>
		<br><br>

	<div id="timeEntries">
	<?php include 'getEmployeeTimecard.php'; ?>
	</div>
		</div>
		<div class="notification">
			<h2>Messages</h2>
			<hr>
			<?php $p = json_decode(file_get_contents('siteMessage.json')); echo "<p>".$p."</p>"; ?>
		</div>
		<div class="clear"></div>
<?php
include 'footer.php';
?>