<?php
require_once 'connect.php';
require_once 'functions.php';

if (isLoggedIn() && isAdministrator()) {
    
} else {
    echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
    header('refresh:5,url=index.php');
    die();
}

if(isset($_POST['delete_id']) && !empty($_POST['delete_id'])) {
  $id = mysql_real_escape_string($_POST['delete_id']);
  $result = mysqli_query($connect, "DELETE FROM users WHERE id=".$id);
  header('Location: adminUsers.php');
}

?>