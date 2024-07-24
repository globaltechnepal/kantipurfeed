<?php
include 'library.php';

//response catcher for email verification
//response catcher for email verification
if(isset($_POST['reset_password'])){
    //code to verify email
    $email = $_POST['reset_password'];
    $response = '';
    $check_exist = "SELECT IF (EXISTS (SELECT * FROM `users` WHERE `email`='$email'),1,0)as result;";
    if(check_if_exist($check_exist)){
    $check_if = "SELECT IF (EXISTS (SELECT * FROM `users` WHERE `email`='$email' and `user_state`='verified'),1,0)as result;";
        if(check_if_exist($check_if)){
            $update_query="UPDATE `users` SET `user_state`='not verified',`remarks`='inactive' WHERE `email`='$email';";
            run_update_query($update_query);
        }
        if(send_verify_code($email)){
            $success = array(
              'message' => 'success',
              'status_code' => '200',
              'message_2' => 'verification code sent'
            );
            $response = $success;
        }else{
            $check_if = "SELECT IF (EXISTS (SELECT * FROM `users` WHERE `email`='$email' and `user_state`='not verified'),1,0)as result;";
            if(check_if_exist($check_if)){
                $update_query="UPDATE `users` SET `user_state`='verified',`remarks`='active' WHERE `email`='$email';";
                run_update_query($update_query);
            }
            $failure = array(
              'message' => 'failure',
              'status_code' => '201',
              'message_2' => 'cannot send verification code'
            );
            $response = $failure;
        } 
    }else{
        $failure = array(
          'message' => 'failure',
          'status_code' => '201',
          'message_2'=>'email not found'
        );
        $response = $failure;
    }
    echo json_encode($response);
}
//response catcher for email verification
//response catcher for email verification


//response catcher for password reset
//response catcher for password reset
if(isset($_POST['change_password'])){
    $email = $_POST['change_password'];
    $newPass = $_POST['newPass'];
    $response='';
    $result = changePassword($email,$newPass);
    if($result){
        $success = array(
              'message' => 'success',
              'status_code' => '200',
              'message_2' => 'Password Change Successful'
            );
            $response = $success;
    }else{
        $failure = array(
              'message' => 'failure',
              'status_code' => '201',
              'message_2' => 'Cannot Change Password'
            );
            $response = $failure;
    }
    echo json_encode($response);
}



if(isset($_POST['change_admin_password'])){
    $email = $_POST['change_admin_password'];
    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $response='';
    $result = change_admin_Password($email,$oldPass,$newPass); //echo "result :".$result;
    if($result){
        $success = array(
              'message' => 'success',
              'status_code' => '200',
              'message_2' => 'Password Change Successfully'
            );
            $response = $success;
    }else{
        $failure = array(
              'message' => 'failure',
              'status_code' => '201',
              'message_2' => 'Unable to Change Password'
            );
            $response = $failure;
    }
    echo json_encode($response);
}
//response catcher for password reset
//response catcher for password reset



?>