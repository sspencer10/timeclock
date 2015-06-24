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
		<div class="clockButtons">
			<form action='clockIn.php' method='POST'><input type='hidden' class='clockIn' name='clockIn' /><input type='submit' value='Clock In' /></form>
			<form action='clockOut.php' method='POST'><input type='hidden' class='clockOut' name='clockOut' /><input type='submit' value='Clock Out' /></form><br>
 		</div>
 		<br>
 		<div class="float-right">
 		<label>Pay Period: </label>
	 		<select id="payPeriod" onChange="getPayPeriodEntries(this.value)">
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
 		</div>
 		<div class="clear"></div>
 		<div class="message">
		<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 1) {
				echo "<div class='message error'><span>Error: </span>You cannot clock out until you have first clocked in.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 2) {
				echo "<div class='message error'><span>Error: </span>You cannot clock in again until you have first clocked out.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 3) {
				echo "<div class='message success'><span>Success: </span>Time entry successfully modified.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 4) {
				echo "<div class='message error'><span>Error: </span>There was an error modifying your time entry.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 5) {
				echo "<div class='message error'><span>Error: </span>You cannot select a negative time. Your entry has not been modified.<span class='closeAlert'>X</span></div>";
			}
		}
		?>
	</div>
	<div id="timeEntries">
	<?php include 'getPayPeriods.php'; ?>
	</div>
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