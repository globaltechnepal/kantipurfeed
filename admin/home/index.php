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
?>

</main>
</BODY> 

   </HTML>

  <?php include("footer.php"); ?>