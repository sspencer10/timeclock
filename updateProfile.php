<?php

require_once 'connect.php';
require_once 'functions.php';

if (count($_POST)) {
	// Prepare form variables for database
	foreach($_POST as $column => $data)
		${$column} = clean($data);

	// Perform MySQL UPDATE
	$query = "UPDATE users SET ".$col."='".$val."' WHERE ".$w_col."='".$w_val."'";
	$result = mysqli_query($connect, $query) or die ('Unable to update row.');
}

?>