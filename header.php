<?php
// ob_start();
date_default_timezone_set("asia/kathmandu");
if(isset($_SESSION['session_start_status'])){
  if($_SESSION['session_start_status']!='started'){
    session_start(); 
    $_SESSION['session_start_status']='started';
  }
}else{
  session_start(); 
  $_SESSION['session_start_status']='started';
}

echo '<div style="color:white;display:none;">';//display:none;
echo $_SESSION['session_start_status']."<br>";
include 'assets/library/library.php';
include 'assets/library/guid.php';
if(isset($_SESSION['email'])){
  echo '<div class="text-white">'.$_SESSION['email'].'<br></div>';
  if($_SESSION['email']!=''){
    $_SESSION['login_status']=1;
  }else{
    $_SESSION['login_status']=0;
  }
}else{
  $_SESSION['login_status']=0;
}
echo '<div class="text-white" id="loginStatus" data-login_status="'.$_SESSION['login_status'].'">'."login status :".$_SESSION['login_status']."<br></div>";
?>
<!DOCTYPE html>
<html lang="en">
<!--<meta content="width=device-width, initial-scale=1" name="viewport" />-->

<?php
$pagename = basename($_SERVER['PHP_SELF']);
// echo $pagename;
// if (!isset($_SESSION['cart_id'])) {
//   start_new();
//   }

if(!isset($_SESSION['cart_id'])){
  echo "I am in set cart id part";
  start_new();
  $cart_id = $_SESSION['cart_id'];
}

if (isset($_SESSION['cart_id'])) {
    //   echo '<br>This is old guid : '.$_SESSION['guid'];
    echo "i am here. inside cart";
  $cart_id = $_SESSION['cart_id'];
  echo "stored cart_id was : $cart_id <br>";
  if($_SESSION['login_status']==1){
    echo "i am here. inside login status 1";
  $email = $_SESSION['email'];
  $qry="SELECT IF(EXISTS(SELECT c.id as cart_id FROM `users` u
  inner join cart c on u.id = c.user_id
  WHERE email='$email'),1,0) as result;";
  $result = check_if_exist($qry);
  if($result==1){
    $sql_req = "SELECT c.id as cart_id,c.tmp_id as guid FROM `users` u
    inner join cart c on u.id = c.user_id
    WHERE email='$email';";
    $get_cart_id = get_Table_Data($sql_req);
    foreach($get_cart_id as $id){ $cart_id=$_SESSION['cart_id']= $id['cart_id']; $_SESSION['guid']=$id['guid'];}
    echo '<div class="text-white">'.$cart_id.'</div>';
    echo '<br>This is existing guid: '.$_SESSION['guid'];
    echo '<br>This is existing cart id: '.$_SESSION['cart_id'];
  }
}
  else if($_SESSION['login_status']==0){
    echo "i am here. inside login status 0<br>";
    $tmp_id=$_SESSION['guid'];
    $sql = "SELECT IF(EXISTS(SELECT * FROM `cart` WHERE user_id=1 and tmp_id='$tmp_id'),1,0) as result;";
    echo $sql;
    $result = check_if_exist($sql);
    if($result==0){
      echo '<br>This is existing guid : '.$_SESSION['guid'];
      echo '<br>This is existing cart id : '.$_SESSION['cart_id'];
      start_new();
      $cart_id = $_SESSION['cart_id'];
    }
    else if($result==1){
      echo '<br>This is existing guid : '.$_SESSION['guid'];
      echo '<br>This is existing : '.$_SESSION['cart_id'];
    }
    else{
      echo "hehe something went wrong.";
    }
    // start_new();
  }
  echo '<br>This is new guid is : '.$_SESSION['guid'];
  echo "<br>The extracted cart_id is :".$_SESSION['cart_id']." in session";
  echo "Current cart_id is : $cart_id <br>";
//   echo '<div class="text-white" id="cart_id" data-cart_id="' . $cart_id . '">Cart id is : ' . $cart_id . '</div>';//old version
   echo '<div class="text-white" id="cart_id" data-cart_id="' . $cart_id . '"></div>';
}
else{
  echo "I am in else part";
}
// $displaying_product_id = id_according_to_page($pagename);
$displaying_product_id = "";
if(isset($_GET['Product'])){
 $displaying_product_id = $_GET["Product"];
}
$_SESSION['product_id'] = $displaying_product_id;
echo '<div style="display:none;" class="text-white" id="displaying_product_id" data-displaying_product_id="' . $displaying_product_id . '">Product id is : ' . $displaying_product_id . '</div>';
echo "</div>";
// echo '<div class="text-white" id="cart_id" data-cart_id="' . $cart_id . '">Cart id is : ' . $cart_id . '</div>';
?>

<head>
   <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Deli Nepal</title>
  <link rel="icon" type="images/ico" href="http://localhost:8080/favicon.ico">

  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">

  <!-- counter css -->
  <!-- counter css -->
  <link rel="stylesheet"  href="assets/css/counter.css">

  <!--Admin Custom styles for this template-->
  <link href="assets\Dashboard\css\sb-admin-2.min.css" rel="stylesheet">

  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
  <link rel="stylesheet" href="assets/css/product.css">
  <!-- bootstrap icon cdn -->
  <!-- bootstrap icon cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <!-- bootstrap icon cdn -->
  <!-- bootstrap icon cdn -->

  <!-- css files  -->
  <!-- css files  -->
    <link rel="stylesheet" href="assets\css\anandresponsive.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/new_launch.css">
  <link rel="stylesheet" href="assets/css/typewriter.css">
  <link rel="stylesheet" href="assets/css/animations.css">
  <!-- css files  -->
  <!-- css files  -->

  <!-- aos css files link  -->
  <!-- aos css files link  -->
  <link rel="stylesheet" href="assets/css/aos/demo/css/styles.css" />
  <link rel="stylesheet" href="assets/css/aos/dist/aos.css" />
  <!-- aos css files link  -->
  <!-- aos css files link  -->


  <!-- my web font family  -->
  <!-- my web font family  -->
  <link rel="stylesheet" href="assets/css/fontfamily.css">
  <!-- my web font family  -->
  <!-- my web font family  -->


  <!-- Vendor Script -->
  <!-- Vendor Script -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Vendor Script -->
  <!-- Vendor Script -->

  <!-- ajax cdn pull  -->
  <!-- ajax cdn pull  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- ajax cdn pull  -->
  <!-- ajax cdn pull  -->

  <!-- css here -->
  <!-- css here -->
  <style>
    /* @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,800&display=swap'); */

    .bg_color {
      /* background: black; */
    }

    li>a {
      text-decoration: none;
    }

    .blog-heading>a {
      text-decoration: none;
      color: black;
    }

    .border_price {
      border: 1px dashed grey;
    }

    .topbanner {
      background-color: red;
      background-image: linear-gradient(#bb0303, #e36767, #ce0000);
      min-height: .2vh;
      max-height: 10vh;
      text-align: center;
      color: white;
    }

    .bottombanner {
      background-color: red;
      min-height: 0.2vh;
      max-height: 10vh;
      text-align: center;
      color: white;
    }

  </style>
  <!-- css here -->
  <!-- css here -->
  <!-- khalti script here  -->
  <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>
  <!-- khalti script here  -->
</head>

<body class="" style="overfolow:hidden">
  <!-- AOS section -->
  <!-- AOS section -->
  <script src="assets/css/aos/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>
  <!-- AOS section -->
  <!-- AOS section -->

  <!-- discount offer section -->
  <!-- discount offer section -->

  <!-- Navbar section  -->
  <!-- Navbar section  -->
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <a class="navbar-brand" href="http://localhost:8080/kantipurfeed/">
        <img class="logoImg w-50" src="http://localhost:8080/kantipurfeed/assets/images/deli-logo.png">
      </a>
      <button class="navbar-toggler collapseToggle" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" style="text-align: center;padding: 0;font-size: medium;box-shadow:0 0 0 0;">
        <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
            fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
              d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
          </svg></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title fs-2 fw-bold" id="offcanvasExampleLabel">Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2 offcanvas-body">
            <?php
            $query = "SELECT `id`, `category_name`, `category_type`, `category_id`, `path`, `image`, `remarks` FROM `category`";
            $con = connectdb();
            $req = mysqli_query($con, $query) or die(mysqli_error($con));
            if (mysqli_num_rows($req) > 0) {
              while ($data = mysqli_fetch_assoc($req)) {
            ?>
            <div class="col text-center">
                <li style="list-style-type: none;"><a class="dropdown-item" href="category.php?abc=<?php echo $data['category_id'] ?>"><img src="data:image/jpeg;base64,<?php echo $data['image'] ?>"
                      class="w-75"><br><span class="text-dark fs-6 fw-bold"><?php echo $data["category_name"] ?></span>
                      </a></li>
            </div>
             <?php
              }
            }
            ?>
        </div>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-1 col-cols-0 div-display-on-big"></div>
      <div class=" collapse navbar-collapse align-middle text-center" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 pb-3">
          <li class="nav-item dropdown dropdown1">
            <a class="nav-link text-dark fw-bold"  data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
              aria-controls="offcanvasExample">
              Category
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link text-dark fw-bold" href="dailyDeal.php">Daily Deal</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark fw-bold" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="true">
              More
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color:black;">
              <li><a class="dropdown-item" href="deliveryStatus.php">Delivery</a></li>
              <li><a class="dropdown-item" href="<?php if($pagename=='index.php'){echo "#blog_nav";}else{ echo "blog_explore.php";} ?>">Blogs</a></li>
              <!-- <li><a class="dropdown-item" href="#">Corporate Order</a></li> -->
              <li><a class="dropdown-item" href="#aboutULT">About DeliNepal</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold text-dark" href="offerZone.php">Offre Zone</a>
          </li>
        </ul>
        <form class="d-flex">
          <!--<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
          <!--<button class="btn btn-outline-danger" type="submit">Search</button>-->
            <form class="d-block fw-bold">
            <input class="form-control me-2" type="search" id="searchInput" placeholder="Search" aria-label="Search">
            <div class="search_item_display"
              style="position:absolute;z-index:2;width: 15%;border-radius: 10px; color:black; background-color: white;font-size:1rem;margin-top:40px;">
              <!-- <div><a></a></div> -->
              <!-- <hr class="custom_hr"> -->
            </div>
          </form>
          <script>
            $(document).ready(function () {
              $("#searchInput").keyup(function () {
                // $("#searchBtn").click(function () {
                var searchInput = $("#searchInput").val();
                if(searchInput.length > 2 ) {
                // alert(searchInput);
                $.ajax({
                  url: 'assets/library/search_function.php',
                  type: 'POST',
                  data: { get_searchInput_data: searchInput },
                  datatype: 'json',
                  success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    if (da.status_code == 200) {
                      var html = '';
                      if (da.data != "Data Not Found") {
                        jQuery.each(da.data, function (i, val) {
                          console.log(da.data[i].product_name);
                          if(i!=1){
                          html += '<hr class="custom_hr">';
                          }
                          html += '<div><a style="text-decoration:none;color:black;" href="SearchProduct.php?name='+da.data[i].product_name+'">' + da.data[i].product_name + '</a></div>';
                        });
                        $(".search_item_display").empty();
                        $(".search_item_display").append(html);
                      }
                    }
                  },
                });
              }else{
                $(".search_item_display").empty();
              }
              });
            });
            // });
          </script>
          <!--user-->
          <!--user-->
           <?php  
           if($_SESSION['login_status']==1){
               $sql='';
               if(isset($_SESSION['email'])){
                   $abc=$_SESSION['email'];
                   $sql = "SELECT `username`, `email` FROM `users` WHERE `email`='$abc';";
               }
            //   else if(isset($_SESSION['adminemail'])){
            //       $abc=$_SESSION['adminemail'];
            //       $sql = "SELECT `username`, `email` FROM `admin` WHERE `email`='$abc';";
            //   }
            $conn = connectdb();
            $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
                while ($data = mysqli_fetch_assoc($req)) {
            ?>
            <div class="px-1"><a href="assets/User_Dashboard/orderHistry.php"> <span class="fw-bold" style="color:black" id="userAbc">
             <i class="bi bi-person-circle"></i><br><span class="fw-1"><?php echo $data["username"]  ?></span></span></span></a></div>
          <?php
          }
            }
           }
          ?>
             
          <!--user-->
          <!--user-->
        <div class="row top_bar_user_menu" style="padding: 0px;margin: 0px;margin-top: -20px;">
          <?php $adminemail=''; if(isset($_SESSION['adminemail'])){$adminemail=$_SESSION['adminemail'];}
          if($_SESSION['login_status']==0 && $adminemail==''){
            echo '<div class="col pt-2"><a href="user/"><i class="bi bi-person text-dark fs-5 ms-2 me-2"></i></a></div>';
          }
            ?>
          <div class="col pt-2"> <button type="button" style="border:0;background:transparent;padding:0;margin:0;"><a href="http://localhost:8080/kantipurfeed/vendor/"><img src="assets/images/1.png" class="w-100"></a></button></div>
            <?php 
          if($_SESSION['login_status']==0 && $adminemail==''){
            echo '';
          }
          else if($adminemail!==''){
              echo '<div class="col pt-2"><a href="http://localhost:8080/kantipurfeed/admin/home/" class="text-dark fw-bold" style="text-decoration:none;"><i class="bi bi-person-rolodex text-dark fs-5 ms-2 me-2"></i><br>Dashboard</a></div>';
          }
          
            ?>  
          
          <div class="col pt-2"><button type="button" id="lnkCart" <?php if ($pagename == 'cartCheckout.php') { echo "disabled"; } ?> style="border:0;background:transparent;padding:0;margin:0;" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
                class="bi bi-cart-check-fill text-dark fs-5 ms-2 me-2"></i></button></div>
        </div>
        </form>
      </div>
    </div>
    <script>
      $("#giftBtn").click(function () {
        alert("Feature Will be available soon. Thank you for your patience!");
      });
    </script>
  </nav>
  <!-- Navbar section  -->
  <!-- Navbar section  -->

  <!-- add to cart section -->
  <!-- add to cart section -->
  <?php
  include 'addToCart.php';
  ?>
  <!-- add to cart section -->
  <!-- add to cart section -->

  <!-- choose color before add to cart start-->
  <!-- choose color before add to cart start-->
  <?php
  include 'chooseColor.php';
  ?>
  <!-- choose color before add to cart start-->
  <!-- choose color before add to cart start-->