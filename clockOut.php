<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn()) {
    
} else {
    header('Location: index.php');
    die();
}

if(isset($_POST['clockOut'])) {
	// $result = mysqli_query($connect, "SHOW TABLE STATUS LIKE 'time_entries'");
	// $data = mysqli_fetch_array($result,MYSQLI_ASSOC);
	// $next_increment = $data['Auto_increment'];
	// echo $next_increment-1;

  	$time = getdate();
	$result = mysqli_query($connect,"SELECT * FROM time_entries WHERE timeOut = 0 AND user_id =".$_SESSION['user_id']."");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$rowCount = mysqli_num_rows($result);
	if ($rowCount == 1) {
  		$query = "UPDATE time_entries SET timeOut = '".$time['0']."' WHERE id = '".$row['id']."'";
		if (mysqli_query($connect, $query)) {
	 		header('Location: index.php');
 		}
  } else {
  	header('Location: index.php?msg=1');
  }
}

?>