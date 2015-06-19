<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn() && isAdministrator()) {

} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

if ($result = mysqli_query($connect, "DELETE FROM supervisors")) {
	if ($result2 = mysqli_query($connect, "UPDATE users SET currentSupervisor = NULL")) {
		header('Location: manageSupervisors.php');
	}
} else {
	echo "We couldn't do this for you. Sorry about that, pal.";
}

?>