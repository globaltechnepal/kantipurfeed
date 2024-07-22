<?php
include 'connect_server.php';
include 'functions_here.php';

function run_update_query_here($sql){
    $conn = dbConnecting();
    $request = mysqli_query($conn,$sql);
    if($request){
        $row = check_row_affected($conn);
        if($row==1){
            $response=  give_response(200);
            history_table($sql, true);
            echo json_encode($response);
        }
        else if($row==0){
            history_table($sql, false);
            $response=  give_response(502);
            echo json_encode($response);
        }
    }else{
            history_table($sql, false);
        $msg = mysqli_errore($conn);
        $resp_code = check_ecxeptions($msg);
        $response=  give_response($resp_code);
        echo json_encode($response);
    }
}

if(isset($_POST['toggle_payment'])){
    $ref_num = $_POST['ref_code'];
    $state = $_POST['toggle_payment'];
    $status='';
    if($state == 1){$status="PAID";}else if($state == 0){$status="PENDING";}
    $check = "SELECT IF (EXISTS(SELECT * FROM `delivery_payment_details` WHERE `reference_no`='$ref_num'),1,0)as result;";
    $result = check_if_exist($check);
    if($result==1){
        $sql = "UPDATE `delivery_payment_details` SET `payment_status`='$status' WHERE `reference_no`='$ref_num';";
        echo $sql;
        run_update_query_here($sql);
    }else if($result==0){
        $response=  give_response(404);
        echo json_encode($response);
    }
}

if(isset($_POST['toggle_delivery'])){
    $ref_num = $_POST['ref_code'];
    $state = $_POST['toggle_delivery'];
    $status='';
    if($state == 1){$status="DELIVERED";}else if($state == 0){$status="PENDING";}
    $check = "SELECT IF (EXISTS(SELECT * FROM `delivery_payment_details` WHERE `reference_no`='$ref_num'),1,0)as result;";
    $result = check_if_exist($check);
    if($result==1){
        $sql = "UPDATE `delivery_payment_details` SET `delivery_status`='$status' WHERE `reference_no`='$ref_num';";
        // echo $sql;
        run_update_query_here($sql);
    }else if($result==0){
        $response=  give_response(404);
        echo json_encode($response);
    }

}
?>