<?php
require 'connect.php';
require 'functions.php';

if (!isLoggedIn()) {
	include 'login.php';
	die();
}
$pageTitle = "Profile";
include 'header.php';

$query = "SELECT * FROM users WHERE id = ".$_SESSION['user_id'];
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);

?>
	<h2><?php echo getFirstName(); ?>'s Profile</h2>
	<p>To change your personal information, click inside any of the fields. <u>Your information will be saved automatically.</u></p>	

<form id="ajax-form" class="autosubmit" method="POST" action="updateProfile.php">
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
			<strong>Supervisor: </strong>
			<?php
			if (!empty($row['currentSupervisor'])) { echo $row['currentSupervisor']; } else { echo "None provided."; } ?>
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
		<input id="where" type="hidden" name="id" value="<?php echo $row['id'] ?>" />
	</fieldset>
</form>
<p id="notice"></p>
<small><strong>Last login: </strong><?php echo getLastLogin(); ?>.</small>

<?php
include 'footer.php';
?>


















<?php
include 'footer.php';
?>