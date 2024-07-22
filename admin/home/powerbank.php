<?php  include "header.php" ?>
<div class="col-12">
<div class="col-12">
<div class="col-12 d-flex">
  <h3>Powerbank</h3>
 <button type="button" class="btn ms-3 btn-outline-secondary col-2 mb-2" data-bs-target="#exampleModalToggle" href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button> </div>
</div>
<!-- datatable start -->
<!-- datatable start -->
  <table id="table_id" class="display">
   <thead>
        <tr>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Actual Price</th>
          <th>Selling Price</th>
          <th>Product Image</th>
          <th>Type</th>
          <th>Quantity</th>
          <th>Update</th>
          <th>Delete</th>
    </thead>
    <tbody>
      <?php
      $query="select id,product_name,actual_price,sell_price,img_path,primary_image from products where category_id=103;";
      $conn = dbConnecting();
      $req =  mysqli_query($conn,$query) or die(mysqli_error($conn));
      if(mysqli_num_rows($req)>0){
                            $i=1;
                            while($data = mysqli_fetch_assoc($req)){  ?>
                            <tr>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $data['product_name']; ?></td>
                              <td><?php echo $data['actual_price']; ?></td>
                              <td><?php echo $data['sell_price']; ?></td>
                              <td><img src="<?php echo "../../".$data['img_path'].$data['primary_image']; ?>" class="w-25"></td>
                              <td><?php echo "Data not found"; ?></td>
                              <td><?php echo "Data not found"; ?></td>
                              <td><a class="btn btn-success" data-bs-target="#exampleModalToggle1" href="#exampleModalToggle1" data-bs-toggle="modal"><i class="bi bi-check2-circle"></i></a></td>
                              <td><form action="#" method="post" enctype="multipart/form-data"><button type="submit" name="deleteSubHeading" class="btn btn-danger text-center"><i class="bi bi-trash-fill"></i></button></form></td>
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
<div class="modal ms-5 ps-5" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggle" tabindex="-1">
  <div  class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Add Product</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <span class="input-group-text">Category Name</span>
            <input type="text" class="form-control me-2" name="" required>
            <span class="input-group-text">Product Name</span>
            <input type="text" class="form-control me-2" name="" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Selling Price</span>
            <input type="text" class="form-control me-3" name="" required>
            <span class="input-group-text">Actual Price</span>
            <input type="text" class="form-control"  required>
          </div>
        </div>
        <div class="card mb-3 ms-3 me-3 mt-5">
          <h5 class="m-3">Cart Primary and scondary images</h5>
          <div class="input-group mb-3 mt-3 ms-2 me-5">
            <input type="file" class="form-control me-3" >
            <input type="file" class="form-control me-3"><br>
          </div>
          <span class="m-3">Note:Please upload photo with 400*400 pixel image only. Must be trabsperent(no background).</span>
        </div>
        
        <div class="card mb-3 ms-3 me-3 mt-5">
          <h5 class="m-3">Hover and display Image</h5>
          <div class="input-group mb-3 mt-3 ms-2 me-5">
            <input type="file" class="form-control me-3" >
            <input type="file" class="form-control me-3">            
            <input type="file" class="form-control me-3" >
          </div>
          <div class="input-group mb-3 mt-3 ms-2 me-5">
            <input type="file" class="form-control me-3" >
            <input type="file" class="form-control me-3">            
            <input type="file" class="form-control me-3" >
          </div>
          <span class="m-3">Note:Please upload photo with 2100*2100 pixel image only. Must be trabsperent(no background).</span>
        </div>
        <button type="submit" class="btn btn-primary ms-3 mb-5" name="" value="">Submit</button>
      </form>
    </div>
  </div>
</div>
<!-- add new product -->
<!-- add new product -->

<!-- Update product -->
<!-- Update product -->
<div class="modal ms-5 ps-5" id="exampleModalToggle1" aria-hidden="true" aria-labelledby="exampleModalToggle1" tabindex="-1">
  <div  class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Update Product</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="input-group mb-3">
            <span class="input-group-text">Category Name</span>
            <input type="text" class="form-control me-2" name="" required>
            <span class="input-group-text">Product Name</span>
            <input type="text" class="form-control me-2" name="" required>
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Selling Price</span>
            <input type="text" class="form-control me-3" name="" required>
            <span class="input-group-text">Actual Price</span>
            <input type="text" class="form-control"  required>
          </div>
        </div>
        <div class="card mb-3 ms-3 me-3 mt-5">
          <h5 class="m-3">Cart Primary and scondary images</h5>
          <div class="input-group mb-3 mt-3 ms-2 me-5">
            <input type="file" class="form-control me-3" >
            <input type="file" class="form-control me-3"><br>
          </div>
          <span class="m-3">Note:Please upload photo with 400*400 pixel image only. Must be trabsperent(no background).</span>
        </div>
        
        <div class="card mb-3 ms-3 me-3 mt-5">
          <h5 class="m-3">Hover and display Image</h5>
          <div class="input-group mb-3 mt-3 ms-2 me-5">
            <input type="file" class="form-control me-3" >
            <input type="file" class="form-control me-3">            
            <input type="file" class="form-control me-3" >
          </div>
          <div class="input-group mb-3 mt-3 ms-2 me-5">
            <input type="file" class="form-control me-3" >
            <input type="file" class="form-control me-3">            
            <input type="file" class="form-control me-3" >
          </div>
          <span class="m-3">Note:Please upload photo with 2100*2100 pixel image only. Must be trabsperent(no background).</span>
        </div>
        <button type="submit" class="btn btn-primary ms-3 mb-5" name="" value="">Submit</button>
      </form>
    </div>
  </div>
</div>
<!-- Update product -->
<!-- Update product -->
 <?php include "footer.php"; ?>          