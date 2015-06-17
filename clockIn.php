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
  $query = "INSERT INTO time_entries(user_id,timeIn) VALUES ('".$_SESSION['user_id']."','".$time['0']."')";
  if ($result = mysqli_query($connect, $query)) {
 	header('Location: index.php');
 }
}

?>