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
  <title>Register</title>
  <!--<link rel="icon" href="assets/images/Favicon/faviconblack.png">/-->
   <link rel="icon" type="images/ico" href="favicon.ico">
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background:white">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/images/deli-logo.png" class="w-50"></a>
    </div>
    </div>
  </nav>
  <form action="#" method="post">
    <div class="row row-cols-1 row-cols-md-2 p-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="assets/images/Account/112454-form-registration.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">
          <div class="col-10 row-cols-1 text-center mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
            <div class="col-12 fw-bold text-center p-1">
              <span class="fs-1">Register</span><br>
              <span>Please fill in the fields below:</span>
            </div>
            <div class=" container form-floating mb-3 w-100">
              <input type="text" class="form-control ps-4" placeholder="First Name" name="fname" minlength="2">
              <label class="ms-4" for="floatingUsername">Username</label>
            </div>
            <div class=" container form-floating mb-3 w-100">
              <input type="phone" class="form-control ps-4" placeholder="phone" name="phone" minlength="10"
                maxlength="10" onkeypress="return event.charCode>=48 && event.charCode<=57" ondrop="return false"
                pattern="[9]{1}[6-8]{1}[0-2,4-8]{1}[0-9]{7}">
              <label class="ms-4" for="floatingInput">Phone</label>
            </div>
            <div class=" container form-floating mb-3 w-100">
              <input type="email" class="form-control ps-4" placeholder="name@example.com" name="email"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,3}$">
              <label class="ms-4" for="floatingInput">E-mail</label>
            </div>
            <div class="container form-floating w-100">
              <input type="password" class="form-control ps-4" placeholder="Password" name="password"
                pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" minlength="8">
              <!-- <i class="bi bi-eye-slash fs-3"  id="togglePassword" style="position: relative; bottom: 50px; left: 229px;"></i> -->
              <label class="ms-4" for="floatingPassword">Password</label>
            </div>
            <div class="mt-3"><button type="submit" name="req_submit" class="btn col-5"
                style="background:red; color:white;">Save</button></div>
            <div class="text-center mt-3 pb-3">
              <span>Already have an account? <a href="login.php">Login</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- 
<script>
  const togglePassword = document.querySelector("#togglePassword");
  const password = document.querySelector("#password");

  togglePassword.addEventListener("click", function () {
      // toggle the type attribute
      const type = password.getAttribute("type") === "password" ? "text" : "password";
      password.setAttribute("type", type);
      
      // toggle the icon
      this.classList.toggle("bi-eye");
  });
</script> -->

  <?php

  if (isset($_POST['req_submit'])) {
    $userfname = $_POST['fname'];
    $userphone = $_POST['phone'];
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];
    $encrypted_pwd = md5($userpassword); // to encrypt the password
  
    if ($userfname == "" || $userphone == "" || $useremail == "" || $encrypted_pwd == "") {
  ?>
  <script>
    alert("Input filled are empty!! Please fill the form properly.")
  </script>
  <?php
    } else {
      $myquery = "SELECT `email`,`phone` FROM `users` WHERE email='$useremail' or phone = '$userphone';";
      $conn = connectDB();
      $getdata = mysqli_query($conn, $myquery) or die(mysqli_error($conn));
      if (mysqli_num_rows($getdata) > 0) {
        popMsg("Either Email or Phone already exists.Please try with diffrent email and phone. Thank you!!");

      } else {
        // popMsg("i am in");
        $id = get_primary_id("users");
        $query = "INSERT INTO `users`( `id`,`username`, `phone`, `email`, `pass`) VALUES ($id,'$userfname','$userphone','$useremail','$encrypted_pwd ');";
        $conn = connectDB();
        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
        // echo $query;
        if ($req) {
          $check_cart = "SELECT IF( EXISTS(SELECT * from cart where user_id=1 and id=$users_cart_id), 1, 0) as result;";
          $result = check_if_exist($check_cart);
          echo "<br>".$check_cart;
          echo "<br>Result : ".$result;
          if($result==1){
            //assign the current cart id to the currently registering user
            $asign_cart_to_user = "UPDATE `cart` SET `user_id`='$id',`remarks`=now() WHERE id='$users_cart_id';";
          echo "<br> Assigned cart id to user ".$asign_cart_to_user;
          if (mysqli_query($conn, $asign_cart_to_user)){
              $send_code = send_verify_code($useremail);
              if($send_code){
                popMsg("Register Success. Please proceed verify your email.");
                ?>
                <script>window.location.href = 'verify_email.php?email=<?php echo $useremail; ?>';</script>
                <?php
                // header('location:login.php');
                }
                else{
                    // remove_userEmail($useremail);
                popMsg("Register Failed. Please try again.");
                ?>  
              }
              
            <script>window.location.href = 'register.php';</script>
            <?php
              // header('location:register.php');
            }
          }
            else{
            popMsg("Register Failed. Please try again.");
            ?>
            <script>window.location.href = 'register.php';</script>
            <?php
              // header('location:register.php');
            }
          }
          else if($result==0){
            //distroy old session and create new session and cart id for the currently regisetring user
            $resultis = set_new_sessionid_and_cart_id($id);
            if($resultis == 1){
              popMsg("Register Success. please proceed to login.");
              // header('location:login.php');
              ?>
              <script>window.location.href = 'login.php';</script>
              <?php
            }
            else{
            popMsg("Register Failed. Please try again.");
              ?>
            <script>window.location.href = 'register.php';</script>
            <?php
            // header('location:register.php');
            }
          }
          else{
            //something must be done
            echo "Something went wrong, please retry Thank you!";
              header('location:nopage.php');
          }
  ?>
  <!-- <script>window.location.href = 'login.php';</script> -->
  <?php
        }
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