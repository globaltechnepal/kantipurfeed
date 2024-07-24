<?php 
include'header.php';
?>
<!-- heading start -->
<!-- heading start -->
 <div class="col-12 d-flex">
   <div class="p-3 mb-2 col-6 me-3 bg-dark text-white text-center">Offer List</div>
    <button type="button" onclick="test();" class="btn btn-outline-secondary col-2 me-2 mb-2" data-bs-target="#exampleModalToggle1" href="#exampleModalToggle1" data-bs-toggle="modal"><i class="bi bi-plus-square-fill"></i>New Offer</button> 
  </div>
<!-- heading end -->
<!-- heading end -->

<!-- add new offer modal -->
<!-- add new offer modal -->
 <script>
        function test(){
            if(document.getElementById("offerModule").style.display==="block"){
                document.getElementById("offerModule").style.display="none";
            }
            else {document.getElementById("offerModule").style.display="block";}
        }
  </script>
<div class="m-3 p-3" id="offerModule" style="border: 1px solid #ced4da;">
<div class="p-3 mb-2 bg-dark text-white text-center">New Offer</div>
 <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Category</span>
  <input type="text" class="form-control me-2">
  <span class="input-group-text" id="basic-addon1">Product Name</span>
  <input type="text" class="form-control">
</div>
 <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Actual Price</span>
  <input type="text" class="form-control me-2">
  <span class="input-group-text" id="basic-addon1">Offer Price</span>
  <input type="text" class="form-control">
</div>
 <div class="input-group mb-3 col-12"  style="border: 1px solid #ced4da;">
 <div class="mb-3 d-flex col-12">
 <div class="col-6">
   <label for="formFile" class="form-label">Primary Image</label>
  <input class="form-control" type="file" id="formFile">
 </div>
  <div class="col-6">
   <label for="formFile" class="form-label">Secondary Image</label>
  <input class="form-control" type="file" id="formFile">
 </div>
</div>
<span class="m-3">Note: Must be transperent and 400*400 pixels.</span>
</div>
<div class="col-12" style="border: 1px solid #ced4da;">
<div>
    <span>Hover and change image</span>
    <div class="mb-3 d-flex">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
    </div>
    <div class="mb-3 d-flex">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
    </div>
</div>
<span class="mb-3">Note: Must be transperent and 2100*2100 pixels.</span>
</div>
<div>
    <button type="button" class="btn btn-danger mt-3">Submit</button>
</div>
</div>
<!-- add new offer modal -->
<!-- add new offer modal -->

<!-- datatable start -->
<!-- datatable start -->
 <div class="p-3">
    <table id="table_id" class="display">
    <thead>
        <tr>
          <th>S.N</th>
          <th>Offer</th>
          <th>Category</th>
          <th>Product Name</th>
          <th>Update</th>
          <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Festival</td>
            <td>Earbuds</td>
            <td>Atom 192</td>
            <td><a class="btn btn-success" data-bs-target="#exampleModalToggle2" href="#exampleModalToggle2" data-bs-toggle="modal"><i class="bi bi-check2-circle"></i></a></td>
            <td><form action="#" method="post" enctype="multipart/form-data"><button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></form></td>
        </tr>
    </tbody>
  </table>
 </div>
<!-- datatable end -->
<!-- datatable end -->

<!-- update & view modal -->
<!-- update & view modal -->
<div class="modal fade ms-5 ps-5 abcclass" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggle2" tabindex="-1">
  <div  class="modal-dialog modal-lg ps-5"  style="max-width:1060px;margin-left:90px;">
    <div class="modal-content p-3">
      <div class="p-3 mb-2 bg-dark text-white text-center">Update Offer</div>
       <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Category</span>
  <input type="text" class="form-control me-2">
  <span class="input-group-text" id="basic-addon1">Product Name</span>
  <input type="text" class="form-control">
</div>
 <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1">Actual Price</span>
  <input type="text" class="form-control me-2">
  <span class="input-group-text" id="basic-addon1">Offer Price</span>
  <input type="text" class="form-control">
</div>
 <div class="input-group mb-3 col-12"  style="border: 1px solid #ced4da;">
 <div class="mb-3 d-flex col-12">
 <div class="col-6">
   <label for="formFile" class="form-label">Primary Image</label>
  <input class="form-control" type="file" id="formFile">
 </div>
  <div class="col-6">
   <label for="formFile" class="form-label">Secondary Image</label>
  <input class="form-control" type="file" id="formFile">
 </div>
</div>
<span class="m-3">Note: Must be transperent and 400*400 pixels.</span>
</div>
<div class="col-12" style="border: 1px solid #ced4da;">
<div>
    <span>Hover and change image</span>
    <div class="mb-3 d-flex">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
    </div>
    <div class="mb-3 d-flex">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
        <input class="form-control me-2" type="file" id="formFile">
    </div>
</div>
<span class="mb-3">Note: Must be transperent and 2100*2100 pixels.</span>
</div>
<div>
    <button type="button" class="btn btn-danger mt-3">Submit</button>
</div>
</div>
</div>
</div>
<!-- update & view modal -->
<!-- update & view modal -->
<?php  
include'footer.php';
?>
