<?php
include 'library.php';

if(isset($_POST['ref_num'])){
    $ref_num=$_POST['ref_num'];
    if($ref_num==''){
        $response=array(
        'message'=>'unknown',
        'status_code'=>'501'
        );
        echo json_encode($response);
    }
    else{
        $sql = "SELECT IF( EXISTS(SELECT * from delivery_payment_details where reference_no='$ref_num'), 1, 0) as result;";
        $result = check_if_exist($sql);
        if($result==1){
            //write code to extract status
            $sql="SELECT delivery_status from delivery_payment_details where reference_no='$ref_num';";
            $get_delivery_status=get_Table_Data($sql);
            $delivery_status="";
            foreach($get_delivery_status as $status){ $delivery_status=$status['delivery_status'];}
            $response=array(
            'message'=>'success',
            'status_code'=>'200',
            'delivery_status'=>$delivery_status
            );
            echo json_encode($response);
        }
        else if($result==0){
            //give reponse for not matching with db data
            $response=array(
            'message'=>'data not found',
            'status_code'=>'502'
            );
            echo json_encode($response);
        }
        else{
            //give response of failure
            $response=array(
            'message'=>'unknown',
            'status_code'=>'501'
            );
            echo json_encode($response);
        }

    }
}
?>