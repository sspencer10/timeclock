<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Register";

if (isLoggedIn()) {
	echo "You are already registered. You will be redirected in 5 seconds.";
	header('refresh:3;url=index.php');
} else {

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['email'])) {
	$firstname = ($_POST['firstname']);
	$lastname = ($_POST['lastname']);
	$username = ($_POST['username']);
	$password = ($_POST['password']);
	$confirmPassword = ($_POST['confirmPassword']);
	$email = ($_POST['email']);

	if ((!empty($firstname)) && (!empty($lastname)) && (!empty($username)) && (!empty($password)) && (!empty($confirmPassword)) && (!empty($email))) {
		if ($password == $confirmPassword) {
			if (!isRegisteredUser($username)) {
				if (!isEmailUsed($email)) {
					$query = "INSERT INTO users(firstname, lastname, username, password, email) VALUES ('".mysql_real_escape_string($firstname)."','".mysql_real_escape_string($lastname)."','".mysql_real_escape_string($username)."','".md5(mysql_real_escape_string($password))."','".mysql_real_escape_string($email)."')";
					if ($result = mysqli_query($connect, $query)) {
						header('Location: register.php?msg=1');
					} else {
						header('Location: register.php?msg=2');
					}
				} else {
					header('Location: register.php?msg=3');
				}
			} else {
				header('Location: register.php?msg=4');
			}
		} else {
			header('Location: register.php?msg=5');
		}
	} else {
		header('Location: register.php?msg=6');
	}
}

include 'header.php';
?>
<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
	<div class="message">
		<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 1) {
				echo "<div class='message success'><span>Success: </span>Registration successful. Please check your email to activate your account. You may then <a href='login.php'>login</a>.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 2) {
				echo "<div class='message error'><span>Error: </span>Error submitting registration info.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 3) {
				echo "<div class='message warning'><span>Warning: </span>That email is already in use. Please select another.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 4) {
				echo "<div class='message warning'><span>Warning: </span>That username is already in use. Please try again.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 5) {
				echo "<div class='message warning'><span>Warning: </span>Your two passwords do not match. Please try again.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 6) {
				echo "<div class='message warning'><span>Warning: </span>One or more required fields are missing.<span class='closeAlert'>X</span></div>";
			}
		}
		?>
	</div>
	<h2>Register</h2>
			<fieldset>
				<legend>Personal Info:</legend>
					<p>
						<label>First Name: </label>
						<input type="text" name="firstname" maxlength="32" required value="<?php if(isset($_POST['firstname'])) { echo $_POST['firstname']; } ?>"/>
					</p>
					<p>
						<label>Last Name: </label>
						<input type="text" name="lastname" maxlength="32" required value="<?php if(isset($_POST['lastname'])) { echo $_POST['lastname']; } ?>" />
					</p>
				</fieldset>
				<br>
				<fieldset>
					<legend>Account Info: </legend>
					<p>
						<label>Username: </label>
						<input type="text" name="username" maxlength="32" required value="<?php if(isset($_POST['username'])) { echo $_POST['username']; } ?>" />
					</p>
					<p>
						<label>Password: </label>
						<input type="password" name="password" maxlength="32" required />
					</p>
					<p>
						<label>Confirm Password: </label>
						<input type="password" name="confirmPassword" maxlength="32" required />
					</p>
					<p>
						<label>Email Address: </label>
						<input type="email" name="email" maxlength="64" required value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>" />
					</p>
				</fieldset>
				<br>
				<input type="submit" value="Register" />
			</fieldset>
</form>
<?php
}
include 'footer.php';
?>