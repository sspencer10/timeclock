<?php
require_once 'connect.php';
require_once 'functions.php';
if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

$id = $_POST['user_id'];
$dateFrom = $_POST['payPeriodDate'];
if (isset($_POST['dateTo'])) {
	$dateTo = $_POST['dateTo'];
	} else {
		$dateTo = (strtotime($dateFrom) + (getPayPeriodLength() * 86400)-86400);
	}

echo "<table>
		<tr>
		    	<th>In Time</th>
		    	<th>Out Time</th>
		    	<th>Total Hours</th>
		    	<th>Actions</th>
		    	<th>Comments</th>
		</tr>";

$query = "SELECT * FROM time_entries WHERE user_id = '".$id."' AND timeIn > ".strtotime($dateFrom)." AND timeOut < ".$dateTo." ORDER BY id ASC";
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
						echo "<td><form action='editTime.php' method='POST'><input type='hidden' name='timeID' value='".$row['id']."' /><input type='submit' value='Edit' /></form></td>";
				} else {
					echo "<td></td>";
				}
				if (empty($row['comments'])) {
					echo "<td></td>";
				} else {
					echo "<td><a href=\"#\" class=\"tooltip\"><img src='images/comment.png' height=\"30\" width=\"30\" /><span><strong>"; echo getFirstName($id); echo" wrote: </strong>".$row['comments']."</span></a></td>";
				}
				echo "</tr>";
			}
			echo "</table>";
		} else {
			echo "Error retrieving information from database.";
		}
		echo "</table>";
		echo "<p class='largeText'>Total hours worked: <span><strong>";
		totalHoursWorked($id, strtotime($dateFrom), $dateTo);
		echo "</strong></span></p>";
		
?>