<?php include 'header.php'; 
?>
<form action="#" method="post" enctype='multipart/form-data'>
<div class="container col-11">
<div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2 p-3" style="border:1px solid gray">
<div class="col-12 text-center">
  <div class="py-3 mb-2 bg-dark text-white ">Product Varient Form</div>
</div>
<div class="col p-3">
  <span class="input-group-text"> varient ID : &nbsp;
  <input type="text" class="form-control" name="id" id="id"></span>
</div>
<div class="col p-3">
  <span class="input-group-text">Product Name : &nbsp;
  <input type="text" class="form-control" name="product_name" id="product_name"></span>
</div>
<div class="col p-3">
  <span class="input-group-text">Product Color : &nbsp;
  <input type="text" class="form-control"  name="color_name" id="color_name"></span>
</div>
<div class="col p-3">
  <span class="input-group-text">Stock IN : &nbsp;
  <input type="text" class="form-control"  name="stock_in" id="stock_in"></span>
</div>
<div class="col p-3">
  <span class="input-group-text">Defective : &nbsp;
  <input type="text" class="form-control"  name="defective" id="defective"></span>
</div>
<hr class="w-100 pe-1">
<div class="col p-3">
  <h1 class="fs-5 fw-bold">Feature Images :</h1>
  <span class="input-group-text"> &nbsp;
  <input type="file" class="form-control"  name="fimg" id="fimg"></span>
  <p class="m-3 text-danger fs-5">Note : Photo must be transperent and 400*400 pixel image</p>
</div>
<div class="col p-3">
  <h1 class="fs-5 fw-bold">Display Images :</h1>
  <span class="input-group-text"> &nbsp;
  <input type="file" class="form-control"  name="dimg" id="dimg" multiple></span>
  <p class="m-3 text-danger fs-5">Note : Select atmost 8 photos</p>
</div>
<div class="col-12 text-center">
<button type="submit" class="btn btn-danger"  name="pVarientSubmit" id="pVarientSubmit">Submit</button>
</div>
</div>  
</div>
</form>
<script>
$('#pVarientSubmit').click(function(){
  // alert("Clicked");
  var id = $('#id').val(); 
  var product_name = $('#product_name').val(); 
  var color_name = $('#color_name').val(); 
  var stock_in = $('#stock_in').val(); 
  var defective = $('#defective').val(); 
  var fimg = $('#fimg').val(); 
  var dimg = $('#dimg').val(); 
  if(id=="" || product_name=="" || color_name=="" || stock_in=="" || defective=="" || fimg=="" || dimg==""){
    alert("Please Fill The Field");
    return false; 
  }
else
  {
    $.ajax({
      url:"library/database.php",
      method:"POST",
      data:{id:id,product_name:product_name,color_name:color_name,stock_in:stock_in,defective:defective,fimg:fimg,dimg:dimg},
      success:function(data)
      {
      alert("ok");
      }
    });
  }
});
</script>
<?php include "footer.php"; ?>
