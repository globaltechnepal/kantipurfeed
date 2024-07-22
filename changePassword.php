<?php
session_start();
session_destroy();
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

<body>
  <nav class="navbar navbar-expand-lg" style="background:black">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/images/ultima-logo.png" class="w-50"></a>
    </div>
    </div>
  </nav>
  <form action="#" method="post">
    <div class="row row-cols-1 row-cols-md-2 p-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="assets/images/Account/114628-reset-password.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">

          <div class="col-10 text-center mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
              <div class="col-12  text-center p-1"><span class="fs-1 fw-bold">Reset Password</span><br><span>Please enter your new Password :</span></div>
              <div class="container form-floating mb-3 mt-2 w-100"><input type="email" class="form-control ps-4" name="userEmail" id="userEmail"><label class="ms-4" for="floatingInput">Email</label></div>
              <div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" name="olDpass" id="olDpass"><label class="ms-4" for="floatingInput">Old-Password</label></div>
              <div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" name="newPass" id="newPass"><label class="ms-4" for="floatingInput">New Password</label></div>
              <div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" name="confirmnewPass" id="confirmnewPass"><label class="ms-4" for="floatingInput">Confirm New Password</label></div>
              <button type="button" class="btn col-4" style="background:red; color:white" id="ChangePasswordBtn">Submit</button>
                
            </div>
          </div>
        </div>
      </div>
    <!--</div>-->
  </form>
  
  <script>
  $("#ChangePasswordBtn").click(function(){
  var userEmail = $("#userEmail").val();
  var olDpass = $("#olDpass").val();
  var newPass = $("#newPass").val();
  var confirmnewPass = $("#confirmnewPass").val();
  if(userEmail==""||newPass==""||confirmnewPass==""){
      alert("Form field are empty");
  }
  if(newPass!=confirmnewPass){
      alert("Password not match"); 
  }
  else{
      $.ajax({
        url: "assets/library/reset_password.php",
        method: "POST",
        data: {change_admin_password:userEmail,oldPass:olDpass,newPass:newPass},
        success: function (data) { 
            console.log(data);
          var da=JSON.parse(data);
          if(da.status_code==200){
           alert(da.message_2);
           window.location.href="https://ultimanepal.com/adminlogin.php";
          }
          else if(da.status_code!=200){
           alert(da.message);   
          }
        } 
      });
  }
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