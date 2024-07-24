<?php
include 'connect_server.php';
include 'functions_here.php';

// add product varient 
// add product varient 
if (isset($_POST['PCode'])) {
    $pVerientGetID = $_POST['PCode'];
    $stock_in = $_POST['StockQty'];
    $id = get_primary_id("productvariant");
    echo "Stock in: " . $stock_in ."\n";
    $p_codeQry = "SELECT product_id FROM `productvariant` WHERE product_id = '$pVerientGetID';";
    $conn = dbConnecting();
    $result = $conn->query($p_codeQry);
    if($result->num_rows > 0){
      return false;
    }else{
    // $updateVQRY = "INSERT INTO `productvariant`(`id`,`product_id`,`color_id`,`stock_in`) VALUES ($id,'$pVerientGetID','2','$stock_in') ORDER BY `product_id` ASC;";
    $updateVQRY = "INSERT INTO `productvariant`(`id`, `product_id`, `color_id`, `stock_in`) VALUES ($id,'$pVerientGetID','2','$stock_in');";
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


// add product varient list 
// add product varient list
// if (isset($_POST['PCode'])) {
//     // Step 1: Check input data
//     $pVerientGetID = $_POST['PCode'];
//     $stock_in = $_POST['StockQty'];
    
//     // Debug: Output to verify input data
//     echo "Hello PCode: " . $pVerientGetID . "<br>";
//     echo "Hello StockQty: " . $stock_in . "<br>";
    
//     // Step 2: Establish database connection
//     $conn = dbConnecting();
    
//     // Debug: Output to verify database connection
//     if (!$conn) {
//         echo "Database connection failed<br>";
//         exit; // Exit script if connection fails
//     }
    
//     // Step 3: Execute SQL query to check if product variant already exists
//     $p_codeQry = "SELECT product_id FROM `productvariant` WHERE product_id = '$pVerientGetID';";
//     $result = $conn->query($p_codeQry);
    
//     // Debug: Output to verify SQL query result
//     if ($result === false) {
//         echo "SQL query failed: " . $conn->error . "<br>";
//         exit; // Exit script if query fails
//     }
    
//     // Debug: Output to verify query result
//     echo '<script>alert("' . htmlspecialchars($result) . '");</script>';
    
//     // Step 4: Check if product variant already exists
//     if ($result->num_rows > 0) {
//         // Debug: Output to verify if product variant exists
//         echo "Product variant already exists<br>";
//         return false;
//     } else {
//         // Step 5: Insert new product variant
//         $id = get_primary_id("productvariant");
//         $updateVQRY = "INSERT INTO `productvariant`(`id`, `product_id`, `color_id`, `stock_in`) VALUES ($id,'$pVerientGetID','2','$stock_in');";
        
//         // Debug: Output to verify INSERT query
//         echo "INSERT query: " . $updateVQRY . "<br>";
        
//         if (run_basic_insert_query($updateVQRY)) {
//             // Debug: Output success message
//             echo json_encode(give_response(200));
//             // popMsg("Product verient added successfully");
//         } else {
//             // Debug: Output error message
//             echo json_encode(give_response(201));
//             // echo "cannot execute :" . $updateVQRY;
//         }
//     }
// }
// add product varient list 
// add product varient list 
?>