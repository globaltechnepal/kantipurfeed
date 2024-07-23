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
      <div>API List</div>
    </div>
    <button type="button" class="btn btn-outline-secondary col-1 ms-3 mb-2" data-bs-target="#exampleModalToggle"
      href="#exampleModalToggle" data-bs-toggle="modal" id="subm"><i class="bi bi-code-slash"></i> Add API</button>
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr style="font-size:13px;">
        <th>S.N.</th>
        <th>Api Name</th>
        <th>Api Value</th>
        <th>Actions</th>
      </tr>
    </thead>
   <tbody>
  <?php
  $myQuery = "SELECT * FROM `api` ORDER BY id DESC;";
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
          <?php echo $data['api_name'] ?>
        </td>
        <td style="font-size:1rem;">
          <?php echo $data['api_value'] ?>
        </td>
        <td>
          <!--<span style="display:flex; justify-content:center;"><a class="text-success" href="#" data-id="<?php echo $data['id']; ?>"><i class="fas fa-edit"></i></a>-->
          <button style="out-line:none; border:none; background:none;"  data-id="<?php echo $data['id'] ?>" data-apiName="<?php echo $data['api_name']; ?>" data-apiValue="<?php echo $data['api_value']; ?>" id="btnUpdate" onClick="btnUpdate" data-bs-toggle="modal" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"><i class="fas fa-edit"></i></button>
       <a name="api_delete" class="text-center ms-2 me-2 text-danger" href="library/api_delete.php?id=<?php echo $data['id']; ?>" onclick="return confirm('Are you sure you want to delete?')">
    <i class="bi bi-trash-fill"></i>
</a>
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
      <div class="p-3 mb-2 bg-dark text-white text-center"> Add API</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
         <input type="text" id="txtid" hidden>
          <div class="input-group mb-3">
            <!-- <span class="input-group-text">C ID</span>
            <input type="text" class="form-control me-2" id="catid" name="catid"> -->
            <span class="input-group-text">Api Name</span>
            <input type="text" class="form-control me-2 clear_Form_data" id="api_name" name="api_name">
          </div>
          <div class="input-group mb-3">
            <span class="input-group-text">Api Value</span>
            <input type="text" class="form-control me-2 clear_Form_data" id="api_value" name="api_value">
          </div>
          <button type="submit" class="btn btn-primary ms-3 mb-3 submitBtn" id="apiSubmit">Submit</button>
          <button type="button" class="btn btn-secondary mb-3 close_called" id="closeSubmit" data-bs-dismiss="modal">Close</button>
           
          <button type="submit" class="btn btn-primary ms-3 mb-3 submitBtn" id="submitBtnU">Update</button>
          <button type="button" class="btn btn-secondary mb-3 close_called" id="closeUpdate" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- add new category -->
<!-- add new product  -->

<!-- Update product -->
<!-- Update product -->
<?php include "../footer.php"; ?>
<script>
    $(document).on('click','#subm',function(e){
                  $("#submitBtnU").hide();
                  $("#closeUpdate").hide();
                  $("#closeSubmit").show();
                  $("#apiSubmit").show();
   });
   $(document).on('click','#btnUpdate',function(e){
        $("#submitBtnU").show();
        $("#closeUpdate").show();
        $("#closeSubmit").hide();
        $("#apiSubmit").hide();
       var id = $(this).attr("data-id");
       var apiName = $(this).attr("data-apiName");
       var apiValue = $(this).attr("data-apiValue");
      $("#txtid").val(id);
      $("#api_name").val(apiName);
      $("#api_value").val(apiValue);
   });
</script>