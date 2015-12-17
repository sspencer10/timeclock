<?php

require_once 'connect.php';
print_r($_POST);

// if (isset($_POST['user_id']) && isset($_POST['firstname']) && (isset($_POST['lastname'])) && (isset($_POST['email'])) && (isset($_POST['activated'])) && (isset($_POST['isadmin'])) && (isset($_POST['department'])) && (isset($_POST['supervisor'])) && (isset($_POST['phone']))) {
	$firstname = ($_POST['firstname']);
	$lastname = ($_POST['lastname']);
	$email = ($_POST['email']);
	$activated = $_POST['activated'];
	$isAdmin = $_POST['isadmin'];
	$payRate = $_POST['payRate'];
	$department = $_POST['department'];
	$supervisor = $_POST['supervisor'];
	$phone = $_POST['phone'];
	$canreactivate = $_POST['canreactivate'];
	$issupervisor = $_POST['issupervisor'];
	$id = $_POST['user_id'];
	// if (!empty($id) && (!empty($firstname)) && (!empty($lastname)) && (!empty($email))) {
		$query = "UPDATE users SET firstname='".$firstname."',lastname='".$lastname."',email='".$email."',activated='".$activated."',canReactivate='".$canreactivate."',isAdmin='".$isAdmin."',department='".$department."',payRate='".$payRate."',currentSupervisor='".$supervisor."',phone='".$phone."',isSupervisor='".$issupervisor."' WHERE id='".$id."'";
		if ($result = mysqli_query($connect,$query)) {
			header('Location:adminUsers.php');
		} else {
			echo "Error updating user info. Wait 5 seconds and you will be returned to the main page.";
			header('Location:adminUsers.php');
		}
	//}
// }

?>