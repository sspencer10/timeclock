<?php
require_once 'connect.php';
require_once 'functions.php';
include 'header.php';
$pageTitle = "User Administrator Panel";

if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}?>
<h2>User Administration</h2>
<hr><br>
<label>Filter Results: </label><input type="search" id="searchf" placeholder="Search"/><br><br>
<hr />
<?php
$query = "SELECT id,firstname,lastname,currentSupervisor,department,activated,isAdmin FROM users";
if ($result = mysqli_query($connect,$query)) {
	echo "<table id='users' class='bordered'>";
	echo "<tr><th>Name</th><th>Supervisor</th><th>Department</th><th>Account Status</th><th>Privileges</th><th>Actions</th>";
	while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
		echo "<tr>";
		echo "<td>".ucfirst($row['firstname']) . " " . ucfirst($row['lastname']) . "</td>";
		if ($row['currentSupervisor'] == '-Select Supervisor-') { echo "<td>(None selected)</td>"; } else { echo "<td>".ucfirst($row['currentSupervisor'])."</td>"; }
		echo "<td>".ucfirst($row['department'])."</td>";
		if ($row['activated'] == 1) { echo "<td>Active</td>"; } else { echo "<td>Inactive</td>"; }
		if ($row['activated'] == 0) {
			echo "<td>Disabled</td>";
		} else {
			if ($row['isAdmin'] == 1) {
				echo "<td>Admin</td>";
			} else {
				echo "<td>Standard</td>";
			}
		}
			echo "<td><form action='editUser.php' method='POST'><input type='hidden' name='edit_id' value='".$row['id']."' /><input type='submit' value='View/Edit' /></form><form action='delete.php' method='POST'><input type='hidden' name='delete_id' value='".$row['id']."' /><input type='submit' value='Delete' onclick=\"return confirm('Are you sure you want to delete this user? This action cannot be undone.');\" ></form></td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Error retrieving information from database.";
}
?>

<?php
	include 'footer.php';
?>