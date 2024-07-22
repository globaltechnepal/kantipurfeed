<?php
ob_start();
require 'connection.php';
require 'historyControl.php';

function id_according_to_page($pagename)
{
  $check = "SELECT IF(EXISTS(select id,url_link from products),1,0) as result;";
  $result = check_if_exist($check);
  $id = 0;
  if ($result == 1) {
    $sql = "select id,url_link from products;";
    $list = get_Table_Data($sql);
    foreach ($list as $val) {
      if ($val['url_link'] == $pagename) {
        $id = $val['id'];
      }
    }
    return $id;
  } else {
    return $id;
  }
}

function popMsg($msg)
{
?>
<script>
  alert("<?php echo $msg; ?>");
</script>
<?php
}

function getProduct($tblname)
{
  $query = "select * from $tblname"; //$query = "select * from products";
  $conn = connectdb();
  $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
  if (!$req) {
    echo "cannot execute query";
    die();
  } else if (mysqli_num_rows($req) != 0) {
    $list = [];
    $i = 1;
    while ($data = mysqli_fetch_assoc($req)) {
      $list[$i] = $data;
      $i = $i + 1;
      // echo $data['id'].", ";
      // echo $data['name'].", ";
      // echo $data['actualPrice'].", ";
      // echo $data['sellPrice'].", ";
      // echo $data['path'].", ";
      // echo $data['primaryImage'].", ";
      // echo $data['secondaryImage']."<br>";
    }
    // return $data;
    $data = json_encode($list);
    echo $data;
  } else {
    echo "Nothing to show";
  }
}

if (isset($_POST['tableName']) == "products") {
  $tblname = $_POST['tableName'];
  getproduct($tblname);
  // $list = getproduct($tblname);
  // echo json_encode($list);
}

//Additional functions ----------------------------------------------------------------------------------------------------------------------------------
//generates random number
//generates random number
function getRendomValue()
{
  try {
    $chars = '147896325';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < 2; $i++) {
      $index = rand(0, $count - 1);
      $result .= mb_substr($chars, $index, 1);
    }
    if ($result >= 93 && $result <= 99) {
      $result = 92;
    }
    return $result;
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
}
//generates random number
//generates random number

//image uploader
//image uploader

//image uploader
//image uploader

// get id by table name moved from productCartControl page to here 
  function get_primary_id($tblName)
  {
    $conn = connectdb();
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
  }
// get id by table name moved from productCartControl page to here 

// check if exist in database 
// check if exist in database 
function check_if_exist($sql)
{
  $conn = connectdb();
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
  $conn = connectdb();
  $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if (!$req) {
    return 0;
  } else if (mysqli_num_rows($req) != 0) {
    $list = [];
    $i = 1;
    while ($data = mysqli_fetch_assoc($req)) {
      $list[$i] = $data;
      $i = $i + 1;
    }
    return $list;
  } else {
    return 0;
  }
}
//use to get all table data from database end
//use to get all table data from database end

// functions redefined 
// functions redefined 


function remove_coln($query)
{
  $string = str_replace(";", "", "$query");
  return $string;
}

// check exist 
function check_exist($query)
{
  $query = remove_coln($query);
  $conn = connectdb();
  $sql = "SELECT IF(EXISTS($query),1,0) as result;";
  // echo $sql;
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


function run_update_query($sql){
    $conn = connectdb();
    $req = mysqli_query($conn,$sql);
    if($req){
        maintain_history_table($sql, $status);
        //success
        // echo "query executed";
        $row = mysqli_affected_rows($conn);
        // echo "affected Row : ".$row;
        if($row==1){
            return 1;
        }else{
            // echo mysqli_error($conn);
            return 0;
        }
    }else{
        //failed
    }
}
function run_insert_query($sql){
    $conn = connectdb();
    $req = mysqli_query($conn,$sql);
    if($req){
        maintain_history_table($sql, $status);
        //success
        // echo "query executed";
        $row = mysqli_affected_rows($conn);
        // echo "affected Row : ".$row;
        if($row==1){
            return 1;
        }else{
            // echo mysqli_error($conn);
            return 0;
        }
    }else{
        //failed
    }
}

//run delete query
function run_delete_query($sql){
    $conn = connectdb();
    $req = mysqli_query($conn,$sql);
    if($req){
        maintain_history_table($sql, $status);
        //success
        // echo "query executed";
        $row = mysqli_affected_rows($conn);
        // echo "affected Row : ".$row;
        if($row>=1){
            return $row;
        }else{
            // echo mysqli_error($conn);
            return 0;
        }
    }else{
        //failed
    }
}

//run query function
function run_query($query)
{
  $conn = connectdb();
  $check = check_exist($query);
  if ($check == 1) {
    $list = get_Table_Data($query);
    return $list;
  } else {
    return 0;
  }
  mysqli_close($conn);
}
// functions redefined 
// functions redefined 

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
}

//function to get new primary key id
function getID($sql)
{
  $conn = connectdb();
  $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  echo $sql;
  if ($req == true) {
    $id = mysqli_fetch_assoc($req);
    echo $id['id'];
    return $id['id'];
  } else {
    return 1;
  }

}


// function to calculate individual average rating
// function to calculate individual average rating
function giveAvgReview($id){
    // echo "inside avg review";
    $sql = "SELECT IF(EXISTS(SELECT * FROM `reviews` WHERE `product_id`=$id),1,0)as result;";
    $result = check_if_exist($sql);
    $query = "SELECT * FROM `reviews` WHERE `product_id`=$id;";
    if($result==1){
        $data = get_Table_Data($query);
        $total_review = count($data);
        $review_sum = 0;
        $html='';
        foreach($data as $da){
            // echo $da['review_point']."<br>";
            $review_sum=$review_sum+$da['review_point'];
        }
        // <i class="bi bi-star-fill text-warning"></i> 4.5 | 999 reviews
        $avgReview = $review_sum/$total_review;
        if($avgReview>3){
            $html = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                      <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>';
        }else if($avgReview==3){
            $html = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                      <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z"/>
                    </svg>';
        }else{
            $html = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
</svg>';
        }
        $html = '<span style="font-size: 1.5rem;color:#ff4800;">'.$html."</span> ".$avgReview." | ".$total_review." reviews";
        // echo "<hr>";
        echo $html;
        // echo "<hr>";
        // echo "Total reviwe point:".$review_sum;
        // echo "Total reviwe count:".$total_review;
        // echo "Average reviwe :".$avgReview;
        // echo '<div class="text-white"><h1>Hello Check</h1>';
        // echo json_encode($data);
        // return $html;
    }else{
        $html = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
</svg>';
        $html = '<span style="font-size: 1.5rem;color:#ff4800;">'.$html."</span> 0 | 0 reviews";
        echo $html;
    }
}
// echo "hello";
// $he = giveAvgReview(7);
// echo $he;
// function to calculate individual average rating
// function to calculate individual average rating

// function thata gives invoice create date
// function thata gives invoice create date
function give_invoice_create_date($refID){
    // echo "I am in";
    $sql = "SELECT IF(EXISTS(SELECT * FROM `invoicerecord` WHERE `refID`='$refID'),1,0)as result;";
    $result = check_if_exist($sql); //echo "<BR>".$result;
    if($result){
        $sql = "SELECT `create_date` FROM `invoicerecord` WHERE `refID`='$refID';";
        $data = get_Table_Data($sql);
        if($data!=0){
            $create_date = '';
            foreach($data as $da){
            $create_date = $da['create_date'];
            }
            return $create_date;
        }else{
            return 0;
        }
    }
}
// echo "hy";
// echo "create Date : ".give_invoice_create_date('ULT-4546-154');
// function thata gives invoice create date
// function thata gives invoice create date

// function to return remaining quantity in percentage
// function to return remaining quantity in percentage

function availableStock($id){
    // echo "<h1>I am in</>";
    $sql = "SELECT IF(EXISTS(SELECT * FROM `productvariant` WHERE `product_id`=$id),1,0)as result;";
    $result = check_if_exist($sql);
    if($result = 1){
        $query = "SELECT * FROM `productvariant` WHERE `product_id`=$id;";
        $data = get_Table_Data($query);
        $stock_in=0;
        $available_stock=0;
        foreach($data as $da){
        $stock_in=$stock_in+$da['stock_in'];
        $available_stock=$available_stock+$da['available'];
        }
        $total_sales=$stock_in-$available_stock;
        $sales_percent = ($total_sales*100)/$stock_in;
        // echo "<h1>".$stock_in."</h1>";
        // echo "<h1>".$available_stock."</h1>";
        // echo "<h1>".$total_sales."</h1>";
        echo "<h1>".$sales_percent."</h1>";
        $available_percentage=($available_stock*100)/$stock_in;
        $sold_percentage=100-$available_percentage;
        $sold_percentage=number_format($sold_percentage, 2, '.', ',');
        //echo "Sold Percentage is: ".$sold_percentage;
        return $sold_percentage;
        // calculate percentage
    }else{
        echo "product not available, false mapping.";
    }
}

// function to return remaining quantity in percentage
// function to return remaining quantity in percentage

function generate_code()
{
  try {
    $chars = 'ABCDEFGHIJ0123456789KLMNOPQURST9876543210UVWXYZabcdefghij0123456789klmnopqrstuvwxyz9876543210';
    $count = mb_strlen($chars);

    for ($i = 0, $result = ''; $i < 6; $i++) {
      $index = rand(0, $count - 1);
      $result .= mb_substr($chars, $index, 1);
    }
    return $result;
  } catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
  }
}
// echo generate_Code();
// function to send email 
// function to send email 
function sendEmail($to,$sub,$body,$from){
    // echo "sendEmail<br>";
    $to_email = $to;
    $subject = $sub;
    $body = $body;
    // $header = "From: ".$from; //sales psw: (;=T!uH)d]9@
    $headers  = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "BCC: shailesh@alliednepal.com, rachit@alliednepal.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    $mail_sent = mail($to_email, $subject, $body, $headers);
    // echo $mail_sent ? "Mail sent vayo" : "Mail failed";
    // return $mail_sent ? 1 : 0;
    $send_status= $mail_sent ? 1 : 0;
    // echo "send_status".$send_status;
    if($send_status){
        // return 1;
        return email_send_history($from,$to,$sub,$body,$send_status);
    }else{
        if(email_send_history($from,$to,$sub,$body,$send_status)){
        return 0;}
        else{
            return 0;
        }
    }
}
//sendEmail('$to','$sub','$body');
// echo "Hy test ".sendEmail("sangin.globaltech@gmail.com","Test","HY message,<p>This is paragraph.</p><h1>Heading 1 </h1><b>Bold</b><hr><i>This is italic</i>. Testing normal text.",'globalananda21@gmail.com');
// function to send email 
// function to send email 

// function to keep record of sent emails 
// function to keep record of sent emails 
function email_send_history($from,$to,$sub,$body,$send_status){
    // echo "email_send_history <br>";
    $id=get_primary_id('email_send_history_table');
    $body = modify_my_query($body);
    $sql="INSERT INTO `email_send_history_table`(`id`, `from_email`, `to_email`, `email_subject`, `email_body`, `send_status`, `send_date`, `remarks`) VALUES ($id,'$from','$to','$sub','$body',$send_status,now(),'');";//echo "<textarea>".$sql."</textarea><br>"; 
    // $insert_ok = run_insert_query($sql); //echo "INsert stat : ".$insert_ok;
    // echo "insert ok : ".$insert_ok;
    $conn = connectdb();
    $req = mysqli_query($conn,$sql);
    if($req){
        //success
        // echo "query executed";
        $row = mysqli_affected_rows($conn);
        // echo "affected Row : ".$row;
        if($row==1){
            return 1;
        }else{
            // echo mysqli_error($conn);
            return 0;
        }
    }else{
        //failed
        echo mysqli_error($conn);
    }
}
// function to keep record of sent emails 
// function to keep record of sent emails 



// function to send verification code
// function to send verification code
function send_verify_code($useremail){
//write code to send verify code to registerd users
$code = generate_code();
$id = get_primary_id('verify_email_code');
$insert_query = "INSERT INTO `verify_email_code`(`id`, `user_email`, `verify_code`, `remarks`) VALUES ($id,'$useremail','$code','');";// echo $insert_query;
$insert_ok = run_insert_query($insert_query);// echo "INsert stat : ".$insert_ok;
if($insert_ok){
$to = $useremail;
$sub = "Verification Code";
$body = "Dear User,\n Your Verification code = ".$code."\nPlease enter this code to verify your email. Proceed to verify email:https://kantipurfeed.com/verify_email.php?email=".$useremail." \nThank You!.";
$from = "account@delinepal.com";
return sendEmail($to,$sub,$body,$from);}
else{
    return 0;
}
}
// function to send verification code
// function to send verification code

// function to verify registered email
// function to verify registered email
function verify_email($email,$code){
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `verify_email_code` WHERE `user_email`='$email' and `verify_code`='$code' and `code_use`=0),1,0)as result;"; //echo $check_query;
    $result = check_if_exist($check_query); //echo "<br>data exist".$result;
    if($result){
        $update_query = "UPDATE `verify_email_code` SET `code_use`=1,`use_date`=now() WHERE `user_email`='$email' and `verify_code`='$code' and `code_use`=0;"; //echo $update_query;
        if(run_update_query($update_query)){
        $update_query = "UPDATE `users` SET `user_state`='verified', `remarks`='active' WHERE `email`='$email';"; //echo $update_query;
        if(run_update_query($update_query)){
            return 1;
        }else{
            return 0;
        }
        }else{
            return 0;
        }
    }else{
        return 0;
    }
}
// verify_email('anandaaryal54@gmail.com','R5tGd+');
// function to verify registered email
//in verify_email.php
// function to verify registered email

// if(send_verify_code('anandaaryal54@gmail.com'))
// {
//     echo "mail Sent vayo hai";
// }else{
//     echo "mail not sent";
// }
// function to remove useremail on unsuccess of registration
// function to remove useremail on unsuccess of registration
function remove_userEmail($useremail){
    //code to delete user email
}
// function to remove useremail on unsuccess of registration
// function to remove useremail on unsuccess of registration


if(isset($_POST['check_cartOut'])){
    $ref_id=$_POST['check_cartOut'];
    $exist_status=checkcart_exists($ref_id);
    $response ='';
    if($exist_status){
       $response = array(
      'message' => 'data found',
      'status_code' => 200,
      'ref_code'=>$ref_id
        );
    }else{
        $response = array(
      'message' => 'data not found',
      'status_code' => 201
        );
    }
    echo json_encode($response);
}

function checkcart_exists($refID){
$sql = "SELECT IF(EXISTS(SELECT * FROM `invoicerecord` WHERE `refID`='$refID'),1,0)as result;";
$result = check_if_exist($sql);
if($result==1){
    return 1;
}else{
    return 0;
}
}

function changePassword($email,$newPass){
    $newPass=md5($newPass);
    $check_query = "SELECT IF( EXISTS (SELECT * FROM `users` WHERE `email`='$email'),1,0)as result;";
    // echo $check_query;
    // echo check_if_exist($check_query);
    if(check_if_exist($check_query)){
        //Set New passward
        $update_password = "UPDATE `users` SET `pass`='$newPass' WHERE `email`='$email';";
        return run_update_query($update_password);
    }else{
        //retrun false
        return 0;
    }
}
// echo "Psw change state : ".changePassword("anandaaryal54@gmail.com","Ananda@#$98");

function change_admin_Password($email,$oldPass,$newPass){
    $newPass=md5($newPass);
    $md5oldPass=md5($oldPass);
    $check_query = "SELECT IF( EXISTS (SELECT * FROM `admin` WHERE `email`='$email' and `admin_pass`='$oldPass'),1,0)as result;";
    $check_query2 = "SELECT IF( EXISTS (SELECT * FROM `admin` WHERE `email`='$email' and `admin_pass`='$md5oldPass'),1,0)as result;";
    // echo $check_query;
    // echo check_if_exist($check_query);
    $req1=check_if_exist($check_query);
    $req2=check_if_exist($check_query2);
    if($req1 == 1 || $req2 == 1){
        //Set New passward
        $update_password = "UPDATE `admin` SET `admin_pass`='$newPass' WHERE `email`='$email';";
        return run_update_query($update_password);
    }else{
        //retrun false
        return 0;
    }
}

// give me users name 
// give me users name 
function has_userName($email)
{
    $sql = "SELECT `username` from `users` WHERE `email`='$email';";
  $conn = connectdb();
  $req = mysqli_query($conn, $sql);
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
// echo has_userName('sangin@gmail.com');
// give me users name 
// give me users name 

function get_coupon_code($ref_id){
    $check_query = "SELECT IF (EXISTS (SELECT * FROM `invoicerecord` WHERE refID='$ref_id'),1,0)as result";
    $result = check_if_exist($check_query); //echo "result :".$result;
    $coupon_code='';
    if($result == 1){
        $sql="SELECT `coupon_code` FROM `invoicerecord` WHERE `refID`='$ref_id';";
        $data=get_Table_Data($sql);
        foreach($data as $da){
            $coupon_code=$da['coupon_code'];
        }
        // echo "<br>Coupon Code:".$coupon_code;
        return $coupon_code;
    }else{
        return 0;
    }
}
// invoice creater 
// invoice creater 
include 'discountControl.php';
include 'invoiceCreator.php';
// echo print_My_Invoice('ULT-8295-234');
// invoice creater 
// invoice creater 


// $to = 'sangin.globaltech@gmail.com';
// $sub= "Order Confirmation Email";
// $body = print_My_Invoice('ULT-8289-233');
// $body = trim($body);
// echo "<textarea>".$body."</textarea>";
// $from = "sales@ultimanepal.com";
// email_send_history($from,$to,$sub,$body,0);
// $sendMail=sendEmail($to,$sub,$body,$from);
// echo "Send Status : ".$sendMail;
?>