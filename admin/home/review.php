<?php include "header.php" ?>
<!-- heading start -->
<!-- heading start -->
<div class="col-12">
    <?php
    $p_id = $_GET['id'];
    $productNameQRY = "SELECT `id`,`product_name`,LEFT(product_name,20)as trunkName  FROM `products` where id=$p_id";
    $conn = dbConnecting();
    $req = mysqli_query($conn,$productNameQRY) or die(mysqli_error($conn));
    if(mysqli_num_rows($req)>0){
    for($i=1;$i<15;$i++){ while ($data=mysqli_fetch_assoc($req)) { ?>
    <div class="p-3 mb-2 col-6 me-3 bg-dark text-white text-center">Review List : <?php echo $data['product_name'] ?></div>
    <?php
    }
    }
}
    ?>
</div>
<!-- heading end -->
<!-- heading end -->

<!-- datatable start -->
<!-- datatable start -->
<div class="p-3">
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Username</th>
                <th>Review Point</th>
                <th class="col-3">Review Message</th>
                <th class="col-1">Photo</th>
                <!--<th>Show</th>-->
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                  $myQuery = "SELECT r.`id`, `product_id`, `user_id`, `user_name`, `review_point`, `review_message`, `attachment`, `submit_date`, p.`product_name` FROM `reviews` r 
                  INNER JOIN products p on p.id = r.product_id WHERE r.product_id=$p_id;";
                  $conn = dbConnecting();
                  $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
                  if(mysqli_num_rows($req)>0){
                  $i=1;
                  while($data = mysqli_fetch_assoc($req)){ 
            ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $data['user_name'] ?></td>
            <td><?php echo $data['review_point'] ?></td>
            <td><div class="w-100 wrap"><?php echo $data['review_message'];?></div></td>
            <td><img src="<?php echo "../../".$data['attachment'] ?>" class="w-100"></td>
            <!--<td><form action="#" method="post" enctype="multipart/form-data"><button type="submit" class="btn btn-success"><i class="bi bi-save2"></i></button></form></td>-->
            <td><button type="submit" class="btn btn-danger delete_item" data-del_item_id="<?php echo $data['id'] ?>" data-del_item_name="review"><i class="bi bi-trash-fill" ></i></button></td>
        </tr>
    <?php
        $i++;
        }
      }
    ?>
    </tbody>
  </table>
 </div>
<!-- datatable end -->
<!-- datatable end -->
<?php include "footer.php" ?>