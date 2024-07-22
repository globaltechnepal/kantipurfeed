<?php
function dbConnecting()
{
    $hostname = 'localhost';
    $username = 'kantipurfeed_delinepalUser';
    $password = '%pY9Kby9*k6b';
    $database = 'kantipurfeed_delinepal';
    $conn = mysqli_connect($hostname, $username, $password, $database);


    //   server user name 
    //   $servername = 'localhost';
    //   $username = 'ultima_client';
    //   $password = 'Ultima@2022';
    //   $dbname = 'ultima_ultima';

    // echo "db connection in progresss";
    if (!$conn) {
        echo "unable to connect database";
        die();
    //  header("location:preload.php");
    }
    else {
        //  header("location:../../index.php");
        // echo "Connected";
        return $conn;
    }
}
if (isset($_POST["category_name"])) {
    $cat_name = $_POST['category_name'];
    /*  $catid = $_POST['catid']; */
    $cat_type = $_POST['category_type'];
    $cate_id = $_POST['category_id'];
    if ($cat_name == "" || /* $catid == "" || */$cat_type == "" || $cate_id == "") {
        return false;
    }
    else {
        $query = "INSERT INTO `category`(`category_name`, `category_type`, `category_id`) VALUES('$cat_name','$cat_type','$cate_id');";
        $conn = dbConnecting();
        echo $query;
        $res = mysqli_query($conn, $query);
        if ($res == false) {
            echo "cannot execute : " . $query;
        }
        else {
            popMsg("New Category Added successfully");
        }
    }
}
?>