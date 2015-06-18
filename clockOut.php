<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn()) {
    
} else {
    header('Location: index.php');
    die();
}

if(isset($_POST['clockOut'])) {
	$result = mysqli_query($connect, "SHOW TABLE STATUS LIKE 'time_entries'");
	$data = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$next_increment = $data['Auto_increment'];
	echo $next_increment-1;

  	$time = getdate();
	$result = mysqli_query($connect,"SELECT timeOut FROM time_entries WHERE id = '".($next_increment - 1)."'");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	if (empty($row['timeOut'])) {
  		$query = "UPDATE time_entries SET timeOut = '".$time['0']."' WHERE id = '".($next_increment - 1)."'";
		if (mysqli_query($connect, $query)) {
	 		header('Location: index.php');
 		}
  } else {
  	header('Location: index.php?msg=1');
  }
}

?>