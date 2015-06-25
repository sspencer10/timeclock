<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn()) {
    
} else {
    header('Location: index.php');
    die();
}

if(isset($_POST['clockIn'])) {
	$id = mysql_real_escape_string($_POST['clockIn']);
	$time = getdate();

	$result2 = mysqli_query($connect,"SELECT * FROM time_entries WHERE timeOut = 0 AND user_id =".$_SESSION['user_id']."");
  	$row = mysqli_num_rows($result2);

  	if ($row == 0) {
		$query = "INSERT INTO time_entries(user_id,timeIn) VALUES ('".$_SESSION['user_id']."','".$time['0']."')";
		if (mysqli_query($connect, $query)) {
	 		header('Location: index.php');
		}
	} else {
  		header('Location: index.php?msg=2');
  }
}

?>