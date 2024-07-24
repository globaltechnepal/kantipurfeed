<?php
// session_start();
// if (isset($_SESSION['email'])) {
//   $email = $_SESSON['email'];
// }
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
  <title>Forget Password</title>
  <link rel="icon" href="assets\images\Favicon\faviconblack.png">
</head>

<body>
  <nav class="navbar navbar-expand-lg" style="background:black">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><img src="assets/images/ultima-logo.png" class="w-100 h-100"></a>
    </div>
    </div>
  </nav>
  <form action="#" method="post">
    <div class="col-12 me-3 h-100" style="background:black;">
      <div class="col-12 text-white text-center fw-bold fs-3">
        <img src="assets\images\Account\undraw_forgot_password_re_hxwm.svg" class="col-2"><br>
        <span>Forget Password</span>
      </div>
      <div class="col-12 text-white text-center">
        <span>Please enter your new password:</span>
      </div>
      <div class="container text-center mt-3">
        <div class="container form-floating w-75">
          <input type="password" class="form-control  ps-4" name="newPassword" placeholder="New Password">
          <label class="ms-4" for="floatingPassword">New Password</label>
        </div>
        <div class="container form-floating  w-75">
          <input type="password" class="form-control col-12 ps-4 mt-3" name="confirmPassword"
            placeholder="Confirm New Password">
          <label class="ms-4" for="floatingPassword">Confirm New Password</label>
        </div>
        <div>
          <button type="submit" class="btn btn-danger mt-4 mb-2" name="changePass">Submit</button>
        </div>
        <div class="text-white mt-3">
          Go back <a href="login.php" class="text-white">Login</a>
        </div>
      </div>
    </div>
  </form>

  <?Php

  include 'assets/library/library.php';
  if (isset($_POST['changePass'])) {
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $newPasswordENC = md5('newPassword');
    $confirmPasswordENC = md5('confirmPassword');
    if ($newPassword == "" || $confirmPassword = "") {
      popMsg('Input filled are empty!! Please fill the form properly.');
    }
    if ($newPasswordENC != $confirmPasswordENC) {
      popMsg('Password doesnot match!! Please fill the form properly.');
    }
    if ($newPasswordENC = $confirmPasswordENC) {
      $myquery = "UPDATE `users` SET `pass`='$newPasswordENC' WHERE `email`='$email';";
      $conn = connectDB();
      $getdata = mysqli_query($conn, $myquery) or die(mysqli_error($conn));
      if (mysqli_num_rows($getdata) == 1) {
        popMsg("Password Change Successfully");
      }
    }
  }
  ?>

  <!-- Footer -->
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
</body>

</html>