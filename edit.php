<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Edit";

if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

if(isset($_POST['edit_id']) && !empty($_POST['edit_id'])) {
  	$id = mysql_real_escape_string($_POST['edit_id']);
  	$query = "SELECT * FROM users WHERE id=".$id;
  	mysqli_query($connect, $query);
  	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
}

include 'header.php';
?>
<h2>Edit <?php echo getFullNameFromID($id); ?>'s User Info</h2>
<a href="adminUsers.php"><- Back to all users</a><br><br>
<form method="POST" action="update.php">
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
		<p>
			<strong>Address: </strong><br>

			<?php
				if (!empty($row['address'])) {
					echo $row['address']."<br>".$row['city'].", ".$row['state']." ".$row['zip']."<br>";
				} else {
					echo "No address entered.";
				}
			?>
		</p>
	</fieldset>
	<br>
	<fieldset>
		<legend>Company Information</legend>
		<p>
			<label>Department:</label>
			<input name="department" maxlength="32" value="<?php echo $row['department'] ?>" />
		</p>
		<p>
			<label>Supervisor:</label>
			<select name="supervisor">
			<?php
			$query2 = "SELECT firstname,lastname FROM supervisors";
			$result2 = mysqli_query($connect,$query2);
			while ($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
			  echo "<option value='".ucfirst($row2['firstname'])." ".ucfirst($row2['lastname'])."'";
			  if (($row['currentSupervisor']) == ucfirst($row2['firstname'])." ".ucfirst($row2['lastname'])) {
			  	echo " selected=\"selected\">".ucfirst($row2['firstname'])." ".ucfirst($row2['lastname'])."</option>";
				} else {
				  echo ">".ucfirst($row2['firstname'])." ".ucfirst($row2['lastname'])."</option>";
				}
			}
			?>
			</select>
		</p>
		<p>
			<label>Phone:</label>
			<input name="phone"  maxlength="14" value="<?php echo $row['phone'] ?>" />
		</p>
		<p>
			<label>Current Pay Rate:</label>
			$<input type="text" name="payRate" size="4" maxlength="6" value="<?php echo $row['payRate'] ?>" />/hr
		</p>
	</fieldset>
	<br>
	<fieldset>
		<legend>Site Options</legend>
		<p>
			<label>User Account:</label><br><br>
			<input type="radio" id="activatedTrue" name="activated" <?php if ($row['activated'] == 1) echo 'checked'; ?> value="1"><label for="activatedTrue">Active</label>
			<input type="radio" id="activatedFalse" name="activated" <?php if ($row['activated'] == 0) echo 'checked'; ?> value="0"><label for="activatedFalse">Inactive</label>
		</p>
		<hr>
		<p class="canReactivate">
			<label>If account is disabled, can user can re-activate their account through e-mail?</label><br><br>
			<input type="radio" id="canReactivateTrue" name="canreactivate" <?php if ($row['canReactivate'] == 1) echo 'checked'; ?> value="1"><label for="canReactivateTrue">True</label>
			<input type="radio" id="canReactivateFalse" name="canreactivate" <?php if ($row['canReactivate'] == 0) echo 'checked'; ?> value="0"><label for="canReactivateFalse">False</label>
		</p>
		<hr>
		<p class="isAdmin">
			<label>Privileges:</label><br><br>
			<input type="radio" id="isAdminTrue" name="isadmin" <?php if ($row['isAdmin'] == 1) echo 'checked'; ?> value="1"><label for="isAdminTrue">Administrator</label>
			<input type="radio" id="isAdminFalse" name="isadmin" <?php if ($row['isAdmin'] == 0) echo 'checked'; ?> value="0"><label for="isAdminFalse">Standard</label>
		</p>
		<p><small><?php echo getFullNameFromID($id); ?> last logged in on <strong><?php echo getLastLoginById($id); ?></strong></small></p>
		<input type="hidden" name="user_id" value="<?php echo $id ?>" />
	</fieldset>
	<br>
	<input type="submit" value="Update User Info" />
</form>
<?php
include 'footer.php';
?>