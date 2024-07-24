<?php
include 'database.php';

function get_email_ready($email,$pass){
    $msg = '<p>
    Sir/mam, please use the given email ID and password to login.<br>
    email ID: <strong>'.$email.'</strong><br>
    Password: <strong>'.$pass.'</strong><br>
    url link: http://delinepal.com/vendor_login.php or <br> <div> <a href="http://delinepal.com/vendor_login.php" style="padding:6px;margin:5px;border-radius:10px;background:#aef0f36e;color:black;border:2px dashed">click here</a></div><br>
    <hr>Thank You!<br>
    delinepal</p><div><img src="https://delinepal.com/logo.png" alt="logo" style="width:15%;border-bottom:2px solid black;padding-bottom:2px;"></div>';
    return $msg;
}
// echo get_email_ready('$email','$pass');
if(isset($_POST['register_vendor_user'])){
    //response
    $response="";
    //operation
    $company_name = $_POST['register_vendor_user'];
    $email = $_POST['venEmail'];
    $user_type = $_POST['clientType'];
    $pass = $_POST['Password'];
    $vat = $_POST['Vatno']; if($vat==''){$vat=0;}
    $pan = $_POST['panno']; if($pan==''){$pan=0;}
    $contact = $_POST['contact'];
    $address = $_POST['province'].", ".$_POST['district'].", ".$_POST['municipality'].", ".$_POST['tole'];
    $id = get_primary_id('vendor_users');
    $check_exist = "SELECT IF (EXISTS (SELECT * FROM `vendor_users` WHERE `vendor_company_name`='$company_name' AND `vendor_email`='$email'),1,0) as result;";
    if($vat=='0' && $pan=='0'){
        $response = give_response(201);
    }
    else if(check_if_exist($check_exist)){
        $response = give_response(55);
    }else{
        $enc_pass=md5($pass);
        $ins_qry="INSERT INTO `vendor_users` (`id`,`user_type`, `vendor_company_name` , `vendor_email`, `vendor_pass`, `vendor_contact`, `vendor_pan`, `vendor_vat`, `vendor_address`, `remarks`) VALUES ($id,'$user_type','$company_name','$email','$enc_pass','$contact','$pan','$vat','$address','');";
        if(run_basic_insert_query($ins_qry)){
            $body=get_email_ready($email,$pass);
            $sub="Account Created";
            $from='account@delinepal.com';
            if(send_my_Email($email,$sub,$body,$from)){
            $response = array("status_code"=>200,
            "message"=>'success',
            'message_2'=>'mail sent');    
            }else{
            $response = array("status_code"=>200,
            "message"=>'success',
            'message_2'=>'mail not sent');
            }
        }else{
            $response = give_response(201);
        }
    }
    echo json_encode($response);
}

//admin control for order confirmation
if(isset($_POST['order_confirmation'])){
    $response='';
    $checkout_ID=$_POST['order_confirmation'];
    $action_user=$_POST['checkoutEmail'];
    $check_query="SELECT IF (EXISTS (SELECT * FROM `vendor_checkout` WHERE `id`=$checkout_ID),1,0) as result;";
    if(check_if_exist($check_query)){
        //update confirmation
        $remarks="Order Confirmed BY ".$action_user;
        $update_query="UPDATE `vendor_checkout` SET `order_confirmed`='1',`remarks`='$remarks' WHERE `id`=$checkout_ID;";
        if(run_update_query($update_query)){
            $response=array("status_code"=>"200","message"=>"success");
        }else{
            $response=array("status_code"=>"201","message"=>"failure");
        }
    }else{
        $response=array("status_code"=>"404","message"=>"Not Found");
    }
    echo json_encode($response);
}

//admin vendor control FOR DISPATCH
// {insert_dispatch_info:userDispatch,dispatchNum:dispatchNum,dispatchDate:dispatchDate,deliveryMode:deliveryMode,contactPerson:contactPerson,contactNum:contactNum,paymentMode:paymentMode,amount:amount,checkout_id:checkout_id,remarks:remarks}
if(isset($_POST['insert_dispatch_info'])){
    $response='empty';
    if($_POST['insert_dispatch_info']!=''){
    $action_user=$_POST['insert_dispatch_info'];
    $checkout_id=$_POST['checkout_id'];
    $dispatch_num=$_POST['dispatchNum'];
    $dispatch_date=$_POST['dispatchDate'];
    $deliveryMode=$_POST['deliveryMode'];
    $contactPerson=$_POST['contactPerson'];
    $contactNum=$_POST['contactNum'];
    $paymentMode=$_POST['paymentMode'];
    $amount=$_POST['amount'];
    $remarks=$_POST['remarks'];
    $tbl_name='vendor_checkout';
    if($amount==''){
        $amount=0;
    }
    $total=give_total_receivable_amt($checkout_id);
    if($amount>$total){
        //response amount mismatched 
        $response=array('status_code'=>"404",'message'=>"error",'message_2'=>'amount mismatched');
    }else{
        if($amount!=0){
        $remarks.=" <br>Advance Payment Received on Dispatch : Rs.".$amount."<br>";
        }
        $previous_remarks=get_old_remarks($tbl_name,$checkout_id);
        if($remarks!=''){
            $remarks="Note: ".$remarks."<br> Updated by ".$action_user;
        }
        //update to old remarks
        if($previous_remarks!=''){
        $remarks=$previous_remarks."<br>".$remarks;
        }
        $action_complete=action_dispatch($remarks,$checkout_id,$dispatch_num,$dispatch_date,$deliveryMode,$contactPerson,$contactNum,$paymentMode,$amount);// echo "Action complete :".$action_complete;
        //update to old remarks
        if($action_complete){
            //action complete give success message
            $response=array('status_code'=>"200",'message'=>"success");
        }else{
            // ation incomplete give failure message
            $response=array('status_code'=>"201",'message'=>"errore");
        }
    }
    }else{
        $response=array('status_code'=>"404",'message'=>"invalied reques");
    }
    echo json_encode($response);
}

function action_dispatch($remarks,$checkout_id,$dispatch_num,$dispatch_date,$deliveryMode,$contactPerson,$contactNum,$paymentMode,$amount){
    // echo "Inside ";
    //perofrm action of dispatch here
    $check_query="SELECT IF (EXISTS (SELECT * FROM `vendor_checkout` WHERE `id`=$checkout_id),1,0) as result;";
    if(check_if_exist($check_query)){
        //now perform action
        $update_query="UPDATE `vendor_checkout` SET `order_dispatched_date`='$dispatch_date',`remarks`='$remarks' WHERE `id`=$checkout_id;";//echo $update_query;
        if(run_update_query($update_query)){
            // echo "inside update";
        $id=get_primary_id('vendor_delivery_record'); //echo "ID is : ".$id;
        $insert_query="INSERT INTO `vendor_delivery_record`(`id`, `checkout_id`, `delivery_mode`, `dispatch_no`, `contact_person`, `mobile_no`, `payment_mode`, `pay_amt`, `dispatch_date`,`remarks`) VALUES ($id,'$checkout_id','$deliveryMode','$dispatch_num','$contactPerson','$contactNum','$paymentMode','$amount','$dispatch_date','');";
        // echo "query".$insert_query;
        //start of inside if
        if(run_basic_insert_query($insert_query)){
            // echo "query executated";
            return 1; //insert success
        }else{
            return 0; //cannot insert
        }
        //end of inside if
        }else{
            return 1; // no change to make
        }
    }else{
        //respond list not exist
        return 0;
    }
}
// echo action_dispatch("remarks_test","1","$dispatch_num","2023-02-10","$deliveryMode","$contactPerson","$contactNum","$paymentMode","$amount");


// delivery_completed:vendorEmail,adminemail:adminemail,checkoutIddeliver:checkoutIddeliver,deliveryModeThro:deliveryModeThro,dispatchNumber:dispatchNumber,deliveredOn:deliveredOn,deliveryremarks:deliveryremarks,AmountReceive:AmountReceive}
if(isset($_POST['delivery_completed'])){
    // echo "test";
    $response='empty';
    $action_user=$_POST['adminemail'];
    $checkout_id = $_POST['checkoutIddeliver'];
    $vendor_email=$_POST['delivery_completed'];
    $deliveryMode=$_POST['deliveryModeThro'];
    $dispatch_num=$_POST['dispatchNumber'];
    $delivery_date=$_POST['deliveredOn'];
    $due=give_due_amt($checkout_id);
    $receive_amt=$_POST['AmountReceive'];
    if($receive_amt==''){
        $receive_amt=0;
    }
    $remarks=$_POST['deliveryremarks'];
    if($receive_amt>$due){
        $response=array('status_code'=>'404',"message"=>"error",'message_2'=>'amount missmatched');
    }else{
        if($receive_amt!=''){
        $remarks=$remarks."<br>Payment Received after Delivery : Rs.".$receive_amt."<br>";
        $adv_amt=give_advance_amt($checkout_id);
        $receive_amt=$adv_amt+$receive_amt;
    }
    if($remarks!=''){
        $remarks="Note: ".$remarks."<br> Updated by ".$action_user;
    }
    //update to old remarks
    $tbl_name='vendor_checkout';
    $previous_remarks=get_old_remarks($tbl_name,$checkout_id);
    if($previous_remarks!=''){
    $remarks=$previous_remarks."<br>".$remarks;
    }
    $check_query="SELECT IF (EXISTS (SELECT * FROM `vendor_delivery_record` WHERE `checkout_id`='$checkout_id' and `dispatch_no`='$dispatch_num'),1,0) as result;";
    if(check_if_exist($check_query)){
        //update delivery status
        $update_qry="UPDATE `vendor_delivery_record` SET `delivered`='1' ,`update_date`='$delivery_date',`remarks`='$remarks' WHERE `checkout_id`='$checkout_id' and  `dispatch_no`='$dispatch_num';";
        if($receive_amt!=''){
        $update_qry="UPDATE `vendor_delivery_record` SET `pay_amt`='$receive_amt',`delivered`='1' ,`update_date`='$delivery_date',`remarks`='$remarks' WHERE `checkout_id`='$checkout_id' and  `dispatch_no`='$dispatch_num';";
        }
        // echo $update_qry;
        if(run_update_query($update_qry)){
            //run another update to store delivery date
            $update_date="UPDATE `vendor_checkout` SET `process_completed`='1',`order_delivered_date`='$delivery_date', `remarks`='$remarks' WHERE `id`='$checkout_id';";
            if(run_update_query($update_date)){
                //give success response
        $response=array('status_code'=>'200',"message"=>"success");
            }else{
                //give already uptodate
        $response=array('status_code'=>'200',"message"=>"success","message_2"=>"cannot updte lvl 2");
            }
        }else{
            //give already uptodate
        $response=array('status_code'=>'201',"message"=>"error","message_2"=>"cannot update only lvl 1");
        }
    }else{
        //give data not found message
        $response=array('status_code'=>'404',"message"=>"Data not found");
    }
    }
    
    echo json_encode($response);
}



//close order
if(isset($_POST['orderclosed'])){
    $response='empty';
    $checkout_id=$_POST['orderclosed'];
    $vendor_email=$_POST['vendorEmail'];
    $action_user=$_POST['admEmail'];
    $remarks="Note: Order moved to archive by ".$action_user;
    //update to old remarks
    $tbl_name='vendor_checkout';
    $previous_remarks=get_old_remarks($tbl_name,$checkout_id);
    if($previous_remarks!=''){
    $remarks=$previous_remarks."<br>".$remarks;
    }
    if(close_order($checkout_id,$vendor_email,$action_user,$remarks)){
        $response=array('status_code'=>'200',"message"=>"success");
    }else{
        $response=array('status_code'=>'201',"message"=>"error");
    }
    echo json_encode($response);
}

function close_order($checkout_id,$vendor_email,$action_user,$remarks){
    $check_exist="SELECT IF ( EXISTS (SELECT * FROM `vendor_checkout` WHERE `vendor_email`='$vendor_email' AND `id`='$checkout_id'),1,0) as result;"; //echo $check_exist;
    if(check_if_exist($check_exist)){
        $update_qry="UPDATE `vendor_checkout` SET `archived`=1,`remarks`='$remarks' WHERE `vendor_email`='$vendor_email' AND `id`='$checkout_id';";
        if(run_update_query($update_qry)){
                // update success
            return 1;
        }else{
            $check_update="SELECT IF ( EXISTS (SELECT * FROM `vendor_checkout` WHERE `vendor_email`='$vendor_email' AND `id`='$checkout_id' AND `archived`=1),1,0) as result;";
            if(check_if_exist($check_update)){
                // update already made
                return 1;
            }else{
                //not updated
                return 0;
            }
        }
    }else{
        //no record found
        return 0;
    }
}


if(isset($_POST['insert_vendor_discount_percent'])){
    $response='';
    $vendor_email = $_POST['insert_vendor_discount_percent'];
    $vendorDiscount = $_POST['vendorDiscount'];
    $clientType = $_POST['clientType'];
    $check_query="SELECT IF (EXISTS (SELECT * FROM `vendor_users` WHERE `vendor_email`='$vendor_email'),1,0) as result;"; //echo $check_query;
    $result=check_if_exist($check_query); //echo  $result;
    if($result==0){
        $response = array(
        'message' => 'Email not found',
        'status_code' => '404'
    );
    }
    else if($result==1){
         $discount_query = "UPDATE `vendor_users` SET `discountPercent`='$vendorDiscount',`user_type`='$clientType' WHERE `vendor_email` ='$vendor_email';"; //echo $discount_query;
        $conn = dbConnecting();
        $Res = mysqli_query($conn, $discount_query);
        if($Res){
                $response=array(
                    'status_code'=>'200',
                    'message'=>'success'
                );
        }
        else{
            $response = array(
               'status_code'=>'201',
               'messaage' => 'Failed'
               ); 
        }
    }
    echo json_encode($response);
}
?>