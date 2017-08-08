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

function getFirstName($id) {
	global $connect;
// get the first name using that user's session ID
	$query = "SELECT firstname FROM users WHERE id='".$id."'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo $row['firstname'];
}

function getLastName($id) {
	global $connect;
// get the first name using that user's session ID
	$query = "SELECT lastname FROM users WHERE id='".$id."'";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	echo $row['lastname'];
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
			return "User has never logged in.";
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
        $input  = htmlentities($input);
        $output = $input;
    }
    return $output;
}

function totalHoursWorked($id, $timeIn, $timeOut) {
	global $connect;
	$totalTime = 0;
	$query = "SELECT * from time_entries WHERE user_id=".$id." AND timeIn >= ".$timeIn." AND timeOut <= ".$timeOut." ";
	if ($result = mysqli_query($connect,$query)) {
		$query2 = "SELECT * from time_entries WHERE user_id=".$id." AND timeOut=0 ";
		$result2 = mysqli_query($connect,$query2);
		if (mysqli_num_rows($result2) == 1) {
			echo "Clocked in";
		} else {
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$time = $row['timeOut'] - $row['timeIn'];
				$totalTime += $time;
			}
		echo round(($totalTime/3600),2);
		}
	} else {
		echo "";
	}
}

function totalApprovedHours($id, $timeIn, $timeOut) {
	global $connect;
	$totalTime = 0;
	$query = "SELECT * from time_entries WHERE user_id=".$id." AND timeIn >= ".$timeIn." AND timeOut <= ".$timeOut." AND status=2";
	if ($result = mysqli_query($connect,$query)) {
		$query2 = "SELECT * from time_entries WHERE user_id=".$id." AND timeOut=0 ";
		$result2 = mysqli_query($connect,$query2);
		if (mysqli_num_rows($result2) == 1) {
			echo "Clocked in";
		} else {
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$time = $row['timeOut'] - $row['timeIn'];
				$totalTime += $time;
			}
		echo round(($totalTime/3600),2);
		}
	} else {
		echo "";
	}
}

function totalRejectedHours($id, $timeIn, $timeOut) {
	global $connect;
	$totalTime = 0;
	$query = "SELECT * from time_entries WHERE user_id=".$id." AND timeIn >= ".$timeIn." AND timeOut <= ".$timeOut." AND status=1";
	if ($result = mysqli_query($connect,$query)) {
		$query2 = "SELECT * from time_entries WHERE user_id=".$id." AND timeOut=0 ";
		$result2 = mysqli_query($connect,$query2);
		if (mysqli_num_rows($result2) == 1) {
			echo "Clocked in";
		} else {
			while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				$time = $row['timeOut'] - $row['timeIn'];
				$totalTime += $time;
			}
		echo round(($totalTime/3600),2);
		}
	} else {
		echo "";
	}
}

function getCurrentPayPeriod() {
	//gets the pay period pattern from JSON config file set by user
	$date = json_decode(file_get_contents('payPeriodConfig.json'), true);

	//gets pay period length from JSON config file set by user
	$periodLength = $date['length'];
	$now = new DateTime();

	$begin = new DateTime( date('o-m-d', $date['startDate']) );
	$end = new DateTime();

	$interval = DateInterval::createFromDateString('every '.$periodLength.' days');
	$period = new DatePeriod($begin, $interval, $end);

	return $period;
}

function getCurrentPayPeriodStartDate() {
	$periods = getCurrentPayPeriod();
	$periodArray = iterator_to_array($periods);
	$startDate = reset($periodArray);
	$endDate = end($periodArray);
	return $endDate->format("Y-m-d");
}

function getPayPeriodLength() {
	$date = json_decode(file_get_contents('payPeriodConfig.json'), true);
	return $date['length'];
}
?>

