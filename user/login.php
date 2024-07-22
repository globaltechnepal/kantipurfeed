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
  <title>Login</title>
  <!--<link rel="icon" href="assets\images\Favicon\faviconblack.png">-->
   <link rel="icon" type="images/ico" href="favicon.ico">
  <!--jquery cdn-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
   <!--jquery session-->
  <script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background:white">
    <div class="container-fluid">
      <a class="navbar-brand" href="http://localhost:8080/kantipurfeed/"><img src="assets/images/deli-logo.png" class="w-50"></a>
    </div>
    </div>
  </nav>
  <form action="#" method="post">
    <div class="row row-cols-1 row-cols-md-2 p-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="assets/images/Account/63787-secure-login.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">

          <div class="col-10 text-center mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
            <div class="col-12 fw-bold text-center p-1">
              <span class="fs-1">Login</span><br>
              <span>Please enter your valid e-mail and password:</span>
            </div>
            <div class="container form-floating mb-3 mt-2 w-100">
              <input type="email" class="form-control ps-4" name="email">
              <label class="ms-4" for="floatingInput">E-mail</label>
            </div>
            <div class="container form-floating w-100">
              <input type="password" class="form-control ps-4" name="password" placeholder="Password">
              <label class="ms-4" for="floatingPassword">Password</label>
            </div>
            <div class="mt-3 container">
              <button type="submit" class="btn col-4" name="req_login"
                style="background:red; color:white">Login</button>
            </div>
            <div class="m-2">
               <span class=""><a class="" href="forget_password.php">Forget Password ?</a></span> 
            </div>
            <div class=" mt-3 pb-3">
              <span class="">New user? <a class="" href="register.php">Create an Account</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <!-- Footer -->
  <?php
  include 'assets/library/library.php';
  if (isset($_POST['req_login'])) {
    $useremail = $_POST['email'];
    $userpassword = trim($_POST['password']);
    $userpassword = md5($userpassword);
    $userpassword = trim($userpassword);

    if ($useremail == "" || $userpassword == "") {
      popMsg("Input filled are empty!! Please fill the form properly.");
    } else {
      $sql = "SELECT IF(EXISTS(SELECT `email`,`pass` FROM `users` WHERE email='$useremail' and `user_state`='verified'),1,0) as result;";
      $result = check_if_exist($sql);
      if ($result == 0) {
        popMsg("Invalid or incorrect information. Please check and try again.");
      } else if ($result == 1) {
        $srv_email = '';
        $srv_pass = '';
        $myquery = "SELECT `email`,`pass` FROM `users` WHERE email='$useremail';";
        // echo $myquery;
        $details = get_Table_Data($myquery);
        foreach ($details as $detail) {
          $srv_email = $detail['email'];
          $srv_pass = trim($detail['pass']);
        }
        if ($useremail == $srv_email) {
        //   echo "<br>inside email";
          if ($userpassword == $srv_pass) {
            // echo "inside pass";
            $_SESSION['session_start_status'] = 'started';
            $_SESSION['email'] = $useremail;
            $_SESSION['login_status'] = 1;
  ?>
  
  <script>
  $.session.set('user','<?php echo $_SESSION['email']; ?>');
//   alert( $.session.get('user'));
      window.location.href = 'home/orderHistry.php';
      </script>
  
  <?php
          } else {
            // echo "password wrong";
            popMsg("Invalid or incorrect information. Please check and try again.");
          }
        } else {
          popMsg("Invalid or incorrect information. Please check and try again.");
        }
      } else {
        popMsg("Invalid or incorrect information. Please check and try again.");
      }
    }
  }
  ?>
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
  
  
 
</body>

</html>