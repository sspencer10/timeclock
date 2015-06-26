<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn() && isAdministrator()) {
    
} else {
    echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
    header('refresh:5,url=index.php');
    die();
}

if(isset($_POST["content_txt"]) && strlen($_POST["content_txt"]) > 0) {
	$contentToSave = filter_var($_POST["content_txt"],FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
} elseif(isset($_POST["recordToDelete"]) && strlen($_POST["recordToDelete"])>0 && is_numeric($_POST["recordToDelete"])) {
	$idToDelete = $_POST['recordToDelete'];
	$delete_row = mysqli_query($connect, "DELETE FROM time_entries WHERE id=".$idToDelete);
	if(!$delete_row) {    
		header('HTTP/1.1 500 Could not delete record!');
		exit();
	}
} else {
	//Output error
	header('HTTP/1.1 500 Error occurred, Could not process request!');
    exit();
}
?>