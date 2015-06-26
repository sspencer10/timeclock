<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

if(isset($_POST["id"]) && strlen($_POST["id"])>0 && is_numeric($_POST["id"])) {
	$id = $_POST['id'];
	$result = mysqli_query($connect, "UPDATE time_entries SET status = 1 WHERE id=".$id);
	if(!$result) {    
		header('HTTP/1.1 500 Could not update record!');
		exit();
	}
} else {
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}

?>