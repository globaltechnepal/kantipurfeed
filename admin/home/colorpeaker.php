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
  <div class="col-12 d-flex mb-2">
    <div class=" bg-dark text-white text-center p-2  text-uppercase">Color List</div>
    <button type="button" class="btn btn-outline-secondary ms-3" data-bs-target="#exampleModalToggle"
      href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button>
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr>
        <th>S.N.</th>
        <th>Color</th>
        <th>Color Name</th>
        <th>Code</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $myQuery = "SELECT `id`, `color_name`, `color_code`, `remarks` FROM `colors` order by id desc";
      $conn = dbConnecting();
      $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
      if (mysqli_num_rows($req) > 0) {
        $i = 1;
        while ($data = mysqli_fetch_assoc($req)) { ?>
      <tr>
        <td>
          <?php echo $i ?>
        </td>
        <td style="background-color:<?php echo $data['color_code'] ?>;width:10px;"></td>
        <td>
          <?php echo $data['color_name'] ?>
        </td>
        <td>
          <?php echo $data['color_code'] ?>
        </td>
        <td>
          <a class="text-danger text-center delete_item" data-del_item_id="<?php echo $data['id'] ?>" data-del_item_name="color"><i class="bi bi-trash-fill"></i></a>
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

<!-- add new color -->
<!-- add new color  -->
<div class="modal ms-5 ps-5" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Add FAQs</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="row p-3 m-2" style="border:1px solid">
          <div class="col-md-auto text-center">
            <span class="input-group-text" id="basic-addon1">Color Name : &nbsp;
              <input type="text" class="form-control" id="clrName" name="clrName">
            </span>
          </div>
          <div class="col text-center">
            <span class="input-group-text" id="basic-addon1">Color Code : &nbsp;
              <input type="color" class="form-control" id="clrCode" name="clrCode">
            </span>
          </div>
          <div class="mt-3">
            <input class="btn btn-danger" type="button" value="Submit" id="submitColor">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  // $('#submitColor').on("click", function ()---------------now in footer section-----------------------
</script>

<!-- add new color -->
<!-- add new color  -->

<?php include "footer.php"; ?>