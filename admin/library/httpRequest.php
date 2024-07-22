<?php
include 'database.php';

if(isset($_POST['disp_images_from_folder'])){
    $path="../".$_POST['disp_images_from_folder'];// $path="../../../assets/images/products/Ultima Micro Data Cable/";
    $images = images_in_folder($path);
    $response = array(
            'message' =>'success',
            'status_code' =>'200',
            'images' => $images);
    echo json_encode($response);
}

if(isset($_POST['del_display_img'])){
    $path = "../".$_POST['del_display_img'];
    $file = $_POST['file'];
    $delete_file = delete_file($path,$file);
    if($delete_file){
        $response = array(
            "message" =>'success',
            "status_code" =>'200'
        );
        echo json_encode($response);
    }
    else{
        $response = array(
            "message" =>'error',
            "status_code" =>'500');
        echo json_encode($response);
    }
}
if(isset($_POST['not_used_color_of'])){
    $id = $_POST['not_used_color_of'];
    $lists = give_unused_colors($id);
    $htm = build_options($lists,'id','color_name');
    $response = array(
            "message" =>'success',
            "status_code" =>'200',
            "htm" => $htm
        );
        echo json_encode($response);
}
?>