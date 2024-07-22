<?php
include 'connect_server.php';
include 'functions_here.php';

// add product varient 
// add product varient 
if (isset($_POST['PCode'])) {
    $pVerientGetID = $_POST['PCode'];
    $stock_in = $_POST['StockQty'];
    $id = get_primary_id("productvariant");
    // echo "Stock in: " . $stock_in ."\n";
    $p_codeQry = "SELECT product_id FROM `productvariant` WHERE product_id = '$pVerientGetID';";
    $conn = dbConnecting();
    $result = $conn->query($p_codeQry);
    if($result->num_rows > 0){
      return false;
    }else{
    // $updateVQRY = "INSERT INTO `productvariant`(`id`,`product_id`,`color_id`,`stock_in`) VALUES ($id,'$pVerientGetID','2','$stock_in') ORDER BY `product_id` ASC;";
    $updateVQRY = "INSERT INTO `productVariant`(`id`, `product_id`, `color_id`, `stock_in`) VALUES ($id,'$pVerientGetID','2','$stock_in');";
    echo "<h1>" . $updateVQRY . "</h1>";
    if (run_basic_insert_query($updateVQRY)) {
        echo json_encode(give_response(200));
        // popMsg("Product verient added successfully");
    } else {
        echo json_encode(give_response(201));
        // echo "cannot execute :" . $updateVQRY;
    }
}
}

?>