<?php
session_start();
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
  <title>Change Password</title>
  <link rel="icon" href="assets\images\Favicon\faviconblack.png">
  <!--jquery cdn-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
   <!--jquery session-->
  <script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
</head>

<body style="overflow-x:hidden;">
  <nav class="navbar navbar-expand-lg" style="background:black">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/images/deli-logo.png" class="w-50"></a>
    </div>
    </div>
  </nav>
  <form action="#" method="post">
      <input type='hidden' id="user_email">
    <div class="row row-cols-1 row-cols-md-2 p-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="assets\images\Account\24950-httpslottiefilescomshareelmjr.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">

          <div class="col-10 text-center mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
           <div class="emailvcode">
            <div class="col-12  text-center p-1">
              <span class="fs-1 fw-bold">Reset Password</span><br>
              <span>Please enter your valid e-mail :</span>
            </div>
            <div class="container form-floating mb-3 mt-2 w-100">
              <input type="email" class="form-control ps-4" name="email" id="email">
              <label class="ms-4" for="floatingInput">E-mail</label>
            </div>
            <div class="container form-floating mb-3 mt-2 w-100" id="verification_code">
            </div>
            <div class="mt-3 container" id="button_change">
              <button type="button" class="btn col-4" name="verify" id="verify"
                style="background:red; color:white" minlength="6" maxlength="6">Verify</button>
            </div>
        </div>
            <div class="container form-floating mb-3 mt-2 w-100" id="changePassword">
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  
  
  <script>
      $(document).ready(function(){
          $("#verify").click(function(){
           var email = $("#email").val();
           if(email==""){
               alert("Fill the form properly");
           }
           else{
           $.ajax({
               url:"assets/library/reset_password.php",
               method:"POST",
               data:{reset_password:email},
               success: function (data) {
                   console.log(data);
                   var da = JSON.parse(data);
                   if(da.status_code ==200){
                     var htm ="";
                     htm +='<input type="text" class="form-control ps-4 mb-2" name="verif_code" id="verif_code">'
                     htm +='<label class="ms-4" for="floatingInput">Verification Code</label>';
                      htm +='<span class="ms-4" for="floatingInput">Verification code send on your email.</span>';
                     $("#verification_code").empty();
                     $("#verification_code").append(htm);
                     htm ='<button type="button" class="btn col-4" style="background:red; color:white" id="verification_code_submit">Verify</button>';
                     $("#button_change").empty();
                    //  $("#verify").remove();
                     $("#button_change").append(htm);  
                   }
                   else if(da.status_code !=200){
                     alert(da.message_2);  
                   }
               }
           });
           }
          });
          
          $(document).on("click","#verification_code_submit",function(){
            var email = $("#email").val();
            $("#user_email").val(email);
            var verif_code = $("#verif_code").val();
            if(email==""||verif_code==""){
                alert("Fill the form properly");
                return false;
            }
            else{
                $.ajax({
                url:"assets/library/verify_email.php",
               method:"POST",
               data:{verify_email:email,verificationCode:verif_code},
               success: function (data) { 
                  console.log(data);
                  var da = JSON.parse(data);
                     var htm ="";
                  if(da.status_code==200){
                     htm +='<div class="col-12  text-center p-1"><span class="fs-1 fw-bold">Reset Password</span><br><span>Please enter your new Password :</span></div>';
                     htm +='<div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" name="newPass" id="newPass"><label class="ms-4" for="floatingInput">New Password</label></div>';
                     htm +='<div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" name="confirmnewPass" id="confirmnewPass"><label class="ms-4" for="floatingInput">Confirm New Password</label></div>';
                     htm +='<button type="button" class="btn col-4" style="background:red; color:white" id="ChangePasswordBtn">Submit</button>';
                     $(".emailvcode").empty();
                     $("#changePassword").append(htm);
                  }
                  else if(da.status_code !=200){
                      alert("Verification code didn't match.");
                      return false;
                  }
               } 
                });
            }
            
          });
          
          
          $(document).on("click","#ChangePasswordBtn",function(){
            var email = $("#user_email").val(); alert(email); 
            var newPass = $("#newPass").val();
            var confirmnewPass =$("#confirmnewPass").val();
            if(email==""||newPass==""||confirmnewPass==""){
                alert("Fill the form properly");
                return false;
            }
            if(newPass!=confirmnewPass){
                alert("Password doesn't match each other");
                return false;
            }
            else{
               $.ajax({
                url:"assets/library/reset_password.php",
               method:"POST",
               data:{change_password:email,newPass:newPass},
               success: function (data) {
                   console.log(data);
                   var da=JSON.parse(data);
                   if(da.status_code==200){
                       window.location.href="https://ultimanepal.com/login.php";
                   }
                   else if(da.status_code!=200){
                     alert(da.message);  
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