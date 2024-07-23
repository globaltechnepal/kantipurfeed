<?php

//session_start(); 
date_default_timezone_set("Asia/Kathmandu");

// Include the database connection
include("libraries/connect.php");

// Check if the form has been submitted
if (isset($_POST["adminSubmit"])) {
    $EMAIL = isset($_POST['email']) ? $_POST['email'] : null;
    $PASSWORD = isset($_POST['password']) ? $_POST['password'] : null;

    // Check if email and password are provided
    if ($EMAIL && $PASSWORD) {
        $ENCRYPTED_PASSWORD = md5($PASSWORD);
        
        // Prepare the query to check user credentials
        $QRY = "SELECT * FROM admin WHERE email='$EMAIL' AND admin_pass='$ENCRYPTED_PASSWORD' LIMIT 1";
        $rs = mysqli_query($connection, $QRY);
              
        if ($rs) {
            $rows = mysqli_num_rows($rs);

            // If user found, set session and redirect
            if ($rows > 0) {
                $found_user = mysqli_fetch_assoc($rs);
                $_SESSION['adminemail'] = $found_user['email'];

                if (!empty($_SESSION['adminemail'])) {
                    header('Location: home/index.php');
                    exit;
                }
            } else {
                echo "<script>alert('Invalid email or password.');</script>";
            }
        } else {
            echo "<script>alert('Error in query execution.');</script>";
        }
    } else {
        echo "<script>alert('Please fill in both fields.');</script>";
    }
}

// Close the database connection
mysqli_close($connection);
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

<body style="overflow-x: hidden;">
  <nav class="navbar navbar-expand-lg" style="background:white">
    <div class="container-fluid">
      <a class="navbar-brand" href="https://kantipurfeed.com/"><img src="assets/images/deli-logo.png" class="w-50"></a>
    </div>
    </div>
  </nav>
  
<form action="#" method="post" style="background-color: white;">
    <div class="row row-cols-1 row-cols-md-2 p-2">
        <div class="col">
            <div class="col-12 text-center">
                <img src="assets/images/Account/38435-register.gif" class="w-75"><br>
            </div>
        </div>
        <div class="col">
            <div class="col-12">
                <div class="col-10 text-center mt-3 m-auto"
                    style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
                    <div class="col-12 fw-bold text-center p-1">
                        <span class="fs-1">Admin Login</span><br>
                        <span>Welcome back !!</span>
                    </div>
                    <div class="container form-floating mb-3 mt-2 w-100">
                        <input type="email" class="form-control ps-2" name="email" >
                        <label class="ms-4" for="floatingInput">E-mail</label>
                    </div>
                    <div class="container form-floating w-100">
                        <input type="password" class="form-control ps-2" name="password" >
                        <label class="ms-4" for="floatingPassword">Password</label>
                    </div>
                    <div class="mt-3 container">
                        <button type="submit" class="btn col-4" name="adminSubmit"
                            style="background:red; color:white">Login</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

  <!-- bootstrap cdn -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
 
</body>

</html>