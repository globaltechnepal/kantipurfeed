<?php
ob_start();
$failed_msg = "failed";
echo '<div style="width:100%;text-align:center;"><img src="payFail.png" style="box-shadow: 0px 0px 10px;">';
echo '</div>';
// echo "<h1> Payment ".$failed_msg." please Try Again</h1>";
header("refresh:1.5;https://ultimanepal.com/cartCheckout.php");
exit();

?>