<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Manage Supervisors";
include 'header.php';

if (isLoggedIn() && isAdministrator()) {
	
} else {
	echo "Access prohibited. Please make sure that you are an administrator before trying to view this page. You will now be redirected.";
	header('refresh:5,url=index.php');
	die();
}

if (isset($_FILES['csv']['tmp_name'])) {
	$file = $_FILES['csv']['tmp_name'];
if (($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
	        do { 
			if ($data[0]) { 
				mysqli_query($connect, "INSERT INTO supervisors (firstname, lastname) VALUES 
					( 
						'".sanitize($data[0])."', 
						'".sanitize($data[1])."' 
						) 
				");
			} 
		} while ($data = fgetcsv($handle,1000,",","'")); 
    }
    header('Location: manageSupervisors.php?msg=1');
    fclose($handle);
	}
}
?>

	<h2>Supervisor Manager</h2>
	<hr>
	<div class="time">
	<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 1) {
				echo "<div class='message success'><span>Success: </span>Your file was successfully uploaded.<span class='closeAlert'>X</span></div>";
			}
			else if ($msg == 2) {
				echo "<div class='message error'><span>Error: </span>There was a problem with the file upload.<span class='closeAlert'>X</span></div>";
			}
		}
	?>
	<form action="manageSupervisors.php" method="POST" enctype="multipart/form-data">
		<p>To upload a list of supervisors, structure your CSV as seen in the image below. The firstname should be in one single column, and the last name in another. Please don't include any column headers.</p>
		<p>Uploading additional files, one after another, will append the values to each other. Additionally, you can delete all supervisors from the list using the "Delete All Supervisors" button.</p>
		<img src="images/importStructure.png"/><br><br><br>
		Choose your file: <br /> 
		<input type="file" name="csv" id="csv" />
		<input type="submit" name="Submit" value="Submit" />
		<p style="color:red;">Upload file MUST be in .csv format</p>
	</form> 
	</div>
	<div class="notification">
	<h2>Current Supervisor List</h2>
	<hr>
	<div class="supervisorList">
	<?php
	$query = "SELECT id,firstname,lastname FROM supervisors";
	if ($result = mysqli_query($connect,$query)) {
		echo "<table>";
		echo "<tr><th>Supervisor</th><th>Action</th>";
		while ($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			echo "<tr>";
			echo "<td>".ucfirst($row['firstname']) . " " . ucfirst($row['lastname']) . "</td>";
			echo "<td><form action='deleteSupervisor.php' method='POST'><input type='hidden' name='delete_id' value='".$row['id']."' /><input type='submit' value='Delete' onclick=\"return confirm('Are you sure you want to delete this user? This action cannot be undone.');\" ></form></td>";
			echo "</tr>";
		}
		echo "</table></div>";
		echo "<br><form action='deleteAllSupervisors.php'><input type='submit' value='Delete All Supervisors' onclick=\"return confirm('Are you sure you want to delete all supervisors? This will delete all supervisors from the database. This action cannot be undone.');\" /></form>";
	} else {
		echo "Error retrieving information from database.</div>";
	}
	?>
	</div>
	<div class="clear"></div>
<?php
	include 'footer.php';
?>