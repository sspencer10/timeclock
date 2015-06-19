<?php
if (isset($_POST['submit'])) {

    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);

    if ((($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 500000) && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            $temp = explode(".",$_FILES["file"]["name"]);
            $newfilename = "companyLogo" . '.' .end($temp);
            move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $newfilename);
            header('Location: siteConfiguration.php?msg=3');
            }
        } else {
            header('Location: siteConfiguration.php?msg=4');
        }
    }
?>