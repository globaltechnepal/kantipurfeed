<?php
include 'connect_server.php';
include 'functions_here.php';

if(isset($_POST["insert_data_into_admin"])){
    $username = $_POST['insert_data_into_admin'];
    $admEmail = $_POST['admEmail'];
    $Password = $_POST['Password'];
    $pass = md5($Password);
    $adminType = $_POST['adminType'];
    $admin='';
    $subAdmin='';
    if($adminType='admin'){
        $admin=1;
        $subAdmin=0;
    }else if($adminType='subadmin'){
        $admin=0;
        $subAdmin=1;
    }
    $id = get_primary_id("admin");
    $check_qry = "SELECT IF (EXISTS(SELECT * FROM admin WHERE `email`='$admEmail'),1,0)as result;";
    $result = check_if_exist($check_qry);
    if($result==1){
        $response = give_response(55);
        echo json_encode($response);
    }
    else if($result==0){
        $subadmin_query = "INSERT INTO `admin`(`id`, `active_state`, `username`, `email`, `admin_pass`, `admin`, `subAdmin`) VALUES ($id,1,'$username','$admEmail','$pass',$admin,$subAdmin);";
        // echo $subadmin_query;
            $conn = dbConnecting();
            $Res = mysqli_query($conn, $subadmin_query);
            $response='';
            if ($Res) {
                if(send_create_admin_user_email($admEmail,$adminType,$Password)){
                $response = array(
                    'message' => 'success',
                    'status_code' => '200',
                    'message_2'=>'mail sent'
                );
                }else{
                    $response = array(
                    'message' => 'success',
                    'status_code' => '200',
                    'message_2'=>'mail not sent'
                );
                }
                history_table($subadmin_query, true);
                echo json_encode($response);
            } else {
                $msg = mysqli_error($conn);
                $code = check_ecxeptions($msg);
                history_table($subadmin_query, false);
                $response = give_response($code);
                echo json_encode($response);
            }
    }
}

if(isset($_POST['toggle_active'])){
    $state_is=$_POST['toggle_active'];
    $email = $_POST['user_email'];
    $update_ok = run_toggal_state($state_is,$email);
    $response='';
    if($update_ok){
        $response = array(
        'message' => 'success',
        'status_code' => '200'
    );
    }else{
        $response =array(
        'message' => 'failure',
        'status_code' => '201'
    );
    }
    echo json_encode($response);
}

function run_toggal_state($state_is,$email){
    if($state_is){
        $check_qry = "SELECT IF (EXISTS(SELECT * FROM admin WHERE `email`='$admEmail' and `active_state`=$state_is),1,0)as result;";
        $result = check_if_exist($check_qry);
        if($result){
            return 1;
        }else{
        $update_query="UPDATE `admin` SET `active_state`=$state_is,`remarks`=now() WHERE `email`='$email';";
        return run_update_query($update_query);
        }
    }else{
        $check_qry = "SELECT IF (EXISTS(SELECT * FROM admin WHERE `email`='$admEmail' and `active_state`=$state_is),1,0)as result;";
        $result = check_if_exist($check_qry);
        if($result){
            return 1;
        }else{
        $update_query="UPDATE `admin` SET `active_state`=$state_is,`remarks`=now() WHERE  `email`='$email';";
        return run_update_query($update_query);
        }
    }
}



if(isset($_POST['toggle_active_vendor'])){
    $state_is=$_POST['toggle_active_vendor'];
    $email = $_POST['user_email'];
    $update_ok = run_toggal_state_vendor($state_is,$email);
    $response='';
    if($update_ok){
        $response = array(
        'message' => 'success',
        'status_code' => '200'
    );
    }else{
        $response =array(
        'message' => 'failure',
        'status_code' => '201'
    );
    }
    echo json_encode($response);
}

function run_toggal_state_vendor($state_is,$email){
    if($state_is){
        $check_qry = "SELECT IF (EXISTS(SELECT * FROM vendor_users WHERE `vendor_email`='$email' and `active_state`='$state_is'),1,0)as result;";
        $result = check_if_exist($check_qry);
        if($result){
            return 1;
        }else{
        $update_toggle_query="UPDATE `vendor_users` SET `active_state`='$state_is',`remarks`= now() WHERE `vendor_email` ='$email';";
            $to = $email;
            $subject ="Vendor User Activated";
            $message ="Dear ".$email." your account has veen activated. Now you can login as a vendor user. http://delinepal.com/vendor_login/";
            $from = "account@delinepal.com";
            $header = "From: $from";
            mail($to,$subject, $message,$header);
        return run_update_query($update_toggle_query);
        }
    }else{
        $check_qry = "SELECT IF (EXISTS(SELECT * FROM vendor_users WHERE `vendor_email`='$email' and `active_state`='$state_is'),1,0)as result;";
        $result = check_if_exist($check_qry);
        if($result){
            return 1;
        }else{
        $update_toggle_query="UPDATE `vendor_users` SET `active_state`='$state_is',`remarks`= now() WHERE `vendor_email` ='$email';";
        return run_update_query($update_toggle_query);
        }
    }
}


?>