<?php
// include 'dashboard_functions.php';

//give colors not used
//give colors not used
function give_unused_colors($product_id){
    $sql = "SELECT * FROM `colors` WHERE `color_name` NOT IN(SELECT colors.color_name FROM colors INNER JOIN `productvariant` on productvariant.color_id=colors.id WHERE `product_id`=$product_id);";
    // echo $sql;
    $list = get_Table_Data($sql);
    return $list;
}
function build_options($list,$colNamevalue,$colNameDisplay){
    if($list!=0){
        $html = "";
        foreach($list as $option){
            $html .= '<option value="'.$option[$colNamevalue].'">'.$option[$colNameDisplay].'</option>';
        }
        return $html;
    }else{
        return '';
    }
}
// $lists = give_unused_colors(1);
// echo "<textarea>test ext".build_options($lists,'id','color_name')."</textarea>";
// $lists = give_unused_colors(1);
// echo json_encode(build_options($lists,'id','color_name'));
//give colors not used
//give colors not used


// give me users name 
// give me users name 
function has_userName($email)
{
  $sql = "SELECT `username` from `admin` WHERE `email`='$email';";// echo $sql;
  $conn = dbConnecting();
  $req = mysqli_query($conn, $sql);
//   if($req){
//       echo "executed.";
//   }else{
//       echo "Not executed.";
//   }
  $result = mysqli_fetch_assoc($req);
  $val = $result['username'];
  if ($val != '') {
    return $val;
  } else if ($val == '') {
    return $email;
  } else {
    return mysqli_error($conn);
  }
  mysqli_close($conn);
}
// echo "<br>UserName : ".has_userName('ultima22@gmail.com');
// give me users name 
// give me users name 


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
//this function gives total receivable amount if invoice is created 

function delete_file($path, $fileName)
{
    //   echo "Running delete_file";
    $file = $path . $fileName;
    if (file_exists($file)) {
        // echo "file exist";
        $status = unlink($file);
        if ($status) {
            //   echo "File deleted successfully";  
            return 1;
        } else {
            //   echo "Sorry!";    
            return 0;
        }
    } else {
        // echo "file donot exist";
        return 1;
    }

}
// delete_file('','abc.png');

//get images of foldersss
function images_in_folder($dir)
{
  //get current directory
  $working_dir = getcwd();
  // echo $working_dir."<br>";
  //get image directory
  $img_dir = $working_dir . "/" . $dir;
  // echo $img_dir;
  //change current directory to image directory
  chdir($img_dir);
  //using glob() function get images 
  $files = glob("*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}", GLOB_BRACE);
  //again change the directory to working directory
  chdir($working_dir);
  return $files;
}//get images of foldersss

function make_dir($name)
{
    if (!is_dir($name)) {
        mkdir($name, 0755);
        echo "new directory made";
    }
}

function remove_all_from_dir($name)
{
    $files = glob($name . '/*');
    // echo "Folder deleted";
    foreach ($files as $file) {
        unlink($file);
    }
    if (count(glob("$name/*")) === 0) {
        return 1;
    } else {
        return 0;
    }

}
function remove_dir($name)
{
if(is_dir($name)){
    if (rmdir($name)) {
        // echo "Folder deleted";
        return 1;
    } else {
        // echo "Can not deleted";
        return 0;
    }
}else{
        // echo "No folder exist";
    return 1; //because there is no folder to delete
}
    
}
// make_dir('NAME');
// remove_dir('NAME');

function check_row_affected($conn)
{
    $rows = mysqli_affected_rows($conn);
    return $rows;
} //returns number of rows that has been affected on the particular connection 


//this function only used by history talble
function run_basic_query($query)
{
    try {
        $conn = dbConnecting();
        $req = mysqli_query($conn, $query);
        if ($req) {
            //check rows affected
            return check_row_affected($conn); // checking how many rows has been affected
        } else if (!$req) {
            echo mysqli_error($conn);
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
} //run query global function.


//run insert query using this function
function run_basic_insert_query($query)
{
    try {
        $conn = dbConnecting();
        $req = mysqli_query($conn, $query);
        if ($req) {
            //check rows affected
            history_table($query, true);
            return check_row_affected($conn); // checking how many rows has been affected
        } else if (!$req) {
            history_table($query, false);
            echo mysqli_errore($conn);
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
} //run query global function.

function history_table($query, $status)
{
    if($status==true){
        $status=1;
    }
    else{
        $status=0;
    }
    
    $id = get_primary_id("history_table");
    $query = modify_query($query);
    // echo $query . "<br>";
    $executed_by = give_executed_by();
    $history_query = "INSERT INTO `history_table`(id, `querys`,`executed_by`, `executed`,`remarks`) VALUES ('$id','$query','$executed_by',$status,'');";
    // echo $history_query;
    //now executing query
    $returned_response = run_basic_query($history_query);
    // echo "run basic query:".$returned_response;
    if ($returned_response > 0) {
        //success code
        // echo "success";
        return 1;
    } else if ($returned_response == 0) {
        //failure code
        // echo "failure";
        return 0;
    }
} // history table exist of all the query that has been executed in admin dashboard

function give_executed_by(){
    if(isset($_SESSION['adminemail'])){
        return $_SESSION['adminemail'];
    }else if(!isset($_SESSION['adminemail'])){
        session_start();
        if(isset($_SESSION['adminemail'])){
        return $_SESSION['adminemail'];
    }else{
        return 'session email not set';
    }
    }
    else{
        return 'session email not set';
    }
}

function modify_query($query)
{
    try {
        $data = str_replace("'", "''", "$query");
        return $data;
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
} //function to make query insertable in table. 

function get_primary_id($tblName)
{
    $conn = dbConnecting();
    $query = "SELECT  case when isnull(max(id))then 1 else  (max(id))+1 end as new_id FROM `$tblName`;";
    $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
    // echo $query;
    if ($req == true) {
        $id = mysqli_fetch_assoc($req);
        // echo $id['id'];
        return $id['new_id'];
    } else {
        return 1;
    }
} //gives new primary id according to table name.

function popMsg($msg)
{
?>
<script>
    alert("<?php echo $msg; ?>");
</script>
<?php
}

// new category 
// new category 
function getID($sql)
{
    $conn = dbConnecting();
    $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    // echo $sql;
    if ($req == true) {
        $id = mysqli_fetch_assoc($req);
        echo $id['id'];
        return $id['id'];
    } else {
        return 1;
    }

}


function check_if_exist($sql)
{
    $conn = dbConnecting();
    $req = mysqli_query($conn, $sql);
    $result = mysqli_fetch_assoc($req);
    $val = $result['result'];
    if ($val == 1) {
        return 1;
    } else if ($val == 0) {
        return 0;
    } else {
        return mysqli_error($conn);
    }
    mysqli_close($conn);
}
// check if exist in database end
// check if exist in database end

//use to get all table data from database
//use to get all table data from database
function get_Table_Data($sql)
{
    $conn = dbConnecting();
    $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if (!$req) {
        return 0;
    } else if (mysqli_num_rows($req) != 0) {
        // history_table($sql, true);
        $list = [];
        $i = 1;
        while ($data = mysqli_fetch_assoc($req)) {
            $list[$i] = $data;
            $i = $i + 1;
        }
        return $list;
    } else {
        history_table($sql, false);
        return 0;
    }
}
//use to get all table data from database end
//use to get all table data from database end

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

function check_ecxeptions($msg)
{
    if (strpos($msg, 'parent')) {
        return 1451;
    } else if (strpos($msg, 'foreign')) {
        return 201;
    } else if(strpos($msg,'uplicate')){
        return 55;
    }else {
        return 404;
    }
}

function run_update_query($sql){
    $conn = dbConnecting();
    $req = mysqli_query($conn,$sql);
    if($req){
        history_table($sql, true);
        //success
        // echo "query executed";
        $row = mysqli_affected_rows($conn);
        // echo "affected Row : ".$row;
        if($row==1){
            return 1;
        }else{
            mysqli_error($conn);
            return 0;
        }
    }else{
        //failed
    }
}

function give_level(){
    // session_start();
    $email=$_SESSION['adminemail'];
    $sql = "SELECT `superAdmin`, `admin`, `subAdmin` FROM `admin` WHERE `email`='$email';";
    $data = get_Table_Data($sql);
    if($data!=0){
        foreach($data as $data){
        if($data['superAdmin']){
            return 'superAdmin';
        }else if($data['admin']){
            return 'admin';
        }else if($data['subAdmin']){
            return 'subadmin';
        }}
    }else{
        return 'no data found';
    }
}

// echo "hello: ".give_level();

function send_create_admin_user_email($to,$adminType,$psw){
    // echo 'send_create_admin_user_email';
    $from="account@delinepal.com"; //pass = 5IgGeMgKEP#7
    $sub = "Notice";
    $body = "Dear employe,\n\nYou are now a ".$adminType.". Use your email and password to login.\n\n \t\tPassword : <strong>".$psw."</b>\n\n\tLogin link:https://ultimanepal.com/adminlogin.php \n\n Thank You!\nSuper Admin.";
    return send_my_Email($to,$sub,$body,$from);
}

// function to send email 
function send_my_Email($to,$sub,$body,$from){
    // echo "send_my_Email";
    $to_email = $to;
    $subject = $sub;
    $body = $body;
    $headers = "From: ".$from. "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $mail_sent = mail($to_email, $subject, $body, $headers);
    // echo $mail_sent ? "Mail sent vayo" : "Mail failed";
    // return $mail_sent ? 1 : 0;
    $send_status= $mail_sent ? 1 : 0;
    if($send_status){
        return my_email_send_history($from,$to,$sub,$body,$send_status);
    }else{
        return 0;
    }
}
//sendEmail('$to','$sub','$body');
// function to send email 
// function to keep record of sent emails 
// function to keep record of sent emails 
function my_email_send_history($from,$to,$sbu,$body,$send_status){
    // echo "my_email_send_history";
    $id=get_primary_id('email_send_history_table');
    $body = modify_my_query($body);
    $sql="INSERT INTO `email_send_history_table`(`id`, `from_email`, `to_email`, `email_subject`, `email_body`, `send_status`, `send_date`, `remarks`) VALUES ($id,'$from','$to','$sub','$body',$send_status,now(),'');";
    $insert_ok = run_basic_query($sql);// echo "INsert stat : ".$insert_ok;
    return $insert_ok;
}
// function to keep record of sent emails 
// function to keep record of sent emails 


function modify_my_query($query)
{
    // echo "modify_my_query";
    try {
        $data = str_replace("'", "''", "$query");
        return $data;
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
    }
} //function to make query insertable in table. 

// function mail_sender($to,$sub,$from,$body){
function mail_sender(){
    $to = 'anandaaryal54@gmail.com';
    
    $subject = 'Testing Email service';
    $from = 'account@ultimanepal.com';
    $headers  = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "BCC: sangin.globaltech@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    
    $message = '<p>HEllo World !<strong>This is strong text</strong> while this is not.</p><p>This is <b>Bold</b> Text.<br> This is <i>italic</i>.</p>';
    $message = $message.'<hr> <img src="https://ultimanepal.com/ultima.png"><hr>';
    $mail_sent = mail($to, $subject, $message, $headers);
    $send_status= $mail_sent ? 1 : 0;
    return $send_status;
}

// echo "Mail send with logo image status from support : ".mail_sender();



// functions of vendor control

function give_total_receivable_amt($checkout_id){
    $check_query="SELECT IF( EXISTS (SELECT sum(`total_after_discount`) as total FROM `vendor_checkout_items` WHERE `vendor_checkout_id`='$checkout_id'),1,0) as result;";
    if(check_if_exist($check_query)){
    $select_sql="SELECT sum(`total_after_discount`) as total FROM `vendor_checkout_items` WHERE `vendor_checkout_id`='$checkout_id';";
    $data = get_Table_Data($select_sql);
    if($data==0){
        return 'not found';
    }else{
        $returnVal='';
        foreach($data as $da){
        $returnVal=doubleVal($da['total']);
        }
        return $returnVal;
    }
    }
}

function give_advance_amt($checkout_id){
    $check_query="SELECT IF( EXISTS (SELECT * FROM `vendor_delivery_record` WHERE `checkout_id`='$checkout_id'),1,0) as result;";
    if(check_if_exist($check_query)){
    $select_sql="SELECT `pay_amt` FROM `vendor_delivery_record` WHERE `checkout_id`='$checkout_id';";
    $select_sql="SELECT IFNUll((SELECT pay_amt FROM vendor_delivery_record WHERE checkout_id=$checkout_id),0) as advance_pay;";
    $data = get_Table_Data($select_sql);
    if($data==0){
        return 'not found';
    }else{
        $returnVal='';
        foreach($data as $da){
        $returnVal=doubleVal($da['advance_pay']);
        }
        return $returnVal;
    }
    }else{
        return 0;
    }
}
// echo "<h1>Advance received ".give_advance_amt(1)."</h1>";
// $nm=give_advance_amt(1);
// var_dump($nm);
// $num = doubleval($nm);
// var_dump($num);
// echo "<br>receivable amt ".give_advance_amt(2);
// echo give_total_receivable_amt(1)-give_advance_amt(1);

function give_due_amt($checkout_id){
    $first_val=give_total_receivable_amt($checkout_id);
    $second_val=give_advance_amt($checkout_id);
    $due=$first_val-$second_val;
    return $due;
}

function get_old_remarks($tbl_name,$checkout_id){
    $check_out="SELECT IF (EXISTS (SELECT * FROM `$tbl_name` WHERE id=$checkout_id),1,0) as result;";
    if(check_if_exist($check_out)){
        $select_data="SELECT `remarks` FROM `$tbl_name` WHERE id=$checkout_id";// echo $select_data;
        $data=get_Table_Data($select_data);
        $old_remarks='';
        foreach($data as $da){
        $old_remarks=$da['remarks'];
        }
        return $old_remarks;
        }else{
            return '';
        }
}

// echo get_old_remarks('vendor_checkout',"2");










// functions of vendor control












?>