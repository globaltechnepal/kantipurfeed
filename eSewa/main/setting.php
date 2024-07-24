<?php
// important veriables set 
$form_submit_url='https://uat.esewa.com.np/epay/main';
$success_url='http://merchant.com.np/page/esewa_payment_success?q=su';
$failed_url='http://merchant.com.np/page/esewa_payment_failed?q=fu';
$i=0;



session_start();
if(isset($_SESSION['counter'])){
    $_SESSION['counter']=$_SESSION['counter'];
}else{
$_SESSION['counter']=0;
}
$counting = give_pid($_SESSION['counter']);
function give_pid($i){
    $i++;
    $_SESSION['counter']=$i;
    return $i;
}
?>