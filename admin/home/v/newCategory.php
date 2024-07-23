<?php include "../header.php" ?>
<style>
    table.dataTable tbody td {
  padding: 1px 34px !important;
    }
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }

</style>
<div class="col-12">
  <div class="col-12 d-flex">
    <div class="p-1 mb-2 bg-dark text-white text-center text-uppercase">
      <div>Category List</div>
    </div>
    <button type="button" class="btn btn-outline-secondary col-1 ms-3 mb-2" data-bs-target="#exampleModalToggle"
      href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button>
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr style="font-size:13px;">
        <th>S.N.</th>
        <th>Category Name</th>
        <th>Category ID</th>
        <th>Category Type</th>
        <th>Image</th>
        <th>Actions</th>
      </tr>
    </thead>
   <tbody>
  <?php
  $myQuery = "SELECT * FROM `category` ORDER BY id DESC;";
  $conn = dbConnecting();
  $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
  if (mysqli_num_rows($req) > 0) {
    $i = 1;
    while ($data = mysqli_fetch_assoc($req)) { ?>
      <tr>
        <td style="font-size:1rem;">
          <?php echo $i ?>
        </td>
        <td style="font-size:1rem;">
          <?php echo $data['category_name'] ?>
        </td>
        <td style="font-size:1rem;">
          <?php echo $data['category_id'] ?>
        </td>
        <td style="font-size:1rem;">
          <?php echo $data['category_type'] ?>
        </td>
        <td class="col-1">
          <img class="w-100" src="data:image/jpeg;base64,<?php echo $data['image']; ?>" onerror="this.onerror=null; this.src='../../product-icon.png';">
        </td>
        <td>
          <a class="text-primary categories" data-category-id="<?php echo $data['category_id']; ?>" data-category-name="<?php echo $data['category_name']; ?>" data-category-type="<?php echo $data['category_type']; ?>" data-bs-target="#exampleModalToggle1" href="#exampleModalToggle1" data-bs-toggle="modal"><i class="bi bi-check2-circle"></i></a>
          <a name="delete_category" class="text-center ms-2 me-2 text-danger delete_item" data-del_item_id="<?php echo $data['id']; ?>" data-del_item_name="category"><i class="bi bi-trash-fill"></i></a>
          
                <form action='index.php' method='post'>
                <input type="hidden" name='o' value='product.list'>
                <input type="hidden" name='id' value='<?php echo $data['category_id']; ?>'>
                <button type="submit" class="text-success" style="border:none; background:transparent;" ><i class="bi bi-caret-right-square"></i></button>
                </form>
        </td>
      </tr>
  <?php
      $i++;
    }
  }
//   else {
//     // If no data is available
//     echo "<tr><td colspan='6'>No data available</td></tr>";
//   }
  ?>
</tbody>

  </table>
  <!-- datatable end -->
  <!-- datatable end -->
</div>
</div>
<!-- add new category -->
<!-- add new product  -->
<div class="modal ms-5 ps-5" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Add Category</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <!-- <span class="input-group-text">C ID</span>
            <input type="text" class="form-control me-2" id="catid" name="catid"> -->
            <span class="input-group-text">Category ID</span>
            <input type="text" class="form-control me-2 clear_Form_data" id="category_id" name="category_id">
            <span class="input-group-text">Category Name</span>
            <input type="text" class="form-control me-2 clear_Form_data" id="category_name" name="category_name">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Category Image</span>
            <input type="file" class="form-control me-2 clear_Form_data" id="category_image" onchange="add_cat_image()" accept="image/png, image/jpeg" name="category_image">
            <span class="input-group-text">Category Type</span>
            <input type="text" class="form-control me-2 clear_Form_data" id="category_type" name="category_type">
          </div>
          <button type="button" class="btn btn-primary ms-3 mb-3" id="categorySubmit">Submit</button>
          <button type="button" class="btn btn-secondary mb-3 close_called" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
   async function add_cat_image() {
    let formData = new FormData();
    formData.append("file", category_image.files[0]);
    await fetch('library/add_cat_image.php', {
      method: "POST",
      body: formData
    });
  }
  
  async function update_cat_image() {
    let formData = new FormData();
    formData.append("file", cat_image_update.files[0]);
    await fetch('library/add_cat_image.php', {
      method: "POST",
      body: formData
    });
  }
</script>
<script>
  // $('#submitColor').on("click", function ()---------------now in footer section-----------------------
</script>
<!-- add new category -->
<!-- add new product  -->

<!-- Update product -->
<!-- Update product -->
<script>
  $(".categories").click(function () {// button class where button clicked
    // alert('ok');
    var catid = $(this).attr("data-category-id"); //attribute from button data-category
    //$("#update_category_id").val(catid);// where to show id
    $("#update_category_id").attr("value", catid.trim());// where to show id
    var catname = $(this).attr("data-category-name"); //attribute from button data-category
    // $("#update_category_name").val(catname);// where to show id
    $("#update_category_name").attr("value", catname.trim());// where to show id

    var cattype = $(this).attr("data-category-type"); //attribute from button data-category
    //$("#update_category_type").val(cattype);// where to show id
    $("#update_category_type").attr("value", cattype.trim());// where to show id
  })
</script>
<div class="modal ms-5 ps-5" id="exampleModalToggle1" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle1"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Update Category</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <span class="input-group-text">Category ID</span>
            <input type="text" class="form-control me-2" id="update_category_id" name="update_category_id" readonly>
            <span class="input-group-text">Category Name</span>
            <input type="text" class="form-control me-2" id="update_category_name" name="update_category_name">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Category Image</span>
            <input type="file" class="form-control me-2" id="cat_image_update" name="cat_image_update" onchange="update_cat_image()">
            <span class="input-group-text">Category Type</span>
            <input type="text" class="form-control me-2" id="update_category_type" name="update_category_type">
          </div>
          
          <button type="button" class="btn btn-primary ms-3 mb-3" id="updateCategorySubmit">Submit</button>
          <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  // $('#submitColor').on("click", function ()---------------now in footer section-----------------------
</script>
<!-- Update product -->
<!-- Update product -->
<?php include "../footer.php"; ?>