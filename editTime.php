<?php
require_once 'connect.php';
require_once 'functions.php';
$pageTitle = "Edit Time";

if (isLoggedIn()) {
	
} else {
	header('Location: index.php');
	die();
}

if(isset($_POST['timeID']) && !empty($_POST['timeID'])) {
  	$id = $_POST['timeID'];
  	$query = "SELECT * FROM time_entries WHERE id=".$id;
  	if ($result = mysqli_query($connect, $query)) {
		$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	}
}

if(isset($_POST['timeIn']) && isset($_POST['timeOut'])) {
	if (!empty($_POST['timeIn']) && !empty($_POST['timeOut'])) {
		if ($_POST['timeOut'] <= $_POST['timeIn']) {
			header('Location:index.php?msg=5');
			die();
		}
  		$query2 = "UPDATE time_entries SET timeIn = '".strtotime($_POST['timeIn'])."', timeOut = '".strtotime($_POST['timeOut'])."', comments='".$_POST['comments']."' WHERE id=".$_POST['id'];
  		if ($result2 = mysqli_query($connect, $query2)) {
			header('Location:index.php?msg=3');
		}
		else {
			header('Location:index.php?msg=4');
		}
	}
}

include 'header.php';
?>
<h2>Edit Time Entry</h2>
<hr>
<strong>Current Values:</strong><br>

<?php
echo "Time in: ".date('D, M j, Y, g:i a', $row['timeIn'])."<br>";
echo "Time out: ".date('D, M j, Y, g:i a', $row['timeOut']);
?>
<br><br>
<form action="editTime.php" method="POST">
<strong>Modify Values:</strong><br>
<label>Time in: </label><input type="datetime-local" name="timeIn" value="<?php echo date('Y-m-d\TH:i', $row['timeIn']); ?>"/><br><br>
<label>Time out: </label><input type="datetime-local" name="timeOut" value="<?php echo date('Y-m-d\TH:i', $row['timeOut']); ?>"/><br>
<input type="hidden" name="id" value="<?php echo $id; ?>"/><br>
Comments:<br><textarea id="comments" name="comments" class="comments" placeholder="Please provide a brief comment as to why you edited this entry." maxlength="150" required>
<?php if (isset($row['comments'])) { echo sanitize($row['comments']); }?>
</textarea><br>
<p>
	<input type="submit" value="Update" />
</p>
</form>
<?php
include 'footer.php';
?>