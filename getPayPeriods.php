<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Edit Time";

if (isLoggedIn()) {
	
} else {
	header('Location: index.php');
	die();
}

if (isset($_POST['firstDate'])) {
	$firstDate = $_POST['firstDate'];
} else {
	$firstDate = getCurrentPayPeriodStartDate();
}

echo "<table id=\"timeEntries\">
<tr>
    	<th>In Time</th>
    	<th>Out Time</th>
    	<th>Total Hours</th>
    	<th>Edit</th>
    </tr>";

$query = "SELECT id,timeIn,timeOut FROM time_entries WHERE user_id = '".$_SESSION['user_id']."' AND timeIn >= '".strtotime($firstDate)."' AND timeOut <= '".(strtotime($firstDate) + (getPayPeriodLength() * 86400))."' ORDER BY id ASC";
		if ($result = mysqli_query($connect,$query)) {
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				echo "<tr>";
				echo "<td>".date('D, M j, Y, g:i a', $row['timeIn'])."</td>";
				if ($row['timeOut'] < $row['timeIn']) {
					echo "<td></td>";
				} else {
					echo "<td>".date('D, M j, Y, g:i a', $row['timeOut'])."</td>";
				}
				
				if ($row['timeOut'] < $row['timeIn']) {
					echo "<td></td>";
				} else {
					echo "<td>".round((($row['timeOut'] - $row['timeIn'])/3600),2)."</td>";
				}
				if (!empty($row['timeOut']) && !empty($row['timeIn'])) {
					if ((date('Y-m-d', $row['timeOut']) < getCurrentPayPeriodStartDate())) {
					echo "<td><form action='editTime.php' method='POST'><input type='hidden' name='timeID' value='".$row['id']."' /><input disabled type='submit' value='Edit' /></form></td>";
					} else {
						echo "<td><form action='editTime.php' method='POST'><input type='hidden' name='timeID' value='".$row['id']."' /><input type='submit' value='Edit' /></form></td>";
					}
				} else {
					echo "<td></td>";
				}
				echo "</tr>";
			}
		} else {
			echo "Error retrieving information from database.";
		}
		echo "</table><p class='largeText'>Total hours worked this pay period: <span><strong>";
		
		totalHoursWorked($_SESSION['user_id'], strtotime($firstDate), (strtotime($firstDate) + (getPayPeriodLength() * 86400)));
		echo "</strong></span></p>";
		
?>