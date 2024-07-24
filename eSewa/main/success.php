<?php
require '../../assets/library/library.php';

    // $conn = connectdb();
    //     if($conn){
    //         echo "connected";
    //     }else{
    //         echo "not connected";
    //     }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>checking...</title>
</head>
<body>

<?php
// $success_msg = "success";
// echo "<h1>".$success_msg."</h1>";

// $oid = $_GET['oid'];
// $amt = $_GET['amt'];
// $refID = $_GET['refId'];

// echo " ".$oid." ".$amt." ".$refID;

function validate(){
    $oid = $_GET['oid'];
    $amt = $_GET['amt'];
    $refID = $_GET['refId'];
   $url = "https://uat.esewa.com.np/epay/transrec";
    $data =[
        'amt'=> $amt,
        'rid'=> $refID,
        'pid'=>$oid,
        'scd'=> 'EPAYTEST'
    ];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    
    if(strpos($response,"Success")){
        // echo "success move along";
        $tblName = 'onlinePaymentRecords';//echo $tblName;
        $check = "SELECT * FROM `onlinePaymentRecords` WHERE `transaction_id`='$refID'";
        // echo $check;
        $result = check_exist($check);
        // echo "I am here".$result;
        if($result==0){
            $id = get_primary_id($tblName);
            $conn = connectdb();
            $sql = "INSERT INTO `onlinePaymentRecords`(`id`, `payBy`, `ref_id`, `amount`, `transaction_id`,`createDate`, `remarks`) VALUES ($id,'esewa','$oid','$amt','$refID',now(),'');";
            $req = mysqli_query($conn, $sql);
            if($req){
                $row = mysqli_affected_rows($conn);
                if($row == 1){
                    // echo "one row effected";
                    $update_value=paySuccessUpdate($_GET['oid']); //echo "update status code: ".$update_value;
                    if($update_value){
                        $link ='https://ultimanepal.com/cartOut.php?refID='.$_GET['oid']; echo "<br>".$link;
                    header("location:".$link);
                    }
                    else{
                        echo "something wrong with the process";
                    }
                }else if($row > 1){
                    echo "multiple row affected";
                }
            }else{
                $err = mysqli_errore($conn);
                echo "cannot run query".$err;
            }
        }else if($result==1){
            echo "record already exist";
        }else{
            echo "cannot know if transaction code is duplicate or not.";
        }
        
    }
    else if(strpos($response,"failure")){
        echo "failure move along";
    }else{
        echo "Not Working please retry.";
    }
    curl_close($curl);
    // echo "The Response is :".$response;
    }
    validate();


function paySuccessUpdate($refID){
    // echo "I am inn...";
    $check_query="SELECT * FROM `delivery_payment_details` WHERE `reference_no`='$refID'"; //echo "<br>".$check_query;
    $result = check_exist($check_query); //echo "<br>".$result;
    if($result){
        //now update tablE
        $update_query = "UPDATE `delivery_payment_details` SET `payment_mode`='esewa',`payment_status`='PAID' WHERE `reference_no`='$refID';";
        // echo $update_query;
        $row = run_update_query($update_query);
        if($row){
            return 1;
        }else{
            return 0;
        }
    }else{
        // donot update table
        return 0;
    }
}
// echo "Payment Update status : ".paySuccessUpdate($_GET['oid']);
?>

    <!-- script section  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
    })
</script>
<body>
</body>
</html>