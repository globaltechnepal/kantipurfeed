<?php
include 'library.php';
if(isset($_POST["get_data_from_excel"])){
    // $response="";
    $array_data= $_POST['get_data_from_excel'];
    $vendor_email =$_POST['vendor_email'];
    $discountPercent =$_POST['discountPercent'];
    $response=insert_excel_data($array_data,$vendor_email,$discountPercent);
    //return on success
    echo json_encode($response);
}
function insert_excel_data($array_data,$vendor_email,$discountPercent){
    $response='';
    $product_count=count($array_data);
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `vendor_users` WHERE `vendor_email`='$vendor_email' AND `active_state`='1'),1,0) as result;";
    if(check_if_exist($check_query)){
        $vc_id=get_primary_id('vendor_checkout');
        $insert_query= "INSERT INTO `vendor_checkout` (`id`, `vendor_email`, `product_count`, `remarks`) VALUES ($vc_id,'$vendor_email','$product_count','');";
        if(run_insert_query($insert_query)){
            $product_Code=[];
            $price =[];
            foreach ($array_data as $data){
            $da=explode('#',$data);
            $product_Code = $da[0];
            $quantity = $da[1];
            $price = $da[2];
            // echo $price;
            
            //to retrive product id
            $select_pID = "SELECT `id` as Pid FROM `products` WHERE `product_code` ='$product_Code';";
            $req_data = get_Table_Data($select_pID);
            $Pid=[];
            foreach ($req_data as $da){
            $Pid = $da['Pid'];
            }
            // return $Pid;
            
            //insert into vendor checkout item
            $id=get_primary_id('vendor_checkout_items');
            $insert_data_item ="INSERT INTO `vendor_checkout_items` (`id`, `vendor_checkout_id`, `product_id`, `order_quantity`,`discountPercent`, `sales_rate`,  `remarks`) VALUES ($id,'$vc_id','$Pid','$quantity','$discountPercent','$price','');";
            if(run_insert_query($insert_data_item)){
            $response=array(
            'status_code'=>'200',
            'message'=>'success'
            );
            $to = $vendor_email;
            $subject ="Order Place for Deli Nepal";
            $message ="Dear ".$vendor_email." Your order for delinepal place successfully. Please wait, Our team will contact you for the confirmation. You can check what you order here. http://localhost:8080/kantipurfeed/assets/vendor/home/order_history.php.";
            $from = "sales@delinepal.com";
            $header = "From: $from";
            mail($to,$subject, $message,$header);
            }
            else{
                $response=array(
                'status_code'=>'201',
                'message'=>'error in vendor checkout item'
                );
            }
            }
        // echo json_encode($response);
        }
        else{
            echo "Unable to run".$insert_query;
        }
    }
    return $response;
}

?>