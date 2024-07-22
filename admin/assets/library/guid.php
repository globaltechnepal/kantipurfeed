<?php
// if(!session_start()){
//     session_start();
// }
function start_new(){
    // if (!isset($_SESSION['guid'])) {
    $_SESSION['guid'] = getGUID();
    $guid = $_SESSION['guid'];
    // echo $guid;//to display 
    setCart($guid);
    set_cart_id($guid);
// }
// else if (isset($_SESSION['guid'])) {
//     $qry = "";
//     $guid = $_SESSION['guid'];
//     // $_SESSION['guid']= session_destroy();
//     // echo $guid;//to display
//     set_cart_id($guid);
// }
}

function getGUID()
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    }
    else {
        mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = chr(123) // "{"
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12)
            . chr(125); // "}"
        return $uuid;
    }
}

function setCart($guid)
{
    $conn = connectdbonce();
    $temp_user_id = 1;
    $query = "INSERT INTO `cart`(`tmp_id`, `user_id`, `remarks`) VALUES ('$guid',$temp_user_id,'');"; 
    $req = mysqli_query($conn, $query);
    if ($req === false) {
        echo "cannot Execute Request";
        mysqli_close($conn);
    }
    elseif ($req === true) {
        // echo "Submmit Successful.";
        mysqli_close($conn);
    }
}
function popMsgOnce($msg)
{
?>
<script>
    alert("Please : <?php echo $msg; ?>");
</script>
<?php
}

function set_cart_id($guid)
{
    $query = "SELECT id from cart where tmp_id='$guid';";
    // echo "<br>".$query;
    $conn = connectdbonce();
    $req = mysqli_query($conn, $query);
    if (!$req) {
        popMsgOnce("cannot find data !!!");
        mysqli_close($conn);
    }
    else if ($req) {
        while ($data = mysqli_fetch_assoc($req)) {
            // echo "<br>The extracted cart_id is :".$data['id']." in result";
            $_SESSION['cart_id'] = $data['id'];
            // echo "<br>The extracted cart_id is :".$_SESSION['cart_id']." in session";
            // echo "<BR> <H1>".$_SESSION['cart_id']."</H1>";//to display
            mysqli_close($conn);
        }
    }
    else {
        popMsg("Something is wrong , Please check for errors");
        mysqli_close($conn);
    }
}

function set_user_id($user_id,$guid){
    $conn = connectdbonce();
    $user_id = $user_id;
    $cart_id = $_SESSION['cart_id'];
    $query = "UPDATE `cart` SET `user_id`='$user_id',`remarks`=now() WHERE tmp_id='$guid' and id=$cart_id;";
    $req = mysqli_query($conn, $query);
    if ($req === false) {
        echo "cannot Execute Request";
        mysqli_close($conn);
    }
    elseif ($req === true) {
        $row_affected=mysqli_affected_rows($conn);
        if($row_affected == 1){
           return 1;
        }
        else if($row_affected> 1){
            return 2;
        }
        else{
            return 0;
        }
        // echo "Submmit Successful.";
        mysqli_close($conn);
    }
}

function connectdbonce()
{
    // $localhost = 'localhost';
    // $root = 'root';
    // $password = '';
    // $dbname = 'delinepal';

    // server user name 
    $localhost = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'kantipurfeed';

    // ==============================connect database now=======================


    $con = mysqli_connect($localhost, $username, $password, $dbname);
    
    
    // -----------------for only server----------------------------
    //   server user name 
//    $servername = 'localhost';
//    $username = 'ultima_client';
//    $password = 'Ultima@2022';
//    $dbname = 'ultima_ultima';
//     $con = mysqli_connect($servername, $username, $password, $dbname);
    // -----------------for only server----------------------------
    // echo "db connection in progresss";
    if (!$con) {
        echo "unable to connect database";
        die();
    //  header("location:preload.php");
    }
    else {
        //  header("location:../../index.php");
        // echo "Connected";
        return $con;
    }
}
function set_new_sessionid_and_cart_id($user_id){
    $_SESSION['guid'] = getGUID();
    $guid = $_SESSION['guid'];
    setCart($guid);
    set_cart_id($guid);
    $status = set_user_id($user_id,$guid);
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
    if($status==1){
        echo json_encode($success);
        return 1;
    }
    else if($status==2)
    {
        echo json_encode($errore);
        return 0;
    }
    else{
        echo json_encode($failure);
        return 0;
    }
}

// if hit by ajax server request 
if(isset($_POST['get_new_cart_id'])){
    $user_id=$_POST['get_new_cart_id'];
    $_SESSION['guid'] = getGUID();
    $guid = $_SESSION['guid'];
    // echo $guid;//to display 
    setCart($guid);
    set_cart_id($guid);
    $status = set_user_id($user_id,$guid);
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
    if($status==1){
        echo json_encode($success);
    }
    else if($status==2)
    {
        echo json_encode($errore);
    }
    else{
        echo json_encode($failure);
    }
}
?>