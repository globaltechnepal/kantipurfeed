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

   include("../class/oms_function.php");
   $OMS = new oms_function();
   include("header.php");
   
?>

<HTML>
<HEAD>
<TITLE>Admin Panel</TITLE>
</HEAD>

<BODY>

<main id="main" class="main">

<?php

  		if(isset($_SESSION['success'])){
  			echo "
  				<div class='alert alert-success alert-dismissible fade show' role='alert' ID='alert'>
			  	<p>".$_SESSION['success']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['success']);
  		}

  		if(isset($_SESSION['error'])){
  			echo "
  				<div class='alert alert-danger alert-dismissible fade show' role='alert' ID='alert'>
			  	<p>".$_SESSION['error']."</p> 
  				<button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    				<span aria-hidden='true'>&times;</span>
  				</button>
				</div>
  			";
  			unset($_SESSION['error']);
  		}
  	?>


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
   
   if ($o=='review.form') { include("v/reviewForm.php"); }
   if ($o=='change.carousel') { include("v/changecarousel.php"); }
   if ($o=='faqs.form') { include("v/FAQsForm.php"); }
   
   if ($o=='users') { include("v/users.php"); }
   if ($o=='all.product') { include("v/allproduct.php"); }
   if ($o=='subadmin') { include("v/subAdmin.php"); }
   if ($o=='business') { include("v/business.php"); }
   if ($o=='api.integration') { include("v/api_integration.php"); }
   if ($o=='product.list') { include("v/productList.php"); }
   if ($o=='product.varient.list') { include("v/productVarientList.php"); }
?>

</main>

</BODY> 
</HTML>

  <?php include("footer.php"); ?>