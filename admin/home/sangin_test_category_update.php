<?php  include "header.php" ?>
<div class="col-12">
<div class="col-12 d-flex">
<div class="p-3 mb-2 col-4 bg-dark text-white text-center text-uppercase"><h2>Category List</h2></div>
<button type="button" class="btn btn-outline-secondary col-2 ms-3 mb-2" data-bs-target="#exampleModalToggle" href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button> </div>
<!-- datatable start -->
<!-- datatable start -->
  <table id="table_id" class="display">
   <thead>
        <tr>
          <th>S.N.</th>
          <th>Category Name</th>
           <th>Category ID</th>
          <th>Category Type</th>
          <th>Update</th>
          <th>Delete</th>
          <th>Product</th>
    </thead>
    <tbody>
      <?php 
      $myQuery = "SELECT `id`, `category_name`, `category_type`, `category_id`, `remarks` FROM `category`";
      $conn = dbConnecting();
      $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
      if(mysqli_num_rows($req)>0){
      $i=1;
      while($data = mysqli_fetch_assoc($req)){ ?>
      <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $data['category_name'] ?></td>
        <td><?php echo $data['category_id'] ?></td>
        <td><?php echo $data['category_type'] ?></td>
        <!-- <?php echo $data['category_id']; ?> -->
        <!-- <div class="jpt1"><input type="hidden" value="<?php echo $data['category_id']; ?>"></div> -->
        <td><a class="btn btn-primary updateCategory" data-category="<?php echo $data['category_id']; ?>"  data-bs-target="#exampleModalToggle1" href="#exampleModalToggle1" data-bs-toggle="modal"><i class="bi bi-check2-circle"></i></a></td>
        <td><form action="#" method="post" enctype="multipart/form-data"><button type="submit" name="deletecategory" class="btn btn-danger text-center"><i class="bi bi-trash-fill"></i></button></form></td>
        <td><a class="btn btn-success" href="productList.php?id=<?php echo $data['category_id']; ?>"><i class="bi bi-caret-right-square"></i></a></td>
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




<!-- add new category -->
<!-- add new product  -->
<div class="modal ms-5 ps-5" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggle" tabindex="-1">
  <div  class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Add Category</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <span class="input-group-text">C ID</span>
            <input type="text" class="form-control me-2" id="id" name="id">
            <span class="input-group-text">Category ID</span>
            <input type="text" class="form-control me-2" id="category_id" name="category_id">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Category Name</span>
            <input type="text" class="form-control me-2" id="category_name" name="category_name">
            <span class="input-group-text">Category Type</span>
            <input type="text" class="form-control me-2" id="category_type" name="category_type">
          </div>
          <button type="submit" class="btn btn-primary ms-3 mb-5" id="categorySubmit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- script to add new category -->
<!-- script to add new category -->
<script>
$('#categorySubmit').click(function(){
  // alert("Clicked");
  var id = $('#id').val(); 
  var category_id = $('#category_id').val(); 
  var category_name = $('#category_name').val(); 
  var category_type = $('#category_type').val(); 
  if(id=="" || category_id=="" || category_name=="" || category_type==""){
    alert("Please Fill The Field");
    return false; 
  }
  else
  {
    $.ajax({
      url:"library/database.php",
      method:"POST",
      data:{category_name:category_name,id:id,category_id:category_id,category_type:category_type},
      success:function(data)
      {
      alert("ok");
      }
    });
  }
});
</script>
<!-- script to add new category -->
<!-- script to add new category -->
<!-- add new category -->
<!-- add new product  -->


<script>
    $(document).ready(function(){
        $(".updateCategory").click(function(){
         // var jpt= $(this).find('.jpt1');
        var catid = $(this).attr("data-category");
        alert (catid);

            // val cat_id= $(this).first("input").val();
           // alert("ok clicked please proceed."+" cat id is : ");
        })
    });
</script>
<!-- Update product -->
<!-- Update product -->
<div class="modal ms-5 ps-5" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggle1" tabindex="-1">
  <div  class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Update Category</div>
        <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <span class="input-group-text">C ID</span>
            <input type="text" class="form-control me-2" id="update_id" name="update_id" value="<?php echo $data['c_id']; ?>" readonly>
            <span class="input-group-text">Category ID</span>
            <input type="text" class="form-control me-2" id="update_category_id" name="update_category_id" value="<?php echo $data['category_id']; ?>" readonly>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Category Name</span>
            <input type="text" class="form-control me-2" id="update_category_name" name="update_category_name">
            <span class="input-group-text">Category Type</span>
            <input type="text" class="form-control me-2" id="update_category_type" name="update_category_type">
          </div>
          <button type="submit" class="btn btn-primary ms-3 mb-5" id="UpdateCategorySubmit">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Update product -->
<!-- Update product -->
<script>
$('#UpdateCategorySubmit').click(function(){
var update_id = $('update_id').val();
var update_category_id = $('update_category_id').val();
var updatecategoryname = $('update_category_name').val();
var updatecategorytype = $('update_category_type').val();
  if(updatecategoryname=="" || updatecategorytype==""){
    alert("Please Fill The Field");
    return false; 
 }
 else{
$.ajax({
  url: "library/database.php",
  method: "POST",
  data: {updatecategoryname:u_category_name,update_id:u_id,update_category_id:u_category_id, updatecategorytype:u_category_type},
  success:function(data)
  {
   $('#update_id').html(res.id);
   $('#update_category_id').html(res.category_id);
  }
  });
 }
});
</script>
 <?php include "footer.php"; ?>                  