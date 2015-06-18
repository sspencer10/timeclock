<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn()) {
    
} else {
    header('Location: index.php');
    die();
}

if(isset($_POST['clockIn'])) {
	$result = mysqli_query($connect, "SHOW TABLE STATUS LIKE 'time_entries'");
	$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$next_increment = $data['Auto_increment'];

	$id = mysql_real_escape_string($_POST['clockIn']);
	$time = getdate();

	$result2 = mysqli_query($connect,"SELECT timeOut FROM time_entries WHERE id = '".($next_increment - 1)."'");
  	$row = mysqli_fetch_array($result2,MYSQLI_ASSOC);

  	if (!empty($row['timeOut'])) {
		$query = "INSERT INTO time_entries(user_id,timeIn) VALUES ('".$_SESSION['user_id']."','".$time['0']."')";
		if (mysqli_query($connect, $query)) {
	 		header('Location: index.php');
		}
	} else {
  		header('Location: index.php?msg=2');
  }
}

?>