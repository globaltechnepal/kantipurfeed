<?php
include 'library.php';
include 'response_message.php';
$conn = connectdb();

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
$used = array(
    'message' => 'used',
    'status_code' => '222'
);
$cannotUse=array(
    'message' => 'cannot_use',
    'status_code' => '333'
);

// get address from server
// get address from server
if (isset($_POST['give_district_from_server'])) {
  $give_district_from_server = $_POST['give_district_from_server'];
  $check_exist = "SELECT IF (EXISTS(SELECT * FROM `address` WHERE province='$give_district_from_server'),1,0) as result;";
  $result = check_if_exist($check_exist);
  if ($result == 1) {
    $sql = "SELECT distinct `district` FROM `address` WHERE `province` = '$give_district_from_server';";
    $data = get_Table_Data($sql);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "address" => $data
    );
    echo json_encode($response);
  } else {
    $response = get_response(501);
    echo json_encode($response);
  }
}

if (isset($_POST['give_municipality_from_server'])) {
  $give_municipality_from_server = $_POST['give_municipality_from_server'];
  $check_exist = "SELECT IF (EXISTS(SELECT * FROM `address` WHERE district='$give_municipality_from_server'),1,0) as result;";
  $result = check_if_exist($check_exist);
  if ($result == 1) {
    $sql = "SELECT DISTINCT `municipality` FROM `address` WHERE `district` = '$give_municipality_from_server';";
    $data = get_Table_Data($sql);
    $response = array(
      "message" => "success",
      "status_code" => '200',
      "address" => $data
    );
    echo json_encode($response);
  } else {
    $response = get_response(501);
    echo json_encode($response);
  }
}
// get address from server
// get address from server

// get data of cart 
// get data of cart 
if (isset($_POST['cartlist'])) {
  $cart_id = $_POST['cartlist'];
  $checkQuery = "SELECT IF( EXISTS(SELECT * from orders where cart_id=$cart_id), 1, 0) as result;";
  $result = check_if_exist($checkQuery);
  if ($result == 0) {
    echo json_encode(get_response(501));
  } elseif ($result == 1) {
    // $query = "SELECT pv.id,pv_img.img_path,pv_img.img,p.product_name,clr.color_name,p.actual_Price,p.sell_Price,o.quantity 
    //           from orders o
    //           inner join productvariant pv on o.product_variant_id=pv.id
    //           inner join productvariant_image pv_img on pv_img.product_varient_id=pv.id
    //           inner join products p on pv.product_id=p.id
    //           inner join colors clr on pv.color_id=clr.id
    //           where cart_id=$cart_id order by o.remarks desc;";
    $query = "SELECT pv.id as id,pv_img.img_path,pv_img.img,p.product_code,p.product_name,clr.color_name,p.actual_Price,p.sell_Price,o.quantity 
                        from orders o
                        inner join productvariant pv on o.product_variant_id=pv.id
                        inner join products p on pv.product_id=p.id
                        inner join colors clr on pv.color_id=clr.id
                        INNER JOIN productvariant_image pv_img on p.id = pv_img.product_varient_id
                        where cart_id=$cart_id order by o.remarks desc;";
    $data = get_Table_Data($query);
    if ($data == 0) {
      echo json_encode(get_response(502));
    } elseif ($data != 0) {
      $_object = array(
        "message" => "hello",
        "status_code" => '200',
        "data" => $data
      );
      echo json_encode($_object);
    } else {
      echo json_encode(get_response(501));
    }
  } else {
    echo json_encode(get_response(501));
  }
}


// get data of cart end
// get data of cart end

// add to cart start here 
// add to cart start here 

if (isset($_POST['addToCart'])) {
  $conn = connectdb();
  $response = array('response' => 'something wrong');
  $cart_id = $_POST['addToCart'];
  $quantity = $_POST['quantity'];
  $pv_id = $_POST['pv_id'];
  //checking if the product is already added
  $checkQuery = "SELECT IF( EXISTS(SELECT quantity from orders where product_variant_id=$pv_id and cart_id=$cart_id), 1, 0) as result;";
  $checkreq = mysqli_query($conn, $checkQuery);
  if ($checkreq == false) {
    $response = array('message' => 'Unknown process', 'status' => '502');
  } else if ($checkreq == true) {
    $result = mysqli_fetch_assoc($checkreq);
    if ($result['result'] == 1) {
      $checkQuery = "SELECT `quantity` FROM `orders` WHERE product_variant_id=$pv_id;";
      $checkreq = mysqli_query($conn, $checkQuery);
      $prevQty = mysqli_fetch_assoc($checkreq);
      $prevQty = $prevQty['quantity'];
      $newquantity = $quantity + $prevQty;
      if ($newquantity > 20) {
        $newquantity = 20;
      }
      $updateQuery = "UPDATE `orders` SET `quantity`=$newquantity where product_variant_id=$pv_id;";
      $req = mysqli_query($conn, $updateQuery);
      if ($req == false) {
        $response = $failure;
      } else if ($req == true) {
        $response = $success;
      }
    } else if ($result['result'] == 0) {
      $query = "INSERT into `orders` (`quantity`, `product_variant_id`, `cart_id`,`remarks`) VALUES ($quantity,$pv_id,$cart_id,now());";
      $req = mysqli_query($conn, $query);
      if ($req == false) {
        $response = $failure;
      } else if ($req == true) {
        $response = $success;
      }
    } else {
      $response = array('message' => 'Cannot Post Request', 'status' => '502');
    }
  } else {
    $response = array('message' => 'Unknown Errore', 'status' => '502');
  }
  echo json_encode($response);
}
// add to cart end here 
// add to cart end here 

//update order quantity in cart
//update order quantity in cart
if (isset($_POST['updateQty'])) {
  $pv_id = $_POST['pv_id'];
  $cart_id = $_POST['cart_id'];
  $quantity = $_POST['updateQty'];
  // $quantity=$_POST['qty']; //use while checking by opening this page
  $checkQuery = "SELECT IF(EXISTS(SELECT * FROM orders WHERE product_variant_id=$pv_id and cart_id=$cart_id),1,0) as result;";
  $req = mysqli_query($conn, $checkQuery);
  if ($req == true) {
    $result = mysqli_fetch_assoc($req);
    if ($result['result'] == 0) {
      $response = $failure;
    } elseif ($result['result'] == 1) {
      $query = "UPDATE orders set quantity=$quantity WHERE product_variant_id=$pv_id and cart_id=$cart_id;";
      // popMsg($query);
      $req = mysqli_query($conn, $query);
      if ($req) {
        $response = $success;
      } else if ($req == false) {
        $response = $failure;
      } else {
        $response = $errore;
      }
    }
  } else {
    $response = $errore;
  }
  echo json_encode($response);
}
//update order quantity in cart end
//update order quantity in cart end

//checkout action
//checkout action
if (isset($_POST['proceed_checkout'])) {
  //delivery details
  $full_name = trim($_POST['full_name']);
  $phone = trim($_POST['phone']);
  $province = trim($_POST['province']);
  $district = trim($_POST['district']);
  $nonloginemail = trim($_POST['nonloginemail']);
  // $city = trim($_POST['city']);
  $municipality = trim($_POST['municipality']);
  $tole = trim($_POST['tole']);
  $cart_id = trim($_POST['cart_id']);
  $payment_mode = trim($_POST['payment_mode']);
  $payment_mode = strtolower($payment_mode);
  $payment_status = 'pending';
  $id = get_primary_id("delivery_payment_details");
  // echo 'The ID is' . $id . "<br>";
  $products = $_POST["products_to_checkout"];
  // $count=count($products);
  $ref_id = 'CRT-' . $cart_id . '-' . $id;
  $hasCoupon = trim($_POST['hasCouponID']); //echo "has coupon : ".$hasCoupon;
  $response='blank';
  global $failure;
  global $errore;

  // $query = "INSERT INTO `delivery_address`(`id`, `province`, `district`, `city`, `municipality`, `tole`, `cart_id`, `modify_date`, `remarks`) VALUES ('$id','$province','$district','$city','$municipality','$tole','$cart_id',now(),'');";
  $query = "INSERT INTO `delivery_payment_details`(`id`,`full_name`, `province`, `district`, `municipality`, `tole`,`checkouts_email`,`phone`, `cart_id`, `payment_mode`,`payment_status`, `reference_no`,`modify_date`, `remarks`) VALUES ('$id','$full_name','$province','$district','$municipality','$tole','$nonloginemail','$phone','$cart_id','$payment_mode','$payment_status','$ref_id',now(),'');";
//   echo   $query ;
  $address_added = 0;
  $products_added = 0;
  // echo $query;
  $req = mysqli_query($conn, $query);
  if ($req) {
    $address_added = 1;
  } else if ($req == false) {
    $address_added = 0;
    $response = $failure;
    array_push($response,array("message_2"=>"could not save delivery address"));
  } else {
    $address_added = 0;
    $response = $errore;
  }
  $_prodarray = explode(",", $products);
  if ($address_added == 1) {
    // product details insert to cart checkout table;
    //foreach ($products as $product) {
    for ($_i = 0; $_i < count($_prodarray); $_i++) {

      $_ex = explode("#", $_prodarray[$_i]);

      $product_v_id = $_ex[0]; //this is product varient id
      $quantity = $_ex[1]; //this is the quantity 
      $grab_details = "SELECT p.actual_Price,p.sell_Price,p.actual_Price-p.sell_Price as discount FROM `productvariant` pv 
        inner join products p on pv.product_id=p.id
        WHERE pv.id=$product_v_id;";
      // echo $grab_details;
      $requestd_details = run_query($grab_details);
      $rate = 0;
      $discount = 0;
      foreach ($requestd_details as $val) {
        // echo " ".$val['actual_Price']." ";
        // echo $val['discount'];
        $rate = $val['actual_Price'];
        ;
        $discount = $val['discount'];
      }
      $discount = $quantity * $val['discount'];
      $sql = "INSERT INTO `checkouts`(`cart_id`, `product_v_id`, `quantity`, `rate`, `discount`, `dpd_id`, `modify_date`, `remarks`) VALUES ('$cart_id','$product_v_id','$quantity','$rate','$discount','$id',now(),'');";
      // echo $sql;
      $result = mysqli_query($conn, $sql);
      if ($result) {
        $products_added = $products_added + 1;
        if (delete_cart_item($product_v_id, $cart_id) == 1) {
          // echo "<br>deleted item =".$product_v_id."<br>";
            //update the quantity of the varient on checkout
            update_product_quantity_on_checkout($product_v_id,$quantity);
        } else {
        //   echo "<br>Unable to delete item =" . $product_v_id . "<br>";
          $products_added=0;
        }
      } else if ($result == false) {
        $products_added = 0;
      } else {
        $products_added = 0;
      }
    }
  }
  if ($address_added == 1 && $products_added >= 1) {
     if(createInvoice($ref_id,$hasCoupon)){
         $amt_receivable = give_total_receivable_amount($ref_id); //echo "Total Receivables :".$amt_receivable;
         if(update_coupon_user($hasCoupon,$nonloginemail)){
             $to = $nonloginemail;// echo $to; 
             $sub= "Order Confirmation Email";// echo " sub :".$sub;
             $body = print_My_Invoice($ref_id); //echo "<textarea>".$body."</textarea>";
             $from = "sales@delinepal.com"; //echo " from ".$from;
             $sendMail=sendEmail($to,$sub,$body,$from); //echo "send Mail :".$sendMail." send Mail";
    if($sendMail){
    $response = array(
      'message' => 'success',
      'status_code' => '200',
      'reference_code' => $ref_id,
      'payBy'=>$payment_mode,
      'receivable_amt'=>$amt_receivable,
      'mail_sent'=>'sent'
    );
    }else{
        $response = array(
      'message' => 'success',
      'status_code' => '200',
      'reference_code' => $ref_id,
      'payBy'=>$payment_mode,
      'receivable_amt'=>$amt_receivable,
      'mail_sent'=>'cannot send'
    );
    }       
         }else{
            $response=array(
      'message' => 'success',
      'status_code' => '200',
      'reference_code' => $ref_id,
      'payBy'=>$payment_mode,
      'receivable_amt'=>$amt_receivable,
      'coupon_assigned'=>0
    );
         }
  } else {
    $response = $failure;
    array_push($response,array('invoice_create'=>0));
  }
  }else{
    $response = $failure;
    array_push($response,array('condition_match'=>0));
  }
  echo json_encode($response);
}
// echo "invoice Created : ".createInvoice('ULT-646-23','0');
function give_total_receivable_amount($ref_id){
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `invoicerecord` where refId='$ref_id'),1,0)as result;";
    $result = check_if_exist($check_query);
    if($result==1){
        $sql = "SELECT `amt_receivable`,`delivery_fee` FROM `invoicerecord` where refId='$ref_id';";
        $data = get_Table_Data($sql);
        if($data!=0){
            //extract data 
            $shipping_fee=0;
            $amt_receivable = 0;
            foreach($data as $da){
            $amt_receivable = $da['amt_receivable']; //echo "amount receivable : ".$amt_receivable;
            if($da['delivery_fee']==null){
            $shipping_fee=0;
            }else{
            $shipping_fee=$da['delivery_fee'];
            }
            // echo "<br> Shipping fee is : ".$shipping_fee;
            }
            return $shipping_fee+$amt_receivable;
        }
        else{
            //no data available
            return 0;
        }
    }else{
        return 0;
    }
    
}

// echo "Has total : ".give_total_receivable_amount('ULT-646-23');

function update_product_quantity_on_checkout($product_v_id,$quantity){
    //now update the stockout and total of the product varient Table
    $check_query = "SELECT IF(EXISTS (SELECT * FROM `productvariant` where `id`=$product_v_id),1,0)as result;";
    // echo "check Query : ".$check_query;
    $result = check_if_exist($check_query);
    if($result==1){
        // echo "prodict varient does exist";
        $sql="SELECT `stock_out`, `available`, `total` FROM `productvariant` where `id`=$product_v_id;";
        $data = get_Table_Data($sql);
        if($data!=0){
            $stockout=0;
            $available=0;
            $total=0;
            foreach($data as $da){
            $stockout=$da['stock_out'];
            $available=$da['available'];
            $total=$da['total'];  
            }
            // echo "<br>quantity: ".$quantity."<br>";
            // echo "stock-out: ".$stockout."<br>";
            // echo "available: ".$available."<br>";
            // echo "Total: ".$total;
            // echo "<br>Before<hr><hr>After<br>";
            $stockout=$stockout+$quantity;
            $available=$available-$quantity;
            $total=$total-$quantity;
            // echo "quantity: ".$quantity."<br>";
            // echo "stock-out: ".$stockout."<br>";
            // echo "available: ".$available."<br>";
            // echo "Total: ".$total."<br>";
            $update_stock_query = "UPDATE `productvariant` SET `stock_out`=$stockout,`available`=$available,`total`=$total WHERE `id`=$product_v_id;";
            // echo $update_stock_query;
            // echo "<br> The return of update Query : ";
            if(! $response = run_update_query($update_stock_query)){
                return $response;
            }
            // echo "<br>";
        }
    }else{
        echo "prodict varient does not exist";
    }
}
// update_product_quantity_on_checkout(1,2);
// echo "<hr>";

function createInvoice($refID,$hasCoupon){
    $check_exist = "SELECT IF ( EXISTS (SELECT * FROM `checkouts` 
    INNER JOIN `delivery_payment_details` dpd on checkouts.dpd_id=dpd.id
    where dpd.reference_no='$refID'),1,0)as result;";
    $result = check_if_exist($check_exist);
    if($result == 1){
        //code to get details of product sold
        $sql = "SELECT checkouts.quantity,checkouts.rate,checkouts.discount FROM `checkouts` INNER JOIN `delivery_payment_details` dpd on checkouts.dpd_id=dpd.id where dpd.reference_no='$refID';";
        $data = get_Table_Data($sql);
        $total_amt = 0;
        $total_discount_amt = 0;
        foreach($data as $da){
            $a_product_total_amt=0;
            $qty=$da['quantity'];   //echo "individual Product total Quantity : ".$qty."<br>";
            $rate=$da['rate'];  //echo "individual Product Rate : ".$rate."<br>";
            $discount=$da['discount'];  //echo "individual Product Discount : ".$discount."<br>";
            $a_product_total_amt= $qty*$rate;   //echo "individual Product total amt : ".$a_product_total_amt."<br>";
            $total_after_discount = $a_product_total_amt-$discount; //echo "individual Product amt After Discount : ".$total_after_discount."<br><hr>";
            // echo "qty"." , "."rate"." , "."Total discount"." , "."a_product_total_amt"." , "."total_after_discount"."<br>";
            // echo $qty." , ".$rate." , ".$discount." , ".$a_product_total_amt." , ".$total_after_discount."<br><hr>";
            $total_discount_amt=$total_discount_amt+$discount;
            $total_amt = $total_amt+$a_product_total_amt;  //echo "multiple Product total amt : ".$total_amt."<br><hr>";
        }
        $total_amt_after_discount=$total_amt-$total_discount_amt; //echo "Total Amt :".$total_amt;echo "<br>Discount Amt :".$total_discount_amt;echo "<br>After Discount Amt :".$total_amt_after_discount;
        $coupon_value=get_coupon_value($hasCoupon);
            // echo "<h1>".$coupon_value."</h1>";
        if($coupon_value=="coupon_code_not_found"){
            $coupon_value=0;
        }
        // echo "Coupon Discount Value :".$coupon_value;
        $coupon_value_type=coupon_value_type($hasCoupon);
        // echo "<br>Coupon Value Type : ".$coupon_value_type."<br>";
        if($coupon_value_type=='percentage'){
            // echo "<h1>".$coupon_value."</h1>";
            $coupon_value = calculate_percentage_discount($total_amt_after_discount,$coupon_value); //echo "<br>coupon Value : ".$coupon_value;
        }
        // echo "<br>Discount Amount :".$total_discount_amt;
        $total_discount_amt=$total_discount_amt+$coupon_value;
        $total_after_discount=$total_amt-$total_discount_amt;
        $vat_amt = round($total_after_discount*0.13); // echo "<br> Vat Amount : ".$vat_amt;
        $total_after_vat = $total_after_discount+$vat_amt; //echo "<br>Total after Vat : ".$total_after_vat;
        // echo "<hr>Total Before Discount :".$total_amt."<br>";
        // echo "Total Discount :".$total_discount_amt."<br>";
        // echo "Coupon Discount :".$coupon_value."<br>";
        // echo "Total After All Discount :".$total_after_discount."<br>";
        // echo "Total Before Vat :".$total_after_discount."<br>";
        // echo "Vat Amount :".$vat_amt."<br>";
        // echo "Total After Vat :".$total_after_vat."<br>";
        $new_invoice = add_invoice_record($refID,$total_amt,$total_discount_amt,$hasCoupon,$vat_amt,$total_after_vat);
        // echo "new invoice : ".$new_invoice."<br>";
        if($new_invoice==1){
            //invoice created now proceed ahead
            return 1;
        }else if($new_invoice==55){
            //cannot checkout same cart at multiple times i.e. Duplicate entry trying to make duplicate entry
            echo "Trying to make duplucate entry.";
        }else{
            echo "something went wrong";
        }
        //code to get details of product sold
    }else if($result == 0){
        //response saying no checkout done with this reference no. i.e ref no doesnot exist
        return 0;
    }else{
        //response saying error
        return 0;
    }
}


// createInvoice('ULT-4546-154','HAHA22');
// echo "<hr>";
// createInvoice('ULT-3394-130','ZING10');
// coupon functions 
// coupon functions 
function add_invoice_record($refID,$total_amt,$purchase_discount,$hasCoupon,$vat_amt,$total_after_vat){
    $id = get_primary_id('invoicerecord');
    $sql = "INSERT INTO `invoicerecord` (`id`, `refID`, `total_amount`, `purchase_discount`, `coupon_code`, `vat_amt`, `amt_receivable`, `remarks`) VALUES ($id,'$refID',$total_amt,$purchase_discount,'$hasCoupon',$vat_amt,$total_after_vat,'');";
    // echo $sql;
    $conn = connectdb();
    $req = mysqli_query($conn,$sql);
    if($req){
        // echo "invoice Created";
        return 1;
    }else{
        $err = mysqli_error($conn);
        // echo "invoice NOT Created<br>";
        // echo $err;
        if(strpos($err,'uplicate')){
            // echo "Duplicate Entry";
            return 55;
        }else{
            echo "function strpos not working";
        }
        return 0;
    }
}
// coupon functions 
// coupon functions
// include 'discountControl.php';
// coupon functions 
// coupon functions 

function today(){
        $date = date("2030-12-02 20:15:00");
        $today = date("Y-m-d H:i:s");
    echo "today is ".$today;
    echo "<br>";
    if($date > $today){
        echo $date." is greater then ".$today;
    }else{
        echo $date." is less then ".$today;
    }
}

// today();
// testing coupon 
    // testing coupon 
        // echo "<br>";
        // $coupon_value=get_coupon_value('DISC200');
        // $coupon_value_type=coupon_value_type('DISC200');
        // $display_coupon_value=assign_symbol_of_coupon_value_type($coupon_value_type,$coupon_value);
        // echo "This is coupon Value : ".$display_coupon_value;
        // echo "<br>";
        // $coupon_value=get_coupon_value('ZING15');
        // $coupon_value_type=coupon_value_type('ZING15');
        // $display_coupon_value=assign_symbol_of_coupon_value_type($coupon_value_type,$coupon_value);
        // echo "This is coupon Value : ".$display_coupon_value;
        // echo "<br>";
        // $coupon_state = check_if_coupon_used('Haha22');
        // echo "Coupon State :".$coupon_state;
        // echo "<br>";
        // $validity = coupon_validity('HAHA22');
        // echo $validity;
        // echo "<br>";
    // testing coupon 
// testing coupon 

//checkout action
//checkout action
function delete_from($sql){
  $conn = connectdb();
  $result = mysqli_query($conn, $sql);
  if ($result) {
    if (mysqli_affected_rows($conn) == 1) {
      return 200;
    } else {
      return 0;
    }
  } else {
    return 0;
  }
}

// delete orders
// delete orders
if (isset($_POST['delete_cart_product'])) {
  $pv_id = $_POST['delete_cart_product'];
  // $pv_id=$_POST['pv_id'];
  $cart_id = $_POST['cart_id'];
  $query = "DELETE FROM `orders` WHERE `product_variant_id`=$pv_id and `cart_id`=$cart_id;";
  $result = delete_from($query);
  if ($result == 200) {
    $response = $success;
  } else {
    $response = $failure;
  }
  echo json_encode($response);
}
// delete orders
// delete orders

function delete_cart_item($pv_id,$cart_id){
  $query = "DELETE FROM `orders` WHERE `product_variant_id`=$pv_id and `cart_id`=$cart_id;";
  $result = delete_from($query);
  if ($result == 200) {
    return 1;
  } else {
    return 0;
  }
}


function give_response($code)
{

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
    $nodata = array(
        'message' => 'unknown',
        'status_code' => '404'
    );
    $parentrow = array(
        'message' => 'Parent row',
        'status_code' => '1451'
    );
    $duplicate = array(
        'message' => 'Duplicate Entry',
        'status_code' => '55'
    );

    switch ($code) {
        case '200':
            return $success;
            break;
        case '201':
            return $failure;
            break;
        case '502':
            return $errore;
            break;
        case '501':
            return $response;
            break;
        case '404':
            return $nodata;
            break;
        case '1451':
            return $parentrow;
            break;
        case '55':
            return $duplicate;
            break;
        default:
            # code...
            break;
    }
}

if(isset($_POST['register_vendor_user'])){
    //response
    $response="";
    //operation
    $company_name = $_POST['register_vendor_user'];
    $email = $_POST['venEmail'];
    $user_type = "Null";
    $pass = $_POST['Password'];
    $vat = $_POST['Vatno']; if($vat==''){$vat=0;}
    $pan = $_POST['panno']; if($pan==''){$pan=0;}
    $contact = $_POST['contact'];
    $address = $_POST['province'].", ".$_POST['district'].", ".$_POST['municipality'];
    $id = get_primary_id('vendor_users');
    $check_exist = "SELECT IF (EXISTS (SELECT * FROM `vendor_users` WHERE `vendor_company_name`='$company_name' AND `vendor_email`='$email'),1,0) as result;";
    if($vat=='0' && $pan=='0'){
        $response = give_response(201);
    }
    else if(check_if_exist($check_exist)){
        $response = give_response(55);
    }else{
        $enc_pass=md5($pass);
        $ins_qry="INSERT INTO `vendor_users` (`id`,`active_state`,`user_type`, `vendor_company_name` , `vendor_email`, `vendor_pass`, `vendor_contact`, `vendor_pan`, `vendor_vat`, `vendor_address`, `remarks`) VALUES ($id,'0','$user_type','$company_name','$email','$enc_pass','$contact','$pan','$vat','$address','');";
        // echo $ins_qry;
        $conn = connectdb();
        $req_insert = mysqli_query($conn,$ins_qry);
        if($req_insert){
            $to = $email;
            $subject ="Vendor User Created";
            $message ="Dear ".$email." Delinepal received your details for registration. Please wait for the conformation. Thank you.";
            $from = "account@delinepal.com";
            $header = "From: $from";
            mail($to,$subject, $message,$header);
            $response = array("status_code"=>200,
            "message"=>'success');
        }else{
            $response = array("status_code"=>201,
            "message"=>'Failure');
        }
    }
    echo json_encode($response);
}
?>