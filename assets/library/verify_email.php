<?php
include 'library.php';

//response catcher for email verification
//response catcher for email verification
if(isset($_POST['verify_email'])){
    //code to verify email
    $email = $_POST['verify_email'];
    $code = $_POST['verificationCode'];
    $response = '';
    if(verify_email($email,$code)){
        $success = array(
          'message' => 'success',
          'status_code' => '200'
        );
        $response = $success;
    }else{
        $failure = array(
          'message' => 'failure',
          'status_code' => '201'
        );
        $response = $failure;
    }
    echo json_encode($response);
}
//response catcher for email verification
//response catcher for email verification

?>