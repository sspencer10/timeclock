<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn() && isAdministrator()) {	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}
$pageTitle = "Search Employee Timecards";
include 'header.php';
?>

	<div class="time">
		<h2>Search Time Cards</h2>
		<br>
		<br><br>


		<form method="POST" id="myform" action="timeEmployee.php">
 			<label>Select User: </label>
 			<div class="float-right">
	 		<select name="user_id" id="selectUser">
	 		<?php
	 		$query = "SELECT id,firstname,lastname FROM users";
			if ($result = mysqli_query($connect,$query)) {
				while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					echo "<option name=\"id\" value='".$row['id']."'>".$row['firstname']." ".$row['lastname']."</option>";
				}
			} 
	 		?>
	 		</select>
	 	</div><br><br>

	 		 		
 		<label>Pay Period: </label>
 		
 			<div class="float-right">
	 		<select name="thing" id="payPeriod">
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
	 		<br><br>
	 		<div class="float-right">
	 		<input type="submit" id="submit" value="  Next   ">
		</form>
		
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
