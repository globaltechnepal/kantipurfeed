<?php

function connectdb()
{
//   $localhost = 'localhost';
//   $root = 'root';
//   $password = '';
//   $dbname = 'delinepal';
//   $con = mysqli_connect($localhost, $root, $password, $dbname);
  //   server user name 
    $servername = 'localhost';
    $username = 'kantipurfeed_delinepalUser';
    $password = '%pY9Kby9*k6b';
    $dbname = 'kantipurfeed_delinepal';
$con = mysqli_connect($servername, $username, $password, $dbname);
  // ==============================connect database now=======================




  // echo "db connection in progresss";
  if (!$con) {
    echo "unable to connect";
    die();
    //  header("location:preload.php");
  } else {
    //  header("location:../../index.php");
    // echo "Connected";
    return $con;
  }
}
?>