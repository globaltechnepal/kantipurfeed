<?php
include 'library.php';
if (isset($_POST['get_searchInput_data'])) {
    // echo '<div style="color:white">';
    $con = connectdb();
    $searchInput = $_POST['get_searchInput_data'];
    $searchQry = "SELECT `id`,`product_name` FROM `products` WHERE `product_name` LIKE '%$searchInput%';";
    $requ = mysqli_query($con, $searchQry) or die(mysqli_error($con));
    if (mysqli_num_rows($requ) > 0) {
        $list = [];
        $i = 1;
        while ($data = mysqli_fetch_assoc($requ)) {
            $list[$i] = $data;
            $i++;
        }
        $response = array(
            "message" => "success",
            "status_code" => 200,
            "data" => $list
        );

    } else {
        // echo 'no Data found';
        $response = array(
            "message" => "success",
            "status_code" => 200,
            "data" => "Data Not Found"
        );
    }
    echo json_encode($response);
    // echo "</div>";
}
?>