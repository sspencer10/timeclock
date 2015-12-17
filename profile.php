<?php
require 'connect.php';
require 'functions.php';

if (!isLoggedIn()) {
	include 'login.php';
	die();
}
$pageTitle = "Profile";
include 'header.php';

if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['city']) && isset($_POST['state']) && isset($_POST['zip']) && isset($_POST['country']) && isset($_POST['department']) && isset($_POST['phone'])) {
	if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['department']) && !empty($_POST['phone'])) {
  		$query = "UPDATE users SET firstname = '".$_POST['firstname']."',lastname = '".$_POST['lastname']."',email = '".$_POST['email']."',address = '".$_POST['address']."',city = '".$_POST['city']."',state = '".$_POST['state']."',zip = '".$_POST['zip']."',country = '".$_POST['country']."',department = '".$_POST['department']."',phone = '".$_POST['phone']."' WHERE id=".$_POST['id'];
  		if ($result = mysqli_query($connect, $query)) {
			header('Location:profile.php?msg=2');
		}
		else {
			header('Location:profile.php?msg=3');
		}
	} else {
		header('Location:profile.php?msg=1');
	}
}

$query = "SELECT * FROM users WHERE id = ".$_SESSION['user_id'];
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

?>
	<h2><?php echo getFirstName($_SESSION['user_id']); ?>'s Profile</h2>	
	<div class="message">
		<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 1) {
				echo "<div class='message error'><span>Error: </span>One or more required fields below were left empty.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 2) {
				echo "<div class='message success'><span>Success: </span>Your profile has been successfully updated.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 3) {
				echo "<div class='message error'><span>Error: </span>An error occurred with the database.<span class='closeAlert'>X</span></div>";
			}
		}
		?>
	</div>
<form method="POST" action="profile.php">
	<fieldset>
		<legend>Personal Information</legend>
		<p>
			<label>First Name:</label>
			<input name="firstname" maxlength="32" value="<?php echo $row['firstname'] ?>" />
		</p>
		<p>
			<label>Last Name:</label>
			<input name="lastname"  maxlength="32"value="<?php echo $row['lastname'] ?>" />
		</p>
		<p>
			<label>E-mail:</label>
			<input name="email"  maxlength="64" value="<?php echo $row['email'] ?>" />
		</p>
	</fieldset>
	<br>
	<fieldset>
		<legend>Address Information</legend>
		<p>
			<label>Address:</label>
			<input name="address"  maxlength="32" value="<?php echo $row['address'] ?>" />
		</p>
		<p>
			<label>City:</label>
			<input name="city" maxlength="32" value="<?php echo $row['city'] ?>" />
		</p>
		<p>
			<label>State:</label>
			<input name="state"  maxlength="2" value="<?php echo $row['state'] ?>" />
		</p>
		<p>
			<label>ZIP:</label>
			<input name="zip" maxlength="5" value="<?php echo $row['zip'] ?>" />
		</p>
		<p>
			<label>Country:</label>
			<input name="country" value="<?php echo $row['country'] ?>" />
		</p>
	</fieldset>
	<br>
	<fieldset>
		<legend>Company Info</legend>
		<p>
			<strong>Supervisor: </strong><?php if (!empty($row['currentSupervisor'])) { echo $row['currentSupervisor']; } else { echo "None provided."; } ?>
		</p>
		<p>
			<strong>Company:</strong>
			<?php $p = json_decode(file_get_contents('companyName.json')); echo $p; ?>
		</p>
		<p>
			<label>Department:</label>
			<input name="department" maxlength="32" value="<?php echo $row['department'] ?>" />
		</p>
		<p>
			<label>Phone:</label>
			<input name="phone" maxlength="14" value="<?php echo $row['phone'] ?>" />
		</p>
		<hr>
		<p>
			<strong>Current Pay Rate: </strong><?php if (!empty($row['payRate'])) { echo "$".$row['payRate']."/hr"; } else { echo "None provided."; } ?>
			<br><small>If you believe an error has been made as to your pay rate, please speak with your supervisor.</small>
		</p>
		<input id="where" type="hidden" name="id" value="<?php echo $row['id'] ?>" />
	</fieldset>
	<br>
	<input type="submit" value="Update Profile" />
</form>
<p id="notice"></p>
<small><strong>Last login: </strong><?php echo getLastLogin(); ?>.</small>

<?php
include 'footer.php';
?>