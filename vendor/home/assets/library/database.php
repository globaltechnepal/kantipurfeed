<?php
include "function_here.php";
function dbConnecting()
{
    // $hostname = 'localhost';
    // $username = 'root';
    // $password = '';
    // $database = 'delinepal';
    // $conn = mysqli_connect($hostname, $username, $password, $database);


    //   server user name 
      $servername = 'localhost';
    $username = 'kantipurfeed_delinepalUser';
    $password = '%pY9Kby9*k6b';
    $dbname = 'kantipurfeed_delinepal';
      $conn = mysqli_connect($servername, $username, $password, $dbname);
    // echo "db connection in progresss";
    if (!$conn) {
        echo "unable to connect database";
        die();
    } else {
        return $conn;
    }
}

if(isset($_POST["vendor_change_password"])){
    $newPass = md5($_POST['vendor_change_password']);
    $userEmail = $_POST['userEmail'];
    $oldPass = md5($_POST['oldPass']);
    if($newPass==""||$userEmail==""||$oldPass==""){
        return false;
    }
    else{
        $check_qry = "SELECT IF (EXISTS(SELECT * FROM vendor_users WHERE `vendor_email`='$userEmail' AND `vendor_pass`='$oldPass'),1,0)as result;";
        $check_req = check_if_exist($check_qry);
        if($check_req==0){
         $response = array(
        'message' => 'unknown',
        'status_code' => '404',
        'message_2' =>'Old Password didt match'
         );
         echo json_encode($response);
     }
     else if($check_req==1){
      $vendor_update_password_qry = "UPDATE `vendor_users` SET`vendor_pass`='$newPass' WHERE `vendor_email` = '$userEmail';";  
      $conn=  dbConnecting();
      $changepassReq = mysqli_query($conn, $vendor_update_password_qry);
            if ($changepassReq) {
                $response = give_response(200);
                echo json_encode($response);
            } else {
                $msg = mysqli_error($conn);
                $code = check_ecxeptions($msg);
                $response = give_response($code);
                echo json_encode($response);
            }
     }
   }
}
?>