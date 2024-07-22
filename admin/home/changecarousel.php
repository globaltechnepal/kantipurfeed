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
  <div class="col-12 d-flex">
    <div class="p-1 mb-2 bg-dark text-white text-center text-uppercase">
      <div>Carousel List</div>
    </div>
    <button type="button" class="btn btn-outline-secondary ms-3 mb-2" data-bs-target="#exampleModalToggle"
      href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button>
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr>
        <th class="col-2">S.N.</th>
        <th class="col-2">Banner</th>
        <th class="col-6">Image</th>
        <th class="col-2">Delete</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $myQuery = "SELECT `id`, `bannerName`, `img_path`, `img` FROM `carousel` order by id desc;";
      $conn = dbConnecting();
      $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
      if (mysqli_num_rows($req) > 0) {
        $i = 1;
        while ($data = mysqli_fetch_assoc($req)) { ?>
      <tr class="text-center">
        <td class="col-2">
          <?php echo $i; ?>
        </td>
        <td class="col-2">
          <?php echo $data['bannerName']; ?>
        </td>
        <td class="col-6 text-center">
          <img src="<?php echo "../../" . $data['img_path'] . $data['img']; ?>" class="w-50" style="height:100px">
        </td>
        <td class="col-2">
          <a type="submit" name="deleteSlide" class="text-danger text-center delete_item" data-del_item_id="<?php echo $data['id']; ?>" data-del_item_name="slide"><i class="bi bi-trash-fill"></i></a>
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

<!-- add new carousel image -->
<!-- add new carousel image -->
<div class="modal ms-5 ps-5" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Carousel Image</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="mb-3 ms-3 me-3 mt-5">
          <div class="mb-3">
            <span class="input-group-text" id="basic-addon1">Banner Name : &nbsp;
              <input type="text" class="form-control" placeholder="Banner Name" id="bannerName"
                name="bannerName"></span>
          </div>
          <div class="mb-3">
            <input class="form-control" onchange="carousel_image()" type="file" id="bannerImg" name="bannerImg">
          </div>
          <button type="button" id="addBanner" class="btn btn-primary ms-3 mb-3">Submit</button>
          <button type="button" class="btn btn-secondary mb-3" data-bs-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- script to add carousel image -->
<!-- script to add carousel image -->
<script>
  $('#addBanner').click(function () {
    var bannerName = $("#bannerName").val();
    var bannerImg = $("#bannerImg").val().replace(/C:\\fakepath\\/i, '');
    if (bannerName == "" || bannerImg == "") {
      alert("Form field are empty. Please fill the form properly");
      return false;
    }
    else {
      $.ajax({
        url: "library/database.php",
        method: "POST",
        data: { bannerName: bannerName, bannerImg: bannerImg },
        datatype: "JSON",
        success: function (data) {
          alert("Carousel Added success");
          $("#bannerName").val('');
          $("#bannerImg").val('')
          location.reload();
        }
      });
    }
  });
</script>
<script>
  async function carousel_image() {
    // alert("i amin");
    let formData = new FormData();
    formData.append("file", bannerImg.files[0]);
    await fetch('library/carousel_image.php', {
      method: "POST",
      body: formData
    });
  }
</script>
<!-- script to add carousel image -->
<!-- script to add carousel image -->

<!-- add new carousel image -->
<!-- add new carousel image -->
<?php include "footer.php"; ?>