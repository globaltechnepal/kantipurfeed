<?php
include 'connect_server.php';
include 'functions_here.php';


// add product varient image
// add product varient image
if (isset($_POST['PCode'])) {
    $pverientID  = $_POST['PCode'];
    $dimg = $_POST['PImage'];
    // $pverientPname = $_POST['pverientPname'];
    // $Flocation = "assets/images/products/" . $pverientPname . "/";
    $id = get_primary_id("productvariant_image");
     $p_img_query = "SELECT `product_varient_id` FROM `productvariant_image` WHERE  product_varient_id = '$pverientID';"; 
     $conn = dbConnecting();
     $result = $conn->query($p_img_query);
     if($result->num_rows > 0){
        return false;
     }else{
    $AddVImageQRY = "INSERT INTO `productvariant_image`(`id`,`product_varient_id`,`img_path`,`img`) VALUES ('$id','$pverientID','','$dimg');";
    if (run_basic_insert_query($AddVImageQRY)) {
        // popMsg("Product verient image added successfully");
        echo json_encode(give_response(200));
    } else {
        // echo "cannot execute :" . $AddVImageQRY;
        echo json_encode(give_response(201));
    }
}
}
// add product varient image
// add product varient image

?>