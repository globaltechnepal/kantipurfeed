<?php
/* Get the name of the uploaded file */

$filename = $_FILES['file']['name'];
$folderName = $_REQUEST['Updatefolderid'];
/* Choose where to save the uploaded file */
$location = "../../images/products/" . $folderName;
if (!is_dir($location)) {
  mkdir($location, 0755);
  // echo "new directory made";
}

/* Save the uploaded file to the local filesystem */
if (move_uploaded_file($_FILES['file']['tmp_name'], $location . "/" . $filename)) {
  return true;
}
else {
  return false;
}
?>