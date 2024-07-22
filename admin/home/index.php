<?php 
   session_start();
   error_reporting(0);
   if ($_SESSION['adminemail'] == 0) {
       header("Location: ../index.php");
   }
   
   $o= (isset($_REQUEST['o']) ? $_REQUEST['o'] : null); 
   if (strlen($o)==0){
        $o = "dashboard";
   }
   

   //include("../class/erp_function.php");
   //$ERP = new erp_function();
   include("header.php");
   
?>

<HTML>
<HEAD>
<TITLE>Admin Panel</TITLE>
</HEAD>

<BODY>

<main id="main" class="main">
<?php 
   if ($o=='dashboard') { include("v/dashboard.php"); }
   if ($o=='change.password') { include("v/changepassword.php"); }
   if ($o=='new.category') { include("v/newCategory.php"); }
   if ($o=='new.launch') { include("v/newLaunch.php"); }
   if ($o=='add.color') { include("v/colorpeaker.php"); }
   if ($o=='order') { include("v/orderReceived.php"); }
   
   if ($o=='checkout') { include("v/checkout.php"); }
   if ($o=='delivered.list') { include("v/delivered.php"); }
   if ($o=='vendor.checkout') { include("v/vendor_checkout.php"); }
   if ($o=='vendor.delivered.list') { include("v/vendor_delivered.php"); }
?>

</main>
</BODY> 

   </HTML>

  <?php include("footer.php"); ?>