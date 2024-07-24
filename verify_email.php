<?php
ob_start();
session_start();
?>
<?php 
include 'assets/library/library.php';
  include 'assets/library/guid.php';
if (!isset($_SESSION['cart_id'])) {
  start_new();
}
if (isset($_SESSION['cart_id'])) {
  $cart_id = $_SESSION['cart_id'];
  $qry = "SELECT IF(EXISTS(SELECT * FROM `cart` WHERE user_id=1 and id=$cart_id),1,0) as result;";
  // echo $qry;
  $result = check_if_exist($qry);
  if($result==0){
      start_new();
  }
  else if($result==1){
    $qry = "SELECT tmp_id FROM cart WHERE id=$cart_id";
    $_guid=get_Table_Data($qry);
    foreach($_guid as $guid){ $_SESSION['guid']=$guid['tmp_id']; }
    // echo "<br>My Guid extracted is :".$_SESSION['guid'];
  }
  $cart_id = $_SESSION['cart_id'];
//   echo '<div id="cart_id" data-cart_id="' . $cart_id . '">Cart id is : ' . $cart_id . '</div>';
}
$users_cart_id = $_SESSION['cart_id'];
$user_email_verification = $_GET['email'];
// echo $user_email_verification;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- bootstrap icon cdn -->
  <!-- bootstrap icon cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <!-- bootstrap icon cdn -->
  <!-- bootstrap icon cdn -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" ></script>
  <title>Verify Email</title>
  <link rel="icon" href="favicon.ico">
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background:white;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/images/deli-logo.png" class="w-50"></a>
    </div>
    </div>
  </nav>
  <form action="#" method="post">
    <div class="row row-cols-1 row-cols-md-2 p-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="assets/images/Account/58201-success-tick.gif" class="w-50"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">
          <div class="col-10 row-cols-1 text-center mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
            <div class="col-12 fw-bold text-center p-1 mb-4">
              <span class="fs-1">Verification</span><br>
              <span>Please fill in the fields below:</span>
            </div>
            <!--<div class="row input-group ms-2 mb-3">-->
            <!--  <span class="col input-group-text fw-bold" id="basic-addon1">E-mail : &nbsp;-->
            <!--  <input type="text" class="form-control w-100"></span>-->
            <!--</div>-->
            <input type="hidden" class="form-control w-100" id="userEmail" value="<?php echo $user_email_verification ?>">
            <div class="row input-group ms-2 mb-3">
              <span class="col input-group-text fw-bold" id="basic-addon1">Verification Code : &nbsp;
              <input type="text" class="form-control w-100" id="verificationCode"></span>
            </div>
            <div class="mt-3"><button type="button" id="submitVerification" class="btn col-5"
                style="background:red; color:white;">Submit</button></div>
          </div>
        </div>
      </div>
    </div>
  </form>
  
 <script>
     $(document).ready(function(){
         $("#submitVerification").click(function(){
           var userEmail = $("#userEmail").val().trim();
           var verificationCode = $("#verificationCode").val().trim();
           if(verificationCode==""||userEmail==""){
               alert("Form Field are empty");
           }
           else{
               $.ajax({
                    url: "assets/library/verify_email.php",
                    method: "POST",
                    data: {verify_email:userEmail,verificationCode:verificationCode},
                    success: function (data) {
                        console.log(data);
                        var da = JSON.parse(data);
                        if(da.status_code ==200){
                         window.location.href="login.php";
                        }
                        else{
                            alert("Verification code doesn't match. Please enter carefully");
                            // return false;
                            // window.location.href="https://ultimanepal.com/register.php";
                        }
                    }
               });
           }
           
         });
     });
 </script>

  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->

  <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
</body>

</html>