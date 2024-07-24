<?php

/* Get the name of the uploaded file */
$filename = $_FILES['file']['name'];
$receive = $_REQUEST['folderDisplayid'];
$receiveName = $_REQUEST['folderDisplayName'];
// $receiveVerientID = $_REQUEST['folderVerientid'];

/* Choose where to save the uploaded file */
$location = "../../images/products/" . $receiveName; //to make folder $receive i.e. product id folder
echo $location;
if (!is_dir($location)) {
  mkdir($location, 0755);
  // echo "new directory made";
}
$location = "../../images/products/" . $receiveName . "/" . $receive; //to make verient id folder
echo $location;
if (!is_dir($location)) {
  mkdir($location, 0755);
  // echo "new directory made";
}
if (move_uploaded_file($_FILES['file']['tmp_name'], $location . "/" . $filename)) {
  return true;
}
else {
  return false;
}
?>