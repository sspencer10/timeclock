<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Site-wide Message";
include 'header.php';

if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

if (isset($_POST['siteMessage']) && (!empty($_POST['siteMessage']))) {
	file_put_contents('siteMessage.json', json_encode($_POST['siteMessage']));
}

?>

	<h2>Site-wide Message</h2>
	<hr>
	<form action="siteMessage.php" method="POST" enctype="multipart/form-data"> 
		<p>Enter a message below, and it will be updated for all users in the "Messages" section of their homepage. On the right will show you how your message will be displayed.</p>
		<div class="time">
		<textarea name="siteMessage"><?php $p = json_decode(file_get_contents('siteMessage.json')); echo $p; ?></textarea><br>
		<small><strong>HTML tags <u>are</u> allowed.</strong></small><br>
		<input type="submit" value="Update Message" />
	</form>
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