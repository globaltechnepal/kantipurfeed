<?php
// include 'response_message.php';
$conn = connectdb();

// coupon functions 
// coupon functions
function calculate_percentage_discount($total_amt,$discount_percentage){
    $value = $total_amt*($discount_percentage/100);
    // echo $value;
    return round($value);
}

function get_coupon_details($coupon_code){
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `coupon` where `coupon_code`='$coupon_code'),1,0) as result;";
    // echo $check_query;
    $result = check_if_exist($check_query);
    if($result==1){
      $sql="SELECT c.coupon_code,c.consumed_by,c.consumed_date,cM.coupon_name,cM.coupon_value,cM.coupon_value_type,cM.coupon_use_type,cM.coupon_start_date,cM.coupon_expire_date,cM.generated_coupon_count FROM `coupon` c INNER JOIN `couponMaster` cM on cM.id = c.`couponMaster_id` WHERE c.`coupon_code`='$coupon_code';";
      $data = get_Table_Data($sql);
      return $data;
    }else{
        return 0;
    }
}
function check_if_coupon_exist($coupon_code){
    $coupon_code=strtoupper($coupon_code); //echo "I have coupon code:".$coupon_code;
    $data = get_coupon_details($coupon_code);
    if($data == 0){
        return 0;
    }else{
        $coupon_exist ='';
        foreach($data as $da){
            $coupon_exist=$da['coupon_code']; //echo "coupon Code retrived : ".$coupon_exist;
        }
        if($coupon_exist==$coupon_code){
            return 1;
        }else{
            return 0;
        }
    }
}

function coupon_use_type($coupon_code){
    $data = get_coupon_details($coupon_code);
    if($data == 0){
        return 0;
    }else{
        $coupon_use_type ='';
        foreach($data as $da){
            $coupon_use_type=$da['coupon_use_type'];
        }
        if($coupon_use_type=="single"){
            return 'single';
        }else if($coupon_use_type=="multiple"){
            return 'multiple';
        }else{
            return $coupon_use_type;
        }
        return $coupon_use_type;
    }
}
function coupon_value($coupon_code){
    $data = get_coupon_details($coupon_code);
    if($data==0){
        return 0;
    }else{
        $coupon_value = '';
        foreach($data as $da){
        $coupon_value = $da['coupon_value'];
        }
        return $coupon_value;
    }
}
function coupon_value_type($coupon_code){
    $data = get_coupon_details($coupon_code);
    if($data == 0){
        return 0;
    }else{
        $coupon_value_type ='';
        foreach($data as $da){
            $coupon_value_type=$da['coupon_value_type'];
        }
        if($coupon_value_type=='amount'){
            return 'amount';
        }else if($coupon_value_type=='percentage'){
            return 'percentage';
        }else{
            return $coupon_value_type;
        }
    }
}
function coupon_validity($coupon_code){
    $data = get_coupon_details($coupon_code);
    if($data == 0){
        return 0;
    }else{
        $start_date='';
        $end_date='';
        foreach($data as $da){
        $start_date=$da['coupon_start_date'];
        $end_date=$da['coupon_expire_date'];
        }
        $today = date("Y-m-d H:i:s");
        // echo "Start Date : ".$start_date."<br>";
        // echo "End Date : ".$end_date."<br>";
        // echo "Today : ".$today."<br>";
        if($today >= $start_date ){
            if($today <= $end_date){
                return 1;
            }else{
                $response = "offer ended on ".$end_date;
                return $response;
            }
        }else{
               $response = "offer is starts from ".$start_date;
               return $response;
        }
    }
}
function check_if_coupon_used($coupon_code){
    $data=get_coupon_details($coupon_code);
    if($data==0){
        return 0;
    }else{
        $coupon_user='';
        $coupon_used_datetime='';
        foreach($data as $da){
            $coupon_user=$da['consumed_by'];
            $coupon_used_datetime=$da['consumed_date'];
        }
        // echo "coupon user: ".$coupon_user;
        if($coupon_user=='' || $coupon_user==null){
            return 'not_used';
        }else{
            // $response = "The Coupon is used by ".$coupon_user." on ".$coupon_used_datetime." .";
            $response = 'used';
            return $response;
        }
    }
}
function get_coupon_value($hasCoupon){
    $coupon_code=$hasCoupon;
    $coupon_validity=coupon_validity($coupon_code);
    if($coupon_validity==0){
        return 'coupon_code_not_found';
    }
    else if($coupon_validity){
        $coupon_use_type = coupon_use_type($coupon_code);
        if($coupon_use_type=="single"){
            //coupon must be used only once
            $check_used=check_if_coupon_used($coupon_code);
            if($check_used=="not_used"){
                //coupon not used so proceed ahead
                $coupon_value = coupon_value($coupon_code);
                return $coupon_value;
            }else{
                //coupon is used for other
                return $check_used;
            }
        }else if($coupon_use_type=="multiple"){
            // can be used multiple times so passing value directly
            $coupon_value = coupon_value($coupon_code);
            return $coupon_value;
        }else{
            return "coupon type k ho ?".$coupon_use_type;
        }
    }else{
        return $coupon_validity;
    }
}

function update_coupon_user($coupon_code,$user_email){
    if(check_if_coupon_exist($coupon_code)){
    $coupon_use_type=coupon_use_type($coupon_code);
    if($coupon_use_type=='single'){
     //now update coupon user  
     $update_qury = "UPDATE `coupon` SET `consumed_by`='$user_email',`consumed_date`=now() WHERE `coupon_code`='$coupon_code';";
    //  echo $update_qury;
     if(run_update_query($update_qury)){
         return 1;
     }else{
         return 0;
     }
    }else if($coupon_use_type=='multiple'){
        // return "Multiple1";
        return 1;
    }else{
        return 1;
    }
    }
    else{
        return 1;
    }
}
// echo "update coupon use : ".update_coupon_user('0',"gmail@gmail.com");
function assign_symbol_of_coupon_value_type($coupon_value_type,$coupon_value){
    if($coupon_value_type == 'percentage'){
    $coupon_value_type="%";
    $coupon_value=$coupon_value.$coupon_value_type;
    return $coupon_value;
}else if($coupon_value_type =="amount"){
    $coupon_value_type="Rs.";
    $coupon_value=$coupon_value_type.$coupon_value;
    return $coupon_value;
}
}

// echo update_coupon_user('HAHA22','ananda@aryal')."<br>";
// echo check_if_coupon_exist('HAHA22')."<br>";
// echo check_if_coupon_used('ZING10')."<br>";
// echo coupon_use_type('DISC200')."<br>";
// echo get_coupon_value('disc200')."<br>";
// echo coupon_validity('disc200')."<br>";
if(isset($_POST['apply_coupon_code'])){
    $coupon_code = $_POST['apply_coupon_code']; //echo "given coupon code : ".$coupon_code;
    $failure = array(
      'message' => 'failure',
      'status_code' => '201'
    );
    // $response ='';
    if($coupon_code==''){
        $response = $failure;
    }else{
        $coupon_exist=check_if_coupon_exist($coupon_code); //echo "coupon Exist : ".$coupon_exist;
        if($coupon_exist==1){
            $check_used = check_if_coupon_used($coupon_code);
        if($check_used=='used'){
            $response = array(
              'message' => 'used',
              'status_code' => '222'
            );
        }else{
        $coupon_value = get_coupon_value($coupon_code);
        // echo "Coupon Value :".$coupon_value;
        if($coupon_value=='coupon_code_not_found'){
        $response = array(
              'message' => 'cannot_use',
              'status_code' => '333'
            );
        }else{
            $coupon_value_type=coupon_value_type($coupon_code); //echo "coupon Use Type : ".$coupon_value_type;
            $coupon_value=assign_symbol_of_coupon_value_type($coupon_value_type,$coupon_value); //echo "coupon value : ".$coupon_value;
        $success = array(
          'message' => 'success',
          'status_code' => '200',
          'coupon_value' => $coupon_value
        );
        $response = $success;
        }
        }
        }else{
            $response = $errore;
        }
    }
    echo json_encode($response);
}
// coupon functions 
// coupon functions 


?>