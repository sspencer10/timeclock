<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Import";
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
						'".addslashes($data[0])."', 
						'".addslashes($data[1])."' 
						) 
				"); 
			} 
		} while ($data = fgetcsv($handle,1000,",","'")); 
    }
    header('Location: import.php?msg=1');
    fclose($handle);
	}
}
?>

	<h2>Import</h2>
	<?php if(isset($_GET['msg'])) {
			$msg = $_GET['msg'];
			if ($msg == 1) {
				echo "<div class='message success'><span>Success: </span>Your file was successfully uploaded.</div>";
			}
			else if ($msg == 2) {
				echo "<div class='message error'><span>Error: </span>There was a problem with the file upload.</div>";
			}
		}
	?>
	<h3>Supervisor Import</h3>
	<form action="import.php" method="POST" enctype="multipart/form-data"> 
		Choose your file: <br /> 
		<input type="file" name="csv" id="csv" />
		<input type="submit" name="Submit" value="Submit" />
		<p>File MUST be in a .csv format</p>
	</form> 
<?php
	include 'footer.php';
?>