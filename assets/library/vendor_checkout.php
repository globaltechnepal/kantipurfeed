<?php
include 'library.php';

if(isset($_POST['vendor_checkout'])){
    //write code for checkout
    $_data_array=$_POST['vendor_checkout'];
    $_email=$_POST['vendorEmail'];
    $discountPercent=$_POST['discountPercent'];
    //get veriables value and add in checkout table
    $response=insert_vendor_checkouts($_data_array,$_email,$discountPercent);
    //return on success
    echo json_encode($response);
}

function insert_vendor_checkouts($_data_array,$_email,$discountPercent){
    $response='';
    $product_count=count($_data_array);
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `vendor_users` WHERE `vendor_email`='$_email' AND `active_state`='1'),1,0) as result;";//check user exist or not
    if(check_if_exist($check_query)){
        //now create vendor checkout list
        $vc_id=get_primary_id('vendor_checkout');
        $insert_query= "INSERT INTO `vendor_checkout` (`id`, `vendor_email`, `product_count`, `remarks`) VALUES ($vc_id,'$_email','$product_count','');";
        if(run_insert_query($insert_query)){
            $_product_id=[];
            //now add items list
                $ins_count=0;
            foreach ($_data_array as $data){
                // echo "data:".$data."<br>";
                
                $da=explode('#',$data);//separate product and quantity
                $product_id = $da[0];
                $quantity = $da[1];
                $check_query = "SELECT IF( EXISTS ( SELECT * FROM `products` WHERE `id`=$product_id),1,0) as result;";
                if(check_if_exist($check_query)){
                    // echo "product id ".$product_id." exists.<br>";
                    $id=get_primary_id('vendor_checkout_items');
                    $sales_rate=give_sales_rate($product_id,$_email);
                    
                    //insert into checkout table
                    $ins_query="INSERT INTO `vendor_checkout_items` (`id`, `vendor_checkout_id`, `product_id`, `order_quantity`,`discountPercent`, `sales_rate`,  `remarks`) VALUES ($id,'$vc_id','$product_id','$quantity','$discountPercent','$sales_rate','');";
                    if(!run_insert_query($ins_query)){
                        array_push($_product_id,$product_id);
                    }else{
                        $ins_count++;
                    }
                }else{
                    // echo "product id ".$product_id." don't exists.<br>";
                    array_push($_product_id,$product_id);
                }
            }
            if($ins_count!=$product_count){
                $update_product_count = "UPDATE `vendor_checkout` SET `product_count`='$ins_count' WHERE `id`=$vc_id;";
                run_update_query($update_product_count);
                // echo "some products cannot be added.";
                $response=array(
                    'status_code'=>'220',
                    'message'=>'success',
                    'message_2'=>'cannot checkout following',
                    'data'=>$_product_id
                    );
                }
            else if($ins_count==$product_count){
                $response=array(
                    'status_code'=>'200',
                    'message'=>'success'
                    );
                    $to = $_email;
                    $subject ="Order Place for Deli Nepal";
                    $message ="Dear ".$_email." Your order for delinepal place successfully. Please wait, Our team will contact you for the confirmation. You can check what you order here. http://delinepal.com/assets/vendor/order_history.php.";
                    $from = "sales@delinepal.com";
                    $header = "From: $from";
                    mail($to,$subject, $message,$header);
            }
            else{
                //some other problem
                $response=array(
                    'status_code'=>'501',
                    'message'=>'error'
                    );
            }
        }else{
            //cannot make new list
            $response=array(
                    'status_code'=>'501',
                    'message'=>'error',
                    'message_2'=>'cannot create new list'
                    );
        }
    }else{
        //respond user doesnot exist
        $response=array(
                    'status_code'=>'501',
                    'message'=>'error',
                    'message_2'=>'user not exist or active'
                    );
    }
    return $response;
}

// give_rate_accourding_to_vendor_user('5',$_email);


function give_sales_rate($product_id,$_email){
    $check_exist="SELECT IF (EXISTS (SELECT `sell_Price` FROM products WHERE `id` = '$product_id'),1,0) as result;";
    if(check_if_exist($check_exist)){
        $get_data_qry="SELECT  `actual_Price`, `sell_Price` FROM `products` WHERE `id` ='$product_id';";
        $data = get_Table_Data($get_data_qry);
        $price='';
        foreach ($data as $da){
        $price = $da['sell_Price'];
        }
        return $price;
        
    }
}

// cartout-----------------------------------------------------------------------------------------------------------------------
if(isset($_POST['vendor_cartouts'])){
$response='';
 $vendor_data= $_POST['vendor_cartouts'];  
 $vendorEmail= $_POST['vendorEmail'];
 $discountPercent= $_POST['discountPercent'];
//  $productID= $_POST['productID'];
//  $quantity = $_POST['quantity']; echo $quantity;
 $id=get_primary_id('vendor_cartOut');
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `vendor_cartOut` WHERE `id`='$id'),1,0) as result;";//check user exist or not
    if(check_if_exist($check_query)){
        $response=array(
        'status_code'=>'55',
        'message'=>'Duplicate Entry'
        );
        return false;
    }
    else{
        $con = connectdb();
        $check_query_qry = "SELECT IF (EXISTS (SELECT * FROM `vendor_cartOut` WHERE `vendor_email`='$vendorEmail'),1,0) as result;";//check user exist or not
        if(check_if_exist($check_query_qry)){
            $delete_qry = "DELETE FROM `vendor_cartOut` WHERE `vendor_email` ='$vendorEmail';"; //echo $delete_qry;
            $delete_req = mysqli_query($con, $delete_qry);
            if($delete_req){
                // $response=array(
                // 'status_code'=>'200',
                // 'message'=>'Success',
                // 'data' => $delete_req
                // );
            $_id=0;
            foreach ($vendor_data as $data){
            $id=$id+$_id;
            $da=explode('#' , $data); //separate product and quantity
            $productID = $da[0];
            $quantity = $da[1];  
            $insert_qry = "INSERT INTO `vendor_cartOut`(`id`, `product_id`, `vendor_email`, `quantity`, `discount`) VALUES ('$id','$productID','$vendorEmail','$quantity','$discountPercent');";
            // echo $insert_qry;
            $req = mysqli_query($con, $insert_qry);
            $_id=$_id+1;
                if($req){
                $response=array(
                'status_code'=>'200',
                'message'=>'Success',
                'data' => $data
                );  
                }
                else{
                $response=array(
                'status_code'=>'201',
                'message'=>'Failure'
                );  
                }
            }
                
            }
        }
        else{
        $_id=0;
            foreach ($vendor_data as $data){
            $id=$id+$_id;
            $da=explode('#' , $data); //separate product and quantity
            $productID = $da[0];
            $quantity = $da[1];  
            $insert_qry = "INSERT INTO `vendor_cartOut`(`id`, `product_id`, `vendor_email`, `quantity`, `discount`) VALUES ('$id','$productID','$vendorEmail','$quantity','$discountPercent');";
            // echo $insert_qry;
            $req = mysqli_query($con, $insert_qry);
            $_id=$_id+1;
                if($req){
                $response=array(
                'status_code'=>'200',
                'message'=>'Success',
                'data' => $data
                );  
                }
                else{
                $response=array(
                'status_code'=>'201',
                'message'=>'Failure'
                );  
                }
            }
       }
    }
    echo json_encode($response);
}


if(isset($_POST['vendor_cartOut_Item'])){
    $response='';
    $v_email = $_POST['vendor_cartOut_Item'];
    $v_select_data = $_POST['cartouts'];
    $ids="-1";
     foreach ($v_select_data as $data){
        $da=explode('#' , $data);
        $v_select_productID = $da[0];
        $ids=$ids.",".$da[0];
     }

    
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `vendor_cartOut` WHERE `product_id` in ($ids) AND `vendor_email` ='$v_email'),1,0) as result;"; //check user exist or not
  
    if(check_if_exist($check_query)){
        $select_cartout_id ="SELECT vco.`product_id`, `product_code`,`category_name`, `product_name`, `specification`, `actual_Price`, `sell_Price`,`img_path`, `primary_image`,`quantity`, `discount` FROM `vendor_cartOut` vco 
            INNER JOIN `products` p ON p.id = vco.product_id 
            INNER JOIN `category` c ON c.category_id = p.category_id
            WHERE product_id in ($ids) AND `vendor_email` = '$v_email';";
          
            
            $req_data = get_Table_Data($select_cartout_id);
            if($req_data){
                $response=array(
                'status_code'=>'200',
                'message'=>'Success Cartout',
                'data' => $req_data
                );
            }
            else{
                $response=array(
                'status_code'=>'200',
                'message'=>'Unable to fetch the data',
                );
            }
    }
    else{
        $response=array(
        'status_code'=>'201',
        'message'=>'Unable to find data'
        );
    }
    // }
    echo json_encode($response);
}

// cartout-----------------------------------------------------------------------------------------------------------------------
?>