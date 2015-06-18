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

function getSupervisorsList() {
	global $connect;
	$query = "SELECT firstname,lastname FROM supervisors";
	if ($result = mysqli_query($connect, $query)) {
		echo "<select size='6' multiple>";
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			echo "<option>".ucfirst($row['firstname'])." ".ucfirst($row['lastname'])."</option>";
		}
		echo "</select>";
	} else {
		return "Error retrieving last login";
	}
}

function cleanInput($input) {
 
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
 
    $output = preg_replace($search, '', $input);
    return $output;
}

function sanitize($input) {
    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = sanitize($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input  = cleanInput($input);
        $output = mysql_real_escape_string($input);
    }
    return $output;
}

function totalHoursWorked($id) {
	global $connect;

	// get next auto increment id of time_entries table
	$result3 = mysqli_query($connect, "SHOW TABLE STATUS LIKE 'time_entries'");
	$data = mysqli_fetch_array($result3,MYSQLI_ASSOC);
	$next_increment = $data['Auto_increment'];

	$totalHours = 0;
	$query = "SELECT timeIn,timeOut FROM time_entries WHERE user_id='".$id."'";
	if ($result = mysqli_query($connect, $query)) {
		$query2 = "SELECT timeIn,timeOut FROM time_entries WHERE user_id='".$id."' AND id=".($next_increment - 1)."";
		if ($result2 = mysqli_query($connect,$query2)) {
			$row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
			if (empty($row2['timeIn']) || empty($row2['timeOut'])) {
				echo "Time cannot be calculated until you clock out.";
			} else {
				while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
					$time = (($row['timeOut'] - $row['timeIn']));
					$totalHours += $time;
				}
				echo round(($totalHours/3600),2);
			} 
		} else {
			echo "Problem retrieving time from database.";
		}
	}
}

?>

