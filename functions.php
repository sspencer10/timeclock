<?php
session_start();

date_default_timezone_set('America/Boise');

function isLoggedIn() {
	if (isset($_SESSION['user_id'])) {
		return true;
	}
}

function clean($data) {
	return mysql_real_escape_string($data);
}

function getFullNameFromID($id) {
	global $connect;
	// get the first name using that user's session ID
	$query = "SELECT firstname,lastname FROM users WHERE id='".$id."'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo $row['firstname'] . " " . $row['lastname'];
}

function getFirstName() {
	global $connect;
// get the first name using that user's session ID
	$query = "SELECT firstname FROM users WHERE id='".$_SESSION['user_id']."'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo $row['firstname'];
}

function isRegisteredUser($username) {
	global $connect;
// run this function to determine whether or not this username has already been used
	$query = "SELECT username FROM users WHERE username='".$username."'";
		if ($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row_count = mysqli_num_rows($result) == 1) {
			return true;
		} else {
			return false;
		}
	}
}

function isEmailUsed($email) {
	global $connect;
// run this function to determine whether or not this email address is already in the database.
	$query = "SELECT email FROM users WHERE email='".$email."'";
		if ($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row_count = mysqli_num_rows($result) == 1) {
			return true;
		} else {
			return false;
		}
	}
}

function isAdministrator() {
	global $connect;
// run this function to determine whether or not this email address is already in the database.
	$query = "SELECT isAdmin FROM users WHERE id='".$_SESSION['user_id']."'";
		if ($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row['isAdmin'] == 1) {
			return true;
		} else {
			return false;
		}
	}
}

function updateLastLogin() {
	global $connect;
	$time = getdate();
	$query = "UPDATE users SET lastLogin='".$time['0']."' WHERE id='".$_SESSION['user_id']."'";
	$result = mysqli_query($connect, $query);
}

function getLastLogin() {
	global $connect;
	$query = "SELECT lastLogin FROM users WHERE id='".$_SESSION['user_id']."'";
	if ($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row['lastLogin'] != 0) {
			return date('m/d/y h:i:s a', $row['lastLogin']);
		} else {
			return "User account not activated";
		}
	} else {
		return "Error retrieving last login";
	}
}

function getLastLoginById($id) {
	global $connect;
	$query = "SELECT lastLogin FROM users WHERE id='".$id."'";
	if ($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if ($row['lastLogin'] != 0) {
			return date('m/d/y h:i:s a', $row['lastLogin']);
		} else {
			return "User account not activated";
		}
	} else {
		return "Error retrieving last login";
	}
}
?>