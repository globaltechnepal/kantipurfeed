<?php 
include "assets/library/database.php";
date_default_timezone_set("asia/kathmandu");
session_start(); 
if (isset($_SESSION['vendor_email'])) {
} else if ($_SESSION['vendor_email'] == ''||$_SESSION['vendor_email'] !== $_SESSION['vendor_email']) {
    unset($_SESSION["vendor_email"]);
    echo '<script>window.location.href = "http://localhost:8080/delinepal/vendor_login/";</script>';
}else{
    echo "<hr><h1>No thing yr</h1><hr><hr>";
}


    $discountPercent="";
    $select_discount_percent = "SELECT `discountPercent` FROM `vendor_users` WHERE `vendor_email` ='".$_SESSION["vendor_email"]."';";
    $datas = get_Table_Data($select_discount_percent);
    foreach($datas as $data){
     $discountPercent =$data['discountPercent'];   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Deli Nepal</title>
 <link rel="icon" type="images/ico" href="favicon.ico">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- datatable -->
    <!-- datatable -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.css" />
    <!-- datatable -->
    <!-- datatable -->

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets\css\style.css">
    <link rel="stylesheet" href="assets\css\responsive.css">

    <!-- jquery script -->
    <!-- jquery script -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
    <!-- jquery script -->
    <!-- jquery script -->

    <!-- bootstrap cdn -->
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- bootstrap cdn -->
    <!-- bootstrap cdn -->

    <!--jquery cdn-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</head>
 <script>
 </script>
 


<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #222944; color:white;">

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link">
                    <i class="bi bi-person-circle"></i>
                    <?php  
           if($_SESSION['login_status']==1){
               $sql='';
               if(isset($_SESSION['vendor_email'])){
                   $user=$_SESSION['vendor_email'];
                   $sql = "SELECT  `vendor_company_name` FROM `vendor_users` WHERE `vendor_email` = '$user';";
               }
                $conn = dbConnecting();
                $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if (mysqli_num_rows($req) > 0) {
                    while ($data = mysqli_fetch_assoc($req)) {
                ?>
                    <span  type="<?php  echo $data["vendor_company_name"] ?>" title="<?php  echo $data["vendor_company_name"] ?>" class="text-white"><?php  echo $data["vendor_company_name"] ?></span>
                        <?php
                    }
                }
               }
                ?>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Shop
            </div>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
              <li class="nav-item">
                 <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages1">
                    <i class="bi bi-files-alt"></i>
                    <span>Vendor</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Vendor</h6>
                        <a class="collapse-item" href="create_list.php">Create List</a>
                        <a class="collapse-item" href="shop.php">Shop</a>
                        <a class="collapse-item" href="upload_file.php">Upload File</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                User History
            </div>
           <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="purchase_history.php">
                    <i class="bi bi-bag-check-fill"></i>
                    <span>Purchase History</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="order_history.php">
                    <i class="bi bi-list-ol"></i>
                    <span>Order Place</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="change_password.php">
                    <i class="bi bi-bag-check-fill"></i>
                    <span>Change Passwod</span></a>
            </li>

            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">
                    <i class="bi bi-box-arrow-left"></i>
                    <span>Logout</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">