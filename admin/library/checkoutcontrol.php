<?php
include 'connect_server.php';
include 'functions_here.php';
// --------------------------------------------------------for checkout product list------------------------------------------------------ 
// check if exist in database 
// check if exist in database 
// function check_if_exist($sql)
// {
//   $conn = dbConnecting();
//   $req = mysqli_query($conn, $sql);
//   $result = mysqli_fetch_assoc($req);
//   $val = $result['result'];
//   if ($val == 1) {
//     return 1;
//   } else if ($val == 0) {
//     return 0;
//   } else {
//     return mysqli_error($conn);
//   }
//   mysqli_close($conn);
// }
// check if exist in database end
// check if exist in database end

//use to get all table data from database
//use to get all table data from database
// function get_Table_Data($sql)
// {
//   $conn = dbConnecting();
//   $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//   if (!$req) {
//     return 0;
//   } else if (mysqli_num_rows($req) != 0) {
//     $list = [];
//     $i = 1;
//     while ($data = mysqli_fetch_assoc($req)) {
//       $list[$i] = $data;
//       $i = $i + 1;
//     }
//     return $list;
//   } else {
//     return 0;
//   }
// }
//use to get all table data from database end
//use to get all table data from database end
$success = array(
  'message' => 'success',
  'status_code' => '200'
);
$failure = array(
  'message' => 'failure',
  'status_code' => '201'
);
$errore = array(
  'message' => 'errore',
  'status_code' => '502'
);
$response = array(
  'message' => 'unknown',
  'status_code' => '501'
);

if(isset($_POST['checkedout_items'])){
    $dpd_id=$_POST['checkedout_items'];
    if($dpd_id==''||$dpd_id== null){
        echo json_encode($response);
    }
    else{
        $checkQuery = "SELECT IF( EXISTS(SELECT * from checkouts where dpd_id=$dpd_id), 1, 0) as result;";
        $result = check_if_exist($checkQuery);
        if ($result == 0) {
            echo json_encode($response);
        }
        elseif ($result == 1) {
            $query = "SELECT p.product_name,clr.color_name as varient_name,ch.rate,ch.discount,ch.quantity,(ch.rate*ch.quantity)-ch.discount as total FROM `checkouts` ch
            inner join productvariant pv on ch.product_v_id=pv.id
            inner join products p on pv.product_id=p.id
            inner join colors clr on pv.color_id=clr.id
            WHERE ch.`dpd_id`=$dpd_id order by ch.modify_date DESC;";
            $data = get_Table_Data($query);
            if ($data == 0) {
            echo json_encode($errore);
            } elseif ($data != 0) {
            $_object = array(
                "message" => "success",
                "status_code" => '200',
                "data" => $data
            );
            echo json_encode($_object);
            } else {
            echo json_encode($response);
            }
        }
        else {
            echo json_encode($response);
        }
    }
}

// if(isset($_POST['deliverydetails'])){
if(isset($_POST['courierName'])){
    // echo "Inside Currier Control";
    $courierName = $_POST['courierName'];
    $consignmentNo = $_POST['consignmentNo'];
    $refID =$_POST['refNo'];
    $consignmentDate = $_POST['consignmentDate'];
    $contactPerson = $_POST['contactPerson'];
    $mobileNo = $_POST['mobileNo'];
    $remarks = $_POST['remarks'];
    $id = get_primary_id("delevarydetails");
    $deliveryStatus =trim("DISPATCHED");
    echo "<script>alert('" . $courierName . " " . $consignmentNo . " " . $refID . " " . $consignmentDate . " " . $contactPerson . " " . $mobileNo . " " . $remarks . " " . $id . " " . $deliveryStatus . "');</script>";
    $checkQry = "SELECT IF(EXISTS(SELECT * FROM delevarydetails WHERE `refID` ='$refID'),1,0)AS result;";
    $result = check_if_exist($checkQry);
     if ($result == 1) {
            $response = give_response(55);
            echo json_encode($response);
        }
    else if($result==0){
    $deliveryQry = "INSERT INTO `delevarydetails`(`id`, `refID`, `courierName`, `consignmentNo`, `consignmentDate`, 
    `contactPerson`, `mobileNo`, `remarks`) VALUES ($id,'$refID','$courierName','$consignmentNo','$consignmentDate','$contactPerson','$mobileNo','$remarks');";
    echo "<script>alert('".$deliveryQry."');</script>";
    $conn = dbConnecting();
    $deliveryreq = mysqli_query($conn, $deliveryQry);
    if ($deliveryreq) {
        $row = check_row_affected($conn);
        if($row==1){
        $updatedeliveryQry = "UPDATE `delivery_payment_details` SET  `delivery_status` =' $deliveryStatus',`dispatch_date`=now(),`deliverd_by`= '$courierName' WHERE `reference_no` = '$refID';";
        $updatereq= mysqli_query($conn, $updatedeliveryQry);
        if($updatereq){
            $response = give_response(200);
            // echo json_encode($response);
        }
         else{
            $msg = mysqli_error($conn);
            $code = check_ecxeptions($msg);
            $response = give_response($code);
            echo json_encode($response);
       
        }
        
        }
        else{
            $msg = mysqli_error($conn);
            $code = check_ecxeptions($msg);
            $response = give_response($code);
            echo json_encode($response);
       
        }
        // $response = give_response(200);
        echo json_encode($response);
    } else {
        $msg = mysqli_error($conn);
        $code = check_ecxeptions($msg);
        $response = give_response($code);
        echo json_encode($response);
    }
    }

}

if(isset($_POST['get_delivery_detail'])){
    $get_delivery_detail = $_POST["get_delivery_detail"];
    $check_exist = "SELECT IF (EXISTS(SELECT * FROM `delevarydetails` WHERE `refID`='$get_delivery_detail'),1,0) as result;";
    $result = check_if_exist($check_exist);
  if ($result == 1) {
    $sql = "SELECT `id`, `refID`, `courierName`, `consignmentNo`, `consignmentDate`, `contactPerson`, `mobileNo`, `remarks` FROM `delevarydetails` WHERE `refID`='$get_delivery_detail';";
    $data = get_Table_Data($sql);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "delevarydetails" => $data
    );
    echo json_encode($response);
  } else {
    $response = get_response(501); 
    echo json_encode($response);
  }
}

if(isset($_POST['insert_payment_status_detail'])){
 $insert_payment_status_detail = $_POST['insert_payment_status_detail'];  
 $paymentMethod = $_POST['paymentMethod'];
 $transDate = $_POST['transDate'];
 $transCode = $_POST['transCode'];
 $transAmt = $_POST['transAmt'];
 $paymentStatus = "PAID";
 $transRemark = $_POST['transRemark'];
 $id = get_primary_id("paymentstatus");
 $checkQry = "SELECT IF(EXISTS(SELECT * FROM paymentstatus WHERE `refID` ='$insert_payment_status_detail'),1,0)AS result;";
 $result = check_if_exist($checkQry);
    if ($result == 1) {
            $response = give_response(55);
            echo json_encode($response);
    }
     else if($result==0){
    $paymentQry = "INSERT INTO `paymentstatus`(`id`, `refID`, `payment_received_Mode`, `transactionCode`, `transactionAmt`, `transactionDate`, `remarks`) VALUES ($id,'$insert_payment_status_detail','$paymentMethod','$transCode','$transAmt','$transDate','$transRemark');";
    echo $paymentQry;
    $conn = dbConnecting();
    $paymentreq = mysqli_query($conn, $paymentQry);
    // echo $paymentreq;
    if ($paymentreq) {
        $row = check_row_affected($conn);
        if($row==1){
        $updatepaymentQry = "UPDATE `delivery_payment_details` SET `payment_mode`='$paymentMethod',`payment_status`='$paymentStatus' WHERE `reference_no` ='$insert_payment_status_detail';";
        echo $updatepaymentQry;
        $updatepaymentreq= mysqli_query($conn, $updatepaymentQry); 
        if($updatepaymentreq){
            $response = give_response(200);
            echo json_encode($response);
        }
        else{
            $msg = mysqli_error($conn);
            $code = check_ecxeptions($msg);
            $response = give_response($code);
            echo json_encode($response);
        }
        }
        else{
            $msg = mysqli_error($conn);
            $code = check_ecxeptions($msg);
            $response = give_response($code);
            echo json_encode($response);
        }
        echo json_encode($response);
        }  
        else{
           $msg = mysqli_error($conn);
            $code = check_ecxeptions($msg);
            $response = give_response($code);
            echo json_encode($response); 
        }
   }   
}

if(isset($_POST['get_payment_detail'])){
    $get_payment_detail = $_POST["get_payment_detail"];
    $check_exist = "SELECT IF (EXISTS(SELECT * FROM `paymentstatus` WHERE `refID`='$get_payment_detail'),1,0) as result;";
    $result = check_if_exist($check_exist);
  if ($result == 1) {
    $sql = "SELECT `id`, `refID`, `payment_received_Mode`, `transactionCode`, `transactionAmt`, `transactionDate`, `remarks` FROM `paymentstatus` WHERE `refID`='$get_payment_detail';";
    $data = get_Table_Data($sql);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "paymentstatus" => $data
    );
    echo json_encode($response);
  } else {
    $response = get_response(501);
    echo json_encode($response);
  }
}


if(isset($_POST['get_delivery_close_detail'])){
    $refID = $_POST["get_delivery_close_detail"];
    $check_exist = "SELECT IF (EXISTS(SELECT * FROM `deliveryconfirmed` WHERE `refID`='$refID'),1,0) as result;";
    $result = check_if_exist($check_exist);
  if ($result == 1) {
    $sql = "SELECT `id`, `refID`, `cartId`, `conform_by`, `confirmdate`, `remarks` FROM `deliveryconfirmed` WHERE `refID` ='$refID';";
    $data = get_Table_Data($sql);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "deliveryconfirmed" => $data
    );
    echo json_encode($response);
  } else {
    $response = get_response(501);
    echo json_encode($response);
  }
}


if(isset($_POST['get_payment_amount'])){
    $refId = $_POST["get_payment_amount"];
    $amount = give_total_receivable_amount($refId);
    $amount = round($amount);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "amount" => $amount
    );
    echo json_encode($response);
}



if(isset($_POST['close_checkout_transaction'])){
    $refID = $_POST["close_checkout_transaction"];
    $nameAdm = $_POST["nameAdm"];
    $cart = $_POST['cartId'];
    echo $cart;
    $delivery_status= "DELIVERED";
    $display =0;
    $closeRemarks = $_POST["closeRemarks"];
    $id = get_primary_id("deliveryconfirmed");
    $check_exist = "SELECT IF (EXISTS(SELECT * FROM `deliveryconfirmed` WHERE `refID`='$refID'),1,0) as result;";
    $result = check_if_exist($check_exist);
    if($result==1){
       $response = give_response(55);
       echo json_encode($response);  
    }
    else{
    $delevary_close_Qry = "INSERT INTO `deliveryconfirmed`(`id`, `refID`,`cartId`, `conform_by`, `confirmdate`, `remarks`) VALUES ($id,'$refID','$cart','$nameAdm',now(),'$closeRemarks');";
    $conn = dbConnecting();
    $delevary_close_req = mysqli_query($conn, $delevary_close_Qry);
    if($delevary_close_req){
    $update_delivery_Qry ="UPDATE `delivery_payment_details` SET `delivery_status`='$delivery_status' WHERE `reference_no` = '$refID';";
    $update_delivery_Req1=run_update_query($update_delivery_Qry);
    $update_display_Qry ="UPDATE `checkouts` SET `delivery_status`='DELIVERED',`display`='$display' WHERE `dpd_id` ='$cart';";
    $update_display_Req2=run_update_query($update_display_Qry);//echo "update table 2".$update_delivery_Req;
    if($update_delivery_Req1 && $update_delivery_Req){
      $response = give_response(200); 
    }else if($update_delivery_Req1==0 && $update_delivery_Req2==0){
      $response=array(
        "message" => "success",
        "status_code" => '200',
        "message2" =>'cannot update 1st and 2nd table'
      ); 
    }else if($update_delivery_Req1==1 && $update_delivery_Req2==0){
        $response=array(
        "message" => "success",
        "status_code" => '200',
        "message2" =>'cannot update 2nd table'
      ); 
      }
      else if($update_delivery_Req1==0 && $update_delivery_Req2==1){
        $response=array(
        "message" => "success",
        "status_code" => '200',
        "message2" =>'cannot update 1st table'
      );}else{
         $response=array(
        "message" => "success",
        "status_code" => '200',
        "message2" =>'no update task'
      ); 
      }
    }else{
        $msg = mysqli_error($conn);
        $code = check_ecxeptions($msg);
        $response = give_response($code);
        // echo json_encode($response);  
    }
     echo json_encode($response);
    }
}

?>