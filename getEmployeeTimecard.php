<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Edit Time";

if (isLoggedIn() && isAdministrator()) {	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

if (isset($_POST['firstDate'])) {
	$firstDate = $_POST['firstDate'];
} else {
	$firstDate = getCurrentPayPeriodStartDate();
}


$id2 = $_POST['user_id'];
$firstDate = $_POST['thing'];


$query = "SELECT id,timeIn,timeOut,status FROM time_entries WHERE user_id = '".$id2."' AND timeIn >= '".strtotime($firstDate)."' AND timeOut <= '".(strtotime($firstDate) + (getPayPeriodLength() * 86400))."' ORDER BY id ASC";
		


			echo "Time Card for <strong>";
			getFirstName($_POST['user_id']);
			echo " ";
			getLastName($_POST['user_id']);
			echo "</strong>";
			
			

			?>
			<br><br>
			<?php

			echo "</table><span class='hoursWorked'>Pay Period: <span><strong>";
			echo $firstDate;
			echo "</span></strong></span><br><br>";
			echo "</table><span class='hoursWorked'>Total hours worked: <span><strong>";
			totalHoursWorked(($id2), strtotime($firstDate), (strtotime($firstDate) + (getPayPeriodLength() * 86400)));
			echo "</span></strong></span><br>";
			echo "<span class='hoursWorked'>Approved hours: <span><strong>";
			totalApprovedHours(($id2), strtotime($firstDate), (strtotime($firstDate) + (getPayPeriodLength() * 86400)));
			echo "</span></strong></span><br>";
			echo "<span class='hoursWorked'>Rejected hours: <span><strong>";
			totalRejectedHours(($id2), strtotime($firstDate), (strtotime($firstDate) + (getPayPeriodLength() * 86400)));
			echo "</strong></span></span></p>";	
		
?>