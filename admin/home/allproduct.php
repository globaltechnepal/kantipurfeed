<?php include 'header.php'; ?>
<style>
    table.dataTable tbody td {
  padding: 0px 10px;
}
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }
</style>
<!-- Page Wrapper -->
<div id="wrapper">
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">
      <!-- Begin Page Content -->
      <div class="container-fluid">
        <!-- Page Heading -->
        <div class="p-1 mb-2 col-2 bg-dark text-white text-center text-uppercase mb-3 text-gray-800">All Product</div>
        <table id="table_id" class="display" style="font-size:1rim;">
          <thead>
            <tr>
              <th>S.N.</th>
              <th class="col-1">Category Name</th>
              <th class="col-2">Product Name</th>
              <th>Price</th>
              <th>Color</th>
              <th>Quantity</th>
              <th class="col-1">Product Image</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $query = "SELECT pv.`id` `stock_in`, `stock_out`, `defective`, `returned`, `available`, `total`,`actual_price`,`color_name`,`product_name`,`category_name`,pv_images.`img_path`,`img` FROM `productVariant` pv 
INNER JOIN products p ON p.id = pv.product_id 
INNER JOIN colors clr ON clr.id = pv.color_id
INNER JOIN category c ON c.category_id = p.category_id
INNER JOIN productVariant_image pv_images ON pv_images.product_varient_id=pv.id";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
              $i = 1;
              while ($data = mysqli_fetch_assoc($req)) { ?>
            <tr class="fs-6">
              <td>
                <?php echo $i; ?>
              </td>
              <td>
                <?php echo $data['category_name']; ?>
              </td>
              <td>
                <?php echo $data['product_name'] ?>
              </td>
              <td>
                <?php echo $data['actual_price']; ?>
              </td>
              <td>
                <?php echo $data['color_name']; ?>
              </td>
              <td>
                <?php echo $data['available']; ?>
              </td>
              <td><img src="data:image/jepg;base64,<?php echo $data['img']; ?>" style="width:100%;height:50px;"></td>
            </tr>
            <?php
                $i++;
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- 000.container-fluid -->


<?php include "footer.php"; ?>