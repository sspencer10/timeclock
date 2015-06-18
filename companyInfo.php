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
			else if ($msg == 2) {
				echo "<div class='message error'><span>Error: </span>An error occurred while updating your company information.</div>";
			}
		}
		?>
		<p>Changing this value will update the "Company Name" section for all user profiles.</p>
			<form action="companyInfo.php" method="POST"> 
				<p>
					<label>Company Name: </label><input type="text" name="companyName" size="30" value="<?php $p = json_decode(file_get_contents('companyName.json')); echo $p; ?>"><br><br>
					<input type="submit" value="Update" />
				</p>
			</form>
		<hr>
			<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 3) {
				echo "<div class='message success'><span>Success: </span>Your image was successfully uploaded.</div>";
			}
			else if ($msg == 4) {
				echo "<div class='message error'><span>Error: </span>Your image was not uploaded. Check the file size and image type, and try again.</div>";
			}
		}
		?>
		<div class="time">
			<h2>Company Logo</h2>
			<p>Current company logo:<br><br>
				<img src="uploads/companyLogo.jpg" />
			</p>
		</div>
		<div class="notification">
			<form id="form" action="imageUpload.php" method="post"enctype="multipart/form-data">
				<div id="upload">
					<input type="file" name="file" id="file"/>
				</div>
				<br/>
				<input type="submit" id="submit" name="submit" value="Upload"/><br><br>
			</form>
			<div id="detail"><b>Note:</b><br/>
				<ul>
					<li>You can upload <b>images (jpeg,jpg).</b></li>
					<li>Image should be less than 500kb in size.</li>
				</ul>
			</div>
		</div>	
		<div class="clear"></div>
	<?php
	include 'footer.php';
	?>