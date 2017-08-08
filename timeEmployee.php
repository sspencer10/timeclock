<?php
require_once 'connect.php';
include 'functions.php';
include 'header.php';

$pageTitle = "Employee Timecards";

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
?>

<h2>Search Employee Timecard</h2>
<hr><br>
		<form method="POST">
 			<label>Select User: </label>
	 		<select name="user_id" id="selectUser">
	 		<?php
	 		$query = "SELECT id,firstname,lastname FROM users";
			if ($result = mysqli_query($connect,$query)) {
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					echo "<option name=\"id\" value='".$row['id']."'>".$row['firstname']." ".$row['lastname']."</option>";
				}
			} else {
				echo "";
			}
	 		?>
	 		</select>
	 		<br><br>
			<label>Pay Period: </label>
	 		<select name="payPeriodDate" id="payPeriodDate" required>
	 		<option value='1971-01-01'>All Entries</option>
	 		<?php
	 		$period = getCurrentPayPeriod();
			foreach ($period as $dt) {
				echo "<option value='".$dt->format("Y-m-d")."'";
				if ($dt->format("Y-m-d") == getCurrentPayPeriodStartDate()) {
					echo " selected>".$dt->format("Y-m-d")." (Current)";
				} else {
					echo ">".$dt->format("Y-m-d")." (Past)";
				}
	  			echo "</option>";
				}

		 		?>
	 		</select>
	 		<br><br>
	 		<input type="submit" value="Search">
		</form>

		<br><br>

		<?php
			$id = $_POST['user_id'];
			echo "Time Card for ";
			getFirstName($_POST['user_id']);
			echo " ";
			getLastName($_POST['user_id']);
		?>

		<br><br>

		<?php
			echo "</table><span class='hoursWorked'>Total hours worked: <span><strong>";
			totalHoursWorked(($id), strtotime($firstDate), (strtotime($firstDate) + (getPayPeriodLength() * 86400)));
			echo "</span></strong></span><br>";
			echo "<span class='hoursWorked'>Approved hours: <span><strong>";
			totalApprovedHours(($id), strtotime($firstDate), (strtotime($firstDate) + (getPayPeriodLength() * 86400)));
			echo "</span></strong></span><br>";
			echo "<span class='hoursWorked'>Rejected hours: <span><strong>";
			totalRejectedHours(($id), strtotime($firstDate), (strtotime($firstDate) + (getPayPeriodLength() * 86400)));
			echo "</strong></span></span></p>";	
		?>
