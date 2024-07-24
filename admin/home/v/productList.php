<?php include "../header.php" ?>
<style>table.dataTable tbody td {
  padding: 0px 10px !important;
}
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }
</style>
<div class="col-12">
  <div class="col-12">
    <?php
    $cat_id = (isset($_POST['id']) ? $_POST['id'] : null);
    //$cat_id = $_GET['id'];
    $query = "SELECT `category_name`, `category_id` FROM `category` where category_id='$cat_id'";
    $conn = dbConnecting();
    $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($req) > 0) {
      while ($data = mysqli_fetch_assoc($req)) { ?>
    <div class="col-12 d-flex">
      <div class="p-1 mb-2 col-2 bg-dark text-white text-center text-uppercase" <?php echo $data['category_id']; ?>>
        <?php echo $data['category_id']; ?>
      </div>&nbsp;&nbsp;
      <?php
      }
    }
      ?>
    </div>
    <!-- datatable start -->
    <!-- datatable start -->
    <table id="table_id" class="display" style="font-size:1rim;">
      <thead>
        <tr>
          <th>S.N</th>
          <th>Product Code</th>
          <th>Product Name</th>
          <th>Product Specification</th>
          <th>Actual Price</th>
          <th>Marketing Price</th>
          <!--<th>Wholesale Price</th>-->
          <!--<th>Retailer Price</th>-->
          <!--<th>Dealer Price</th>-->
          <th class="col-1">Product Image</th>
          <th>Action</th>
      </thead>
      <tbody>
        <?php
        // $cat_id = $_GET['id'];
        $query = "select id as productID,product_code,specification,product_name,`specification`,`product_code`,actual_price,sell_price,`wholesaler_price`,`dealer_price`,`retailer_price`,img_path,primary_image,secondary_image from products where category_id='$cat_id';";
        // $conn = dbConnecting();
        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
        if (mysqli_num_rows($req) > 0) {
          $i = 1;
          while ($data = mysqli_fetch_assoc($req)) { ?>
        <tr>
          <td>
            <?php echo $i; ?>
          </td>
          <td>
             <?php echo $data['product_code']; ?> 
          </td>
          <td>
            <?php echo $data['product_name']; ?>
          </td>
          <td class="col-1">
            <?php echo $data['specification']; ?>
          </td>
          <td>
            <?php echo $data['actual_price']; ?>
          </td>
          <td>
            <?php echo $data['sell_price']; ?>
          </td>
          <td><img src="data:image/jpeg;base64,<?php echo $data['primary_image']; ?>" style="width:100%;height: 50px;" onerror="this.onerror=null; this.src='../../product-icon.png';"></td>
          <td>
                <form action='index.php' method='post'>
                <input type="hidden" name='o' value='product.varient.list'>
                <input type="hidden" name='id' value='<?php echo $data['productID']; ?>'>
                <button type="submit" class="text-success" style="border:none; background:transparent;" ><i class="bi bi-caret-right-square"></i></button>
                </form>
</td>
        </tr>
        <?php
            $i++;
          }
        }
        ?>
      </tbody>
    </table>
    <!-- datatable end -->
    <!-- datatable end -->
  </div>
</div>
<!-- add new product -->
<!-- add new product -->
<?php include "../footer.php"; ?>