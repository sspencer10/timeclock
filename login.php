<?php

require_once 'connect.php';
require_once 'functions.php';
include 'header.php';

if (isLoggedIn()) {
	header('Location: index.php');
} else {

	if (isset($_POST['username']) && (isset($_POST['password']))) {

		$username = $_POST['username'];
		$password = $_POST['password'];

		if (!empty($username) && (!empty($password))) {
			$query = "SELECT id,username,password,activated,canReactivate FROM users WHERE username='".mysql_real_escape_string($username)."' AND password='".md5(mysql_real_escape_string($password))."'";
			if ($result = mysqli_query($connect, $query)) {
				$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				if ($row_count = mysqli_num_rows($result) == 1) {
					if ($row['activated'] == 1) {
						$_SESSION['user_id'] = $row['id'];
						updateLastLogin();
						header('Location: index.php');
					} else if ($row['activated'] == 0 && $row['canReactivate'] == 0) {
						header('Location: login.php?msg=12');
					}
					else {
						header('Location: login.php?msg=7');
					}
				} else {
					header('Location: login.php?msg=8');
				}
			} else {
				header('Location: login.php?msg=9');
			}
		} else {
			header('Location: login.php?msg=10');
		}
	}
}
?>
<div class="companyInfo">
	<h2>Welcome to the Time Tracking & Management System</h2>
	<p>If you have questions about time adjustments, payroll or work policies, please contact your payroll administrator or company help desk.</p>
</div>
<div class="login">
	<form action="login.php" method="POST" class="center">
			<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 7) {
				echo "<div class='message notice'><span>Notice: </span>Your account has not yet been activated. <a href='resendActivation.php'>Resend activation email</a>?<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 8) {
				echo "<div class='message error'><span>Error: </span>Invalid username or password. Please try again.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 9) {
				echo "<div class='message error'><span>Error: </span>There was a problem with the database query.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 10) {
				echo "<div class='message warning'><span>Warning: </span>One or more required fields were left blank.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 11) {
				echo "<div class='message notice'><span>Notice: </span>Activation e-mail sent. Please check your email.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 12) {
				echo "<div class='message error'><span>Error: </span>Your account has been disabled, and an administrator has not authorized you for reactivation.<span class='closeAlert'>X</span></div>";
			}
		}
		?>
		<h2>Login</h2>
			<p>
				<h3>User ID</h3>
				<input type="text" name="username" maxlength="32" required />
			</p>
			<p>
				<h3>Password</h3>
				<input type="password" name="password" maxlength="32" required />
			</p>
			<p>
				<button type="submit">Log In</button>
				<div class="clear"></div>
			</p>
			<p><a href="register.php" class="register">Create an account</a> | <a href="#" class="register">Trouble signing in?</a></p>
		</div>
	</form>
	<div class="clear"></div>
</div>