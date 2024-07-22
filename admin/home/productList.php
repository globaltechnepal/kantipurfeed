<?php include "header.php" ?>
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
    $cat_id = $_GET['id'];
    $query = "SELECT `category_name`, `category_id` FROM `category` where category_id='$cat_id';";
    $conn = dbConnecting();
    $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if (mysqli_num_rows($req) > 0) {
      while ($data = mysqli_fetch_assoc($req)) { ?>
    <div class="col-12 d-flex">
      <div class="p-1 mb-2 col-2 bg-dark text-white text-center text-uppercase" <?php echo $data['category_id']; ?>>
        <?php echo $data['category_name']; ?>
      </div>&nbsp;&nbsp;

      <button type="button" class="btn btn-outline-secondary mb-2 addProduct" data-bs-target="#exampleModalToggle"
        href="#exampleModalToggle" data-bs-toggle="modal" data-cat-ID="<?php echo $data['category_id'] ?>"
        data-cat-name="<?php echo $data['category_name'] ?>"><i class="bi bi-person-plus-fill"></i> Add</button>
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
          <td><a class="text-primary product" data-product-id="<?php echo $data['productID']; ?>"
              data-product-name="<?php echo $data['product_name']; ?>"
              data-specification="<?php echo $data['specification']; ?>"
              data-product_code="<?php echo $data['product_code']; ?>"
              
              data-product-actual_price="<?php echo $data['actual_price']; ?>"
              data-product-sell_price="<?php echo $data['sell_price']; ?>"
              data-product-wholesale_price="<?php echo $data['wholesaler_price']; ?>"
              data-product-dealer_price="<?php echo $data['dealer_price']; ?>"
              data-product-retailer_price="<?php echo $data['retailer_price']; ?>"
              data-img_path="<?php echo $data['img_path'] ?>"
              data-product-primary_image="<?php echo $data['primary_image']; ?>"
              data-product-secondary_image="<?php echo $data['secondary_image']; ?>"
              data-bs-target="#exampleModalToggle1" href="#exampleModalToggle1" data-bs-toggle="modal"><i
                class="bi bi-check2-circle"></i></a>
          <a name="deleteProducts" class="text-danger ms-2 me-2 text-center delete_item"
              data-del_item_name="product" data-del_item_id="<?php echo $data['productID']; ?>"><i
                class="bi bi-trash-fill"></i></a>
          <a class="text-success" href="productVarientList.php?id=<?php echo $data['productID']; ?>"><i
                class="bi bi-caret-right-square"></i></a></td>
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
<script>
  $(".addProduct").click(function () {// button class where button clicked
    var cid = $(this).attr("data-cat-ID"); //attribute from button data-category
    $("#catID").attr("value", cid.trim());// where to show id
    var cName = $(this).attr("data-cat-name"); //attribute from button data-category
    $("#addCategory_name").attr("value", cName.trim());
  });
</script>
<div class="modal ms-5 ps-5" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Add Product</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <input type="hidden" id="catID">
            <span class="input-group-text">Category Name</span>
            <input type="text" class="form-control me-2 clear_Form_data" name="addCategory_name" id="addCategory_name" readonly>
            <span class="input-group-text">Product Code</span>
            <input type="text" class="form-control me-2 clear_Form_data" name="addProduct_code" id="addProduct_code">
            <span class="input-group-text">Product Name</span>
            <input type="text" class="form-control me-2 clear_Form_data" name="addProduct_name" id="addProduct_name">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Specification</span>
            <input type="text" class="form-control me-2 clear_Form_data" name="specification" id="specification">
            <span class="input-group-text">Selling Price</span>
            <input type="text" class="form-control me-3 clear_Form_data" name="addSell_Price" id="addSell_Price">
            <span class="input-group-text">Market Price</span>
            <input type="text" class="form-control clear_Form_data" name="addActual_Price" id="addActual_Price">
          </div>
          <div class="input-group mb-3">
            <!--<span class="input-group-text">Wholesale Price</span>-->
            <input type="hidden" class="form-control me-3 clear_Form_data" name="wholesale_Price" id="wholesale_Price" value="0">
            <!--<span class="input-group-text">Retailer Price</span>-->
            <input type="hidden" class="form-control me-3 clear_Form_data" name="retailer_Price" id="retailer_Price" value="0">
            <!--<span class="input-group-text">Dealer Price</span>-->
            <input type="hidden" class="form-control me-3 clear_Form_data" name="dealer_Price" id="dealer_Price" value="0">
          </div>
        </div>
        <div class="card mb-3 ms-3 me-3 mt-5">
          <h5 class="m-3">Images</h5>
          <div class="input-group mb-3 mt-3 ms-2 me-5">
            <input type="file" class="form-control me-3 imgSize" name="addPrimary_image" onchange="add_primary_image()"
              id="addPrimary_image" accept="image/png, image/jpeg">
            <input type="file" class="form-control me-3 imgSize" name="addSecondary_image"
              onchange="add_secondary_image()" id="addSecondary_image" accept="image/png, image/jpeg"><br>
          </div>
          <span class="m-3 text-danger">Note : Please upload photo with 400 * 400 pixel image only. Must be
            trabsperent(no background).</span>
        </div>
        <button type="button" class="btn btn-primary ms-3 mb-5" name="ProductSubmit" id="ProductSubmit">Submit</button>
        <button type="button" class="btn btn-secondary mb-5 close_called" data-bs-dismiss="modal">Close</button>
        
      </form>
    </div>
  </div>
</div>

<script>
  async function add_primary_image() {
    // alert("i amin");
    let formData = new FormData();
    formData.append("file", addPrimary_image.files[0]);
    await fetch('../library/image_uploader.php', {
      method: "POST",
      body: formData
    });
  }
  async function add_secondary_image() {
    let formData = new FormData();
    formData.append("file", addSecondary_image.files[0]);
    await fetch('../library/image_uploader.php', {
      method: "POST",
      body: formData
    });
  }
</script>

<script>
// function moved to footer.php == $("#ProductSubmit").click(function () {
  
</script>
<!-- add new product -->
<!-- add new product -->

<!-- Update product -->
<!-- Update product -->
<script>
  $(".product").click(function () {// button class where button clicked
    var pid = $(this).attr("data-product-id"); //attribute from button data-category
    $("#update_p_id").attr("value", pid.trim());// where to show id
    
    var specification = $(this).attr("data-specification"); //attribute from button data-category
    $("#updateSpecification").attr("value", specification.trim());// where to show id
    
    var product_code = $(this).attr("data-product_code"); //attribute from button data-category
    $("#updateProduct_code").attr("value", product_code.trim());// where to show id

    var pname = $(this).attr("data-product-name"); //attribute from button data-category
    $("#update_product_name").attr("value", pname.trim());// where to show id

    var Pactual_price = $(this).attr("data-product-actual_price"); //attribute from button data-category
    $("#update_actual_Price").attr("value", Pactual_price.trim());// where to show id

    var Psell_price = $(this).attr("data-product-sell_price"); //attribute from button data-category
    $("#update_sell_Price").attr("value", Psell_price.trim());// where to show id
    
    var Pwholesale_price = $(this).attr("data-product-wholesale_price"); //attribute from button data-category
    $("#update_wholesale_Price").attr("value", Pwholesale_price.trim());// where to show id
    
     var Pdealer_price = $(this).attr("data-product-dealer_price"); //attribute from button data-category
    $("#update_dealer_Price").attr("value", Pdealer_price.trim());// where to show id
    
         var Pretailer_price = $(this).attr("data-product-retailer_price"); //attribute from button data-category..................
    $("#update_retailer_Price").attr("value", Pretailer_price.trim());// where to show id

    var img_path = $(this).attr("data-img_path"); //attribute from button data-category 
    $("#pbtnView").attr("data-img_path", img_path.trim());// where to show id

    // alert(img_path);

    var Pprimary_image = $(this).attr("data-product-primary_image"); //attribute from button data-category
    $("#pbtnView").attr("data-p_img", Pprimary_image.trim());// where to show id
    $("#hidPrimaryImage").val(Pprimary_image.trim());
    $("#pbtnView").attr("src", "../../" + img_path.trim() + Pprimary_image);


    var img_path = $(this).attr("data-img_path"); //attribute from button data-category
    $("#sbtnView").attr("data-img_path", img_path.trim());// where to show id
    var Psecondary_image = $(this).attr("data-product-secondary_image"); //attribute from button data-category
    $("#sbtnView").attr("data-s_img", Psecondary_image.trim());// where to show id
    $("#hidSecondaryImage").val(Psecondary_image.trim());
    $("#sbtnView").attr("src", "../../" + img_path.trim() + Psecondary_image)

  })
</script>
<!-- update image and store in folder -->
<!-- update image and store in folder -->
<script>
  async function upload_primary_image() {
    // alert("i amin");
    let formData = new FormData();
    formData.append("file", update_primary_image.files[0]);
    await fetch('../library/image_uploader.php', {
      method: "POST",
      body: formData
    });
  }
  async function upload_secondary_image() {
    let formData = new FormData();
    formData.append("file", update_secondary_image.files[0]);
    await fetch('library/image_uploader.php', {
      method: "POST",
      body: formData
    });
  }
</script>

<!-- update image and store in folder -->
<!-- update image and store in folder -->
<div class="modal ms-5 ps-5" id="exampleModalToggle1" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle1"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Update Product</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <input type="hidden" name="update_p_id" id="update_p_id">
            <span class="input-group-text">Product Name</span>
            <input type="text" class="form-control me-2" name="update_product_name" id="update_product_name">
            <span class="input-group-text">Product Code</span>
            <input type="text" class="form-control me-2 clear_Form_data" name="updateProduct_code" id="updateProduct_code">
            <span class="input-group-text">Specification</span>
            <input type="text" class="form-control me-2 clear_Form_data" name="updateSpecification" id="updateSpecification">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Selling Price</span>
            <input type="text" class="form-control me-3" name="update_sell_Price" id="update_sell_Price">
            <span class="input-group-text">Actual Price</span>
            <input type="text" class="form-control" name="update_actual_Price" id="update_actual_Price">
          </div>
        <!--</div>-->
          <div class="input-group mb-3">
            <!--<span class="input-group-text">Wholesale Price</span>-->
            <input type="hidden" class="form-control me-3" name="update_wholesale_Price" id="update_wholesale_Price">
            <!--<span class="input-group-text">Retailer Price</span>-->
            <input type="hidden" class="form-control me-3" name="update_retailer_Price" id="update_retailer_Price">
             <!--<span class="input-group-text">Dealer Price</span>-->
            <input type="hidden" class="form-control me-3" name="update_dealer_Price" id="update_dealer_Price">
          </div>
        </div>
        <div class="card mb-3 ms-3 me-3 mt-5">
          <h5 class="m-3">Images</h5>
          <div class="d-inline-flex">
            <div class="col">
              <input type="hidden" id="hidPrimaryImage">
              <input type="hidden" id="hidSecondaryImage">
              <span class="input-group-text" id="basic-addon1">
                <input type="file" class="form-control" onchange="upload_primary_image()" name="update_primary_image"
                  id="update_primary_image">
              </span>
              <div class="col-12 text-center">
                <img id="pbtnView" name="pbtnView" class="w-50">
              </div>
            </div>
            <div class="col text-center">
              <span class="input-group-text" id="basic-addon1">
                <input type="file" class="form-control" onchange="upload_secondary_image()"
                  name="update_secondary_image" id="update_secondary_image"></span>
              <div class="col-12">
                <img id="sbtnView" name="sbtnView" class="w-50">
              </div>
            </div>
          </div>
          <span class="m-3">Note:Please upload photo with 400*400 pixel image only. Must be transperent(no
            background).</span>
        </div>
        <button type="button" class="btn btn-primary ms-3 mb-5" name="updateProduct" id="updateProduct">Submit</button>
        <button type="button" class="btn btn-secondary mb-5" data-bs-dismiss="modal">Close</button>
      </form>
    </div>
  </div>
</div>
<script>

  $('#updateProduct').click(function () {
    var update_p_id = $("#update_p_id").val();
    var updateProduct_code = $("#updateProduct_code").val();
        alert(updateProduct_code);
    var updateSpecification = $("#updateSpecification").val();
    var update_product_name = $("#update_product_name").val();
    var update_sell_Price = $("#update_sell_Price").val();
    var update_actual_Price = $("#update_actual_Price").val();
    var update_wholesale_Price = $("#update_wholesale_Price").val();
    var update_dealer_Price = $("#update_dealer_Price").val();
    var update_retailer_Price = $("#update_retailer_Price").val();
    var update_primary_image = $("#update_primary_image").val().replace(/C:\\fakepath\\/i, '');
    var update_secondary_image = $("#update_secondary_image").val().replace(/C:\\fakepath\\/i, '');
    if (update_primary_image == "") {
      update_primary_image = $("#hidPrimaryImage").val();
    }
    if (update_secondary_image == "") {
      update_secondary_image = $("#hidSecondaryImage").val();
    }
    if (update_product_name == "" || update_actual_Price == "") {
      alert("Form field are empty. Please fill the form properly");
      return false;
    }
    else {
      $.ajax({
        url: "../library/database.php",
        method: "POST",
        data: { updateProduct_code:updateProduct_code, update_product_name: update_product_name,updateSpecification:updateSpecification, update_p_id: update_p_id, update_sell_Price: update_sell_Price, update_actual_Price: update_actual_Price, update_primary_image: update_primary_image, update_secondary_image: update_secondary_image,update_wholesale_Price:update_wholesale_Price,update_dealer_Price:update_dealer_Price,update_retailer_Price:update_retailer_Price },
        success: function () {
          alert("Product update success");
          location.reload();
        }
      });
    }
  });
</script>
<!-- Update product -->
<!-- Update product -->
<?php include "footer.php"; ?>