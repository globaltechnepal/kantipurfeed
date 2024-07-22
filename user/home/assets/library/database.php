<?php
include "../../../../admin/home/library/functions_here.php";
function dbConnecting()
{
    // $hostname = 'localhost';
    // $username = 'root';
    // $password = '';
    // $database = 'delinepal';
    // $conn = mysqli_connect($hostname, $username, $password, $database);


    //   server user name 
      $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'kantipurfeed';
      $conn = mysqli_connect($servername, $username, $password, $dbname);
    // echo "db connection in progresss";
    if (!$conn) {
        echo "unable to connect database";
        die();
    } else {
        return $conn;
    }
}

if (isset($_POST["newPass"])) {
    $newPass = md5($_POST["newPass"]);
    $userEmail = $_POST["userEmail"];
    $myQry = "UPDATE `users` SET `pass`='$newPass' where email='$userEmail'";
    $conn = dbConnecting();
    $req = mysqli_query($conn, $myQry);
    if ($req == false) {
        echo "cannot execute :" . $myQry;
    } else {
        popMsg("Password change successfully");
    }
}

if(isset($_POST['ult_customer_email'])){
    $eamil = $_POST['ult_customer_email'];
    $sql="SELECT IF (EXISTS(SELECT * FROM users where `email`='sangin@gmail.com'),1,0) as result;";
    $result = check_if_exist($sql);
    if($result==1){
        echo json_encode(give_response(200));
    }
    else if($result==0){
        echo json_encode(give_response(502));
    }
    else{
        echo json_encode(give_response(501));
    }
}
?>