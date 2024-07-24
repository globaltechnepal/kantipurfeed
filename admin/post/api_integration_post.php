<?php

$INPUT = $_SERVER['REQUEST_METHOD'];

if ($INPUT=='POST') { 

	$ID = (isset($_POST['id']) ? $_POST['id'] : null);
	$DELETE = "DELETE FROM api WHERE id='$ID'";
	$RESULT = $OMS->OMS_EXECUTE($DELETE);

    if ($RESULT == 1) {
                echo "<script> alert(\"API deleted successfully.\"); </script>";
    } else {
                echo "<script> alert(\"API deletion Failed.\"); </script>";
    }

}            
	
?>