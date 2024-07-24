<?php
include 'connect_server.php';
include 'functions_here.php';

// echo "delete Control.<br>";
// delete_from('category',7);
function delete_from($tblName, $id)
{
    $check_exist = "SELECT IF (EXISTS(SELECT * FROM `$tblName` WHERE id=$id),1,0) as result;";
    // echo $check_exist."<br>";
    $result = check_if_exist($check_exist);
    // echo "Result : ".$result."<br>";
    if ($result == 0) {
        return give_response(404);
    } else if ($result == 1) {
        $sql = "DELETE FROM `$tblName` WHERE id=$id;";
        // echo $sql;
        $conn = dbConnecting();
        try {
            $del_req = mysqli_query($conn, $sql);
            if ($del_req) {
                $row = mysqli_affected_rows($conn);
                if ($row == 1) {
                    history_table($sql, true);
                    return give_response(200);
                } else if ($row == 0) {
                    history_table($sql, false);
                    return give_response(404);
                } else {
                    history_table($sql, false);
                    return give_response(201);
                }
            }
            else{
            $e = mysqli_error($conn);
            history_table($sql, false);
            $response_code = check_ecxeptions($e);
            // echo $e;
            return give_response($response_code);
            }
        } catch (Exception $e) {
            history_table($sql, false);
            $response_code = check_ecxeptions($e);
            echo $e;
            return give_response($response_code);
        }
    }
}

function check_from_order_and_checkout($id)
{
    $qry = "SELECT IF (EXISTS(SELECT * FROM `checkouts` WHERE `product_v_id`=$id),1,0) as result;";
    $qry2 = "SELECT IF (EXISTS(SELECT * FROM `orders` WHERE `product_variant_id`=$id),1,0) as result;";
    $req = check_if_exist($qry);
    $req1 = check_if_exist($qry2);
    if ($req == 1 || $req1 == 1) {
        return 0;
    } else if ($req == 0 || $req1 == 0) {
        return 1;
    }
}

function delete_from_sub_tbl($tblName, $colName, $id)
{
    $check_exist = "SELECT IF (EXISTS(SELECT * FROM `$tblName` WHERE `$colName`=$id),1,0) as result;";
    // echo $check_exist . "<br>";
    $result = check_if_exist($check_exist);
    $result2 = check_from_order_and_checkout($id);
    // echo "Result : ".$result."<br>";
    $data = get_has_attachment($tblName, $id);
    if ($result == 1 && $result2 == 1) {
        $sql = "DELETE FROM `$tblName` WHERE $colName=$id;";
        // echo $sql;
        $conn = dbConnecting();
        try {
            $del_req = mysqli_query($conn, $sql);
            $row = mysqli_affected_rows($conn);
            if ($row == 1) {
                if (delete_productVarient_attachments($data)) {
                    history_table($sql, true);
                    return 1;
                } else {
                    history_table($sql, false);
                    return 404;
                }
            } else if ($row == 0) {
                history_table($sql, false);
                return 404;
            } else {
                history_table($sql, false);
                return 0;
            }
        } catch (Exception $e) {
            history_table($sql, false);
            $response_code = check_ecxeptions($e);
            return give_response($response_code);
            // echo $e;
        }

    }else if ($result == 0){
        return 1;
    } 
    else if ($result2 == 0) {
        $sql = "DELETE FROM `$tblName` WHERE $colName=$id;";
        history_table($sql, false);
        return 1451;
    } else {
        $sql = "DELETE FROM `$tblName` WHERE $colName=$id;";
        history_table($sql, false);
        return 404;
    }
}

function delete_products_attachments($data)
{
    if ($data == 0) {
        return 1;
    }
    foreach ($data as $da) {
        $path = "../../../" . $da['path'];
        if (delete_file($path, $da['img1']) == 0) {
            echo "cannot delete image 1";
            return 0;
        }
        if (delete_file($path, $da['img2']) == 0) {
            echo "cannot delete image 2";
            return 0;
        } else {
            return 1;
        }
    }
} //deletes the attachments of products
function delete_productVarient_attachments($data)
{
    if ($data == 0) {
        return 1;
    }
    foreach ($data as $da) {
        $path = "../../../" . $da['path'];
        if (delete_file($path, $da['img']) == 0) {
            echo "cannot delete image " . $da['img'];
            return 0;
        }
        if (remove_all_from_dir($path . $da['color_name']) == 0) {
            echo "cannot delete files from " . $da['color_name'];
            return 0;
        } else {
            return 1;
        }
    }
} //deletes the attachments of product varient

function delete_banner_attachments($data){
    if ($data == 0) {
        return 1;
    }
    foreach ($data as $da) {
        $path = "../../../" . $da['path'];
        if (delete_file($path, $da['img']) == 0) {
            echo "cannot delete image " . $da['img'];
            return 0;
        }
        else {
            return 1;
        }
    }
} //deletes the attachments of banner/carousal

function get_has_attachment($tblName, $id)
{
    switch ($tblName) {
        case 'products':
            $sql = "SELECT `id`,`img_path` as path, `primary_image` as img1, `secondary_image` as img2 FROM `products` WHERE id=$id;";
            // echo $sql;
            $data = get_Table_Data($sql);
            if ($data != 0) {
                return $data;
            } else {
                return 0;
            }
            break;
        case 'productVariant_image':
            $sql = "SELECT pv_img.img_path as path,pv_img.img as img,clr.color_name FROM `productVariant_image` pv_img 
            inner join `productVariant` pv on pv_img.product_varient_id=pv.id
            inner join `colors` clr on pv.color_id=clr.id
            WHERE pv.id=$id;";
            // echo $sql;
            $data = get_Table_Data($sql);
            if ($data != 0) {
                return $data;
            } else {
                return 0;
            }
            break;
        case 'carousel':
            $sql = "SELECT `img_path` as path, `img` as img FROM `carousel` WHERE id=$id";
            $data = get_Table_Data($sql);
            if ($data != 0) {
                return $data;
            } else {
                return 0;
            }
        default:
            # code...
            break;
    }
} //returns the name of files and folders (attachments) to be deleted of tables
// get_folder_name_by_product_id('products', '1');
function get_folder_name_by_product_id($tblName, $id){
    $check_exist = "SELECT IF (EXISTS(SELECT * FROM `$tblName` WHERE id=$id),1,0) as result;";
    $result = check_if_exist($check_exist);
    if ($result == 1) {
        $sql = "SELECT product_name from `$tblName` WHERE id=$id;";
        $data = get_Table_Data($sql);
        $name='';
        foreach($data as $da){
            $name=$da['product_name'];
        }
        return $name;}
        else{
        return 0;
        }
}//gives the name of the folder so I can delete the folder form server
// get_folder_name_by_product_id('products', '1');
function get_folder_name_by_product_v_id($id){
    $check_exist = "SELECT IF (EXISTS(SELECT pvImg.img_path as path, lower(clr.color_name) as clrName FROM `productVariant_image` pvImg
        INNER JOIN productVariant pv on pvImg.product_varient_id=pv.id
        INNER JOIN colors clr on pv.color_id=clr.id
        WHERE pv.id=$id),1,0) as result;";
    $result = check_if_exist($check_exist);
    if ($result == 1) {
        $sql = "SELECT pvImg.img_path as path, lower(clr.color_name) as clrName FROM `productVariant_image` pvImg
        INNER JOIN productVariant pv on pvImg.product_varient_id=pv.id
        INNER JOIN colors clr on pv.color_id=clr.id
        WHERE pv.id=$id;";
        $data = get_Table_Data($sql);
        $name='';
        foreach($data as $da){
            $name=$da['path'].$da['clrName'];
        }
        return $name;}
        else{
        return 0;
        }
}//gives the name of the folder so I can delete the folder form server

// ------------------------------------- Delete of each part -----------------------------------------

if (isset($_POST['delete_command'])) {
    $variable = $_POST['delete_command'];
    switch ($variable) {
        case 'delete_product_variant':
            //table details
            $tblName = "productVariant";
            $id = $_POST['id'];
            //storing folder name to delete later
            $folderName=get_folder_name_by_product_v_id($id);
            // echo $folderName;
            // first deleting data from its child table
            $child_tblName = "productVariant_image";
            $colName = "product_varient_id";
            $child_table = delete_from_sub_tbl($child_tblName, $colName, $id);
            // echo $child_table;
            if ($child_table == 1) {
                $response = delete_from($tblName, $id);
                if($response['status_code'] == 200){
                    if(remove_dir("../../../".$folderName)){
                        echo json_encode($response);
                    }
                    else{
                        echo "cannot delete folder";
                    }
                }
            } elseif ($child_table != 0) {
                echo json_encode(give_response($child_table));
            } else {
                echo json_encode(give_response(502));
            }
            break;
        case 'delete_product':
            //table details
            $tblName = "products";
            $id = $_POST['id'];
            $folder_name=get_folder_name_by_product_id($tblName, $id);
            $data = get_has_attachment($tblName, $id);
            $response = delete_from($tblName, $id);
            if ($response['status_code'] == 200) {
                if ($data != 0) {
                    if (delete_products_attachments($data) == 1) {
                        if(remove_dir("../../images/products/". $folder_name)){
                            echo json_encode($response);
                        }
                        else{
                            echo "cannot delete folder";
                        }
                    } else {
                        echo "cannot delete attachments";
                    }
                } else {
                    echo json_encode($response);
                }

            } else {
                echo json_encode($response);
            }
            break;
        case 'delete_category':
            // echo 'category';
            $tblName="category";
            $id = $_POST['id'];
            $response = delete_from($tblName, $id);
            echo json_encode($response);
            break;
        case 'delete_color':
            $tblName='colors';
            $id = $_POST['id'];
            $response = delete_from($tblName, $id);
            echo json_encode($response);
            break;
        case 'delete_review':
            $tblName='reviews';
            $id = $_POST['id'];
            $response = delete_from($tblName, $id);
            echo json_encode($response);
            break;
        case 'delete_faq':
            $tblName='faqs';
            $id = $_POST['id'];
            $response = delete_from($tblName, $id);
            echo json_encode($response);
            break;
        case 'delete_slide':
            $tblName = "carousel";
            $id = $_POST['id'];
            $data = get_has_attachment($tblName, $id);
            $response = delete_from($tblName, $id);
            if ($response['status_code'] == 200) {
                if ($data != 0) {
                    if (delete_banner_attachments($data) == 1) {
                        echo json_encode($response);
                    } else {
                        echo "cannot delete attachments";
                    }
                } else {
                    echo json_encode($response);
                }

            } else {
                echo json_encode($response);
            }
            break;
        case 'value':
            # code...
            break;
        default:
            echo "No task assigned to do.";
            break;
    }

}


?>