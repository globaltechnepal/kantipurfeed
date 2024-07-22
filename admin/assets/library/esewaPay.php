<?php
include 'library.php';


if(isset($_POST['eSewaPay'])){
    $refID = $_POST['eSewaPay'];
    $check_refID = "SELECT IF(EXISTS(SELECT * FROM `delivery_payment_details` WHERE `reference_no`='$refID'),1,0)as result;";
    $hasRefID = check_if_exist($check_refID);
    $check_pay_statys = "SELECT IF(EXISTS(SELECT * FROM `delivery_payment_details` WHERE `reference_no`='$refID' AND `payment_status`='paid'),1,0)as result;";
    $isPaid = check_if_exist($check_pay_statys);
    if($hasRefID==1 && $isPaid==0){
        // perform payment work
    }
    else if($hasRefID==0){
        // generate error message for not having referense ID in table
    }
    else if($isPaid==1){
        // client has already paid for the products in this purchase invoice so doo what needs to be done.
    }else{
        // generate message for unknown request.
    }
}

?>