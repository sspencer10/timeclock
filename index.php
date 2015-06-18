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
		<div class="time">
		<h2>Timesheets</h2>
		<hr>
		<form action='clockIn.php' method='POST'><input type='hidden' class='clockIn' name='clockIn' /><input type='submit' value='Clock In' /></form>
		<form action='clockOut.php' method='POST'><input type='hidden' class='clockOut' name='clockOut' /><input type='submit' value='Clock Out' /></form><br>
 		<div class="clear"></div>
 		<div class="message">
		<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 1) {
				echo "<div class='message error'><span>Error: </span>You cannot clock out until you have first clocked in.</div>";
			}
			else if ($msg == 2) {
				echo "<div class='message error'><span>Error: </span>You cannot clock in again until you have first clocked out.</div>";
			}
		}
		?>
	</div>
 		<table>
 			    <tr>
 			    	<th>In Time</th>
 			    	<th>Out Time</th>
 			    	<th>Total Hours</th>
 			    	<th>Edit</th>
 			    </tr>	    
 			    <?php
		$query = "SELECT id,timeIn,timeOut FROM time_entries WHERE user_id = '".$_SESSION['user_id']."'";
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
				echo "<td><form action='editTime.php' method='POST'><input type='hidden' name='timeID' value='".$row['id']."' /><input type='submit' value='Edit' /></form></td>";
				echo "</tr>";
			}
		} else {
			echo "Error retrieving information from database.";
		}
		?> 
				</table>
				<p class="largeText">Total hours worked this pay period: <span><strong><?php totalHoursWorked($_SESSION['user_id']) ?></strong></span></p>
		</div>
		<div class="notification">
			<h2>Messages</h2>
			<hr>
			<?php $p = json_decode(file_get_contents('siteMessage.json')); echo "<p>".$p."</p>"; ?>
		</div>
		<div class="clear"></div>
		<small><strong>Last login: </strong><?php echo getLastLogin(); ?>.</small>
<?php
include 'footer.php';
?>