<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Edit Time";

if (isLoggedIn()) {
	
} else {
	header('Location: index.php');
	die();
}

if(isset($_POST['timeID']) && !empty($_POST['timeID'])) {
  	$id = mysql_real_escape_string($_POST['timeID']);
  	$query = "SELECT * FROM time_entries WHERE id=".$id;
  	mysqli_query($connect, $query);
  	if ($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
}

include 'header.php';
?>
<h2>Edit Time Entry</h2>
<?php
echo "Time in: ".date('D, M j, Y, g:i a', $row['timeIn'])."<br>";
echo "Time out: ".date('D, M j, Y, g:i a', $row['timeOut']);
include 'footer.php';
?>