<?php

  $INPUT = $_SERVER['REQUEST_METHOD'];

  if ($INPUT=='POST') { 

     date_default_timezone_set('Asia/Kathmandu');
	$CREATED_DATE = date('Y-m-d H:i:s');

	$OLD_PASSWORD = (isset($_POST['oldPass']) ? $_POST['oldPass'] : null);
	$OLD_PASSWORD = md5($OLD_PASSWORD);
	$NEW_PASSWORD = (isset($_POST['newPass']) ? $_POST['newPass'] : null);
	$CONFIRM_PASSWORD = (isset($_POST['confirmnewPass']) ? $_POST['confirmnewPass'] : null);
	$EMAIL = (isset($_POST['id']) ? $_POST['id'] : null);
	
	if ($NEW_PASSWORD == $CONFIRM_PASSWORD) {
	    
        $DATA_BANK = $OMS->OMS_DATA('PASSWORD_INFO', $EMAIL);
            foreach ($DATA_BANK AS $ROW) {
            $PASSWORD = $ROW['admin_pass'];  
        }
        if ($PASSWORD == $OLD_PASSWORD){
	        $NEW_PASSWORD = md5($NEW_PASSWORD);
		    $UPDATE = "UPDATE admin SET 
				  admin_pass='$NEW_PASSWORD'		
				WHERE email='$EMAIL'";

	        $RESULT = $OMS->OMS_EXECUTE($UPDATE);
            if ($RESULT == 1) {
                echo "<script> alert(\"Password Changed Successfully.\"); </script>";
            } else {
                echo "<script> alert(\"Changing Password Failed.\"); </script>";
            }
        } else {
                echo "<script> alert(\"Old Password do not match.\"); </script>";
        }
        
	} else {
                echo "<script> alert(\"New Password and Confirm Password do not match.\"); </script>";
	}
		
	}
	
	?>