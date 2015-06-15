<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Company Information";
include 'header.php';

if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

if (isset($_POST['companyName']) && (!empty($_POST['companyName']))) {
	if (sanitize(file_put_contents('companyName.json', json_encode($_POST['companyName'])))) {
		header('Location:companyInfo.php?msg=1');
	} else {
		header('Location:companyInfo.php?msg=2');
	}
}

?>
	<h2>Company Info</h2>
	<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 1) {
				echo "<div class='message success'><span>Success: </span>Your company name has been updated.</div>";
			}
			else {
				echo "<div class='message error'><span>Error: </span>An error occurred while updating your company information.</div>";
			}
		}
	?>
	<p>Changing this value will automatically update the "Company Name" section for all user profiles.</p>
	<hr>
	<form action="companyInfo.php" method="POST"> 
		<p>
		<label>Company Name: </label><input type="text" name="companyName" value="<?php $p = json_decode(file_get_contents('companyName.json')); echo $p; ?>"><br><br>
		<input type="submit" value="Update" />
	</form>
<?php
	include 'footer.php';
?>