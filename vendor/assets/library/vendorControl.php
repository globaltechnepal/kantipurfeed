<?php
include 'library.php';

if(isset($_POST['create_list'])){
    $response='';
    //to add fev list of vendor.
    //catching veriables and data
    $list_name=$_POST['create_list'];
    $vendor_email= $_POST['vendorEmail'];
    $products_id = $_POST['products_id'];
    $fav_list_id = add_favourite_list_parent($list_name,$vendor_email); //echo $fav_list_id;
    if($fav_list_id=='duplicate'){
        //give response of failure
        $response=array('status_code'=>55,
            'messsage'=>'error',
            'message_2'=>'list name aready exist.');
    }
    else if($fav_list_id!='failed'){
        //now add products in list
        if(add_favourite_list_item($fav_list_id,$products_id)){
            //give success
            $response=array('status_code'=>200,
            'messsage'=>'success');
        }else{
            //give failure
            $response=array('status_code'=>201,
            'messsage'=>'failed');
        }
    } else{
            //give failure
            $response=array('status_code'=>201,
            'messsage'=>'error');
        }
    echo json_encode($response);
}
function add_favourite_list_parent($list_name,$vendor_email){
    $check_exist= "SELECT IF (EXISTS (SELECT * FROM `vendor_fav_list` WHERE `list_name`='$list_name' and `vendor_email`='$vendor_email'),1,0)as result;";
    if(check_if_exist($check_exist)){
        //return list name already exist use another name
        return 'duplicate';
    }else{
        //perform create list action
        $id=get_primary_id('vendor_fav_list');
        $insert_query="INSERT INTO `vendor_fav_list` (`id`, `vendor_email`, `list_name`, `remarks`) VALUES ($id,'$vendor_email','$list_name','');";
        if(run_insert_query($insert_query)){
            //return success
            return $id;
        }else{
            //return error response if not entered
            return 'failed';
        }
    }
}
function add_favourite_list_item($fav_list_id,$products_id){
    $status = true;
    //now add lists of products
    foreach($products_id as $product_id){
        $list_item_id = get_primary_id('vendor_fav_list_item');
        $insert_qry="INSERT INTO `vendor_fav_list_item` (`id`, `fav_list_id`, `product_id`, `remarks`) VALUES ($list_item_id,'$fav_list_id','$product_id','');";
        if(!run_insert_query($insert_qry)){
            $status = false;
        }
    }
    return $status;
}
//add list finish here

//get list start here

if(isset($_POST['get_fav_list'])){
    $list_id=$_POST['get_fav_list'];
    $vendor_email=$_POST['vendor_email'];
    $data = get_list_data($list_id,$vendor_email);
    $response=array('status_code'=>200,'message'=>'success','data'=>$data);
    echo json_encode($response);
}

function get_list_data($list_id,$vendor_email){
    $check_exist="SELECT IF( EXISTS (SELECT * FROM `vendor_fav_list` WHERE `id`='$list_id' AND `vendor_email`='$vendor_email'),1,0)as result";
    $check_exist2="SELECT IF( EXISTS (SELECT * FROM `vendor_fav_list_item` WHERE `fav_list_id`='$list_id'),1,0)as result";
    if(check_if_exist($check_exist) && check_if_exist($check_exist)){
        //return of data in list
    $select_query="SELECT p.id,c.category_name,p.product_code,p.product_name,p.actual_Price,p.sell_Price,p.retailer_price,p.wholesaler_price,p.dealer_price,p.img_path,p.primary_image as img FROM `vendor_fav_list_item` fli
    INNER JOIN vendor_fav_list vfs on vfs.id=fli.fav_list_id
    INNER JOIN products p on p.id=fli.product_id
    INNER JOIN category c on c.category_id=p.category_id
    WHERE vfs.id=$list_id;";
    $data=get_Table_Data($select_query);
    if($data!=0){
        return $data;
    }else{
        //
        return 0;
    }
    }else{
        //no data found
        return 0;
    }
}
// var_dump(get_list_data('3','ananda.globaltech@gmail.com'));
//delete checkout list
if(isset($_POST['delete_order_list'])){
    $list_id=$_POST['delete_order_list'];
    $_email=$_POST['vendor_email'];
    $response=remove_list($list_id,$_email);
    echo json_encode($response);
}
// $list_id=1;
// $_email='sangin.globaltech@gmail.com';
// echo json_encode(remove_list($list_id,$_email));
function remove_list($list_id,$_email){
    $response='';
    $check_exist="SELECT IF ( EXISTS (SELECT * FROM `vendor_checkout` WHERE `vendor_email`='$_email' AND `id`=$list_id),1,0) as result;";
    if(check_if_exist($check_exist)){
        // echo "List exist";
        $check_exist="SELECT IF ( EXISTS (SELECT * FROM `vendor_checkout_items` WHERE `vendor_checkout_id`=$list_id),1,0) as result;";
        if(check_if_exist($check_exist)){
            // echo "Sub List exist";
            $del_qry="DELETE FROM `vendor_checkout_items` WHERE `vendor_checkout_id`=$list_id";
            if(run_delete_query($del_qry)!=0){
                //delete sub list succes
                //now delete main list
            $del_qry="DELETE FROM `vendor_checkout` WHERE `vendor_email`='$_email' AND `id`=$list_id";
             if(run_delete_query($del_qry)!=0){
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'delete success'
                     );
             }else{
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'sublist deleted but cannot delete main list'
                     );
             }
            }else{
                $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'cannot delete sub list'
                     );
            }
        }else{
            // echo "Sub list not exist so delete list only";
             $del_qry="DELETE FROM `vendor_checkout` WHERE `vendor_email`='$_email' AND `id`=$list_id";
             if(run_delete_query($del_qry)!=0){
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'delete success'
                     );
             }else{
                 $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'cannot delete list'
                     );
             }
        }
    }else{
        // echo "list not exist";
        $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'list doesnot exist'
                     );
    }
    return $response;
}


//delete fav_list
if(isset($_POST['delete_list'])){
    $list_id=$_POST['delete_list'];
    $_email=$_POST['vendor_email'];
    $response=remove_fav_list($list_id,$_email);
    echo json_encode($response);
}

// echo json_encode(remove_fav_list($list_id,$_email));
function remove_fav_list($list_id,$_email){
    $response='';
    $check_exist="SELECT IF ( EXISTS (SELECT * FROM `vendor_fav_list` WHERE `vendor_email`='$_email' AND `id`=$list_id),1,0) as result;";
    if(check_if_exist($check_exist)){
        // echo "List exist";
        $check_exist="SELECT IF ( EXISTS (SELECT * FROM `vendor_fav_list_item` WHERE `fav_list_id`=$list_id),1,0) as result;";
        if(check_if_exist($check_exist)){
            // echo "Sub List exist";
            $del_qry="DELETE FROM `vendor_fav_list_item` WHERE `fav_list_id`=$list_id";
            if(run_delete_query($del_qry)!=0){
                //delete sub list succes
                //now delete main list
            $del_qry="DELETE FROM `vendor_fav_list` WHERE `vendor_email`='$_email' AND `id`=$list_id";
             if(run_delete_query($del_qry)!=0){
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'delete success'
                     );
             }else{
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'sublist deleted but cannot delete main list'
                     );
             }
            }else{
                $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'cannot delete sub list'
                     );
            }
        }else{
            // echo "Sub list not exist so delete list only";
             $del_qry="DELETE FROM `vendor_fav_list` WHERE `vendor_email`='$_email' AND `id`=$list_id";
             if(run_delete_query($del_qry)!=0){
                 $response=array(
                     'status_code'=>'200',
                     'message'=>'success',
                     'message_2'=>'delete success'
                     );
             }else{
                 $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'cannot delete list'
                     );
             }
        }
    }else{
        // echo "list not exist";
        $response=array(
                     'status_code'=>'201',
                     'message'=>'error',
                     'message_2'=>'list doesnot exist'
                     );
    }
    return $response;
}


function nothing(){
    echo '
    <h1>Vendor mora</h1>

vendor list table
list_sn_id, vendor_id, list_name, create_date, remarks

list_items table
list_item_sn, list_id, product_varient_id, add_update_date, remarks

checkout for vendor 

vendor_checkout_table
checkout_id, vendor_id, checkout_date,

vendor_checkout_items table
item_sn, checkout_id, item_id, quantity, unit, rate, check_out_date  
    ';
}
?>



