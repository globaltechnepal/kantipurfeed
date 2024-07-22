<?php include 'header.php'; ?>
<!--<div class="col-6 d-flex">-->
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
    <div class="p-1 mb-2 col-1 bg-dark text-white text-center text-uppercase text-gray-800">Users</div>
  </div>
<!--</div>-->
<table id="table_id" class="display ps-2">
  <thead>
    <tr>
      <th>S.N.</th>
      <th>Username</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <!-- datatable start -->
    <!-- datatable start -->
    <?php
$query = "SELECT `username`, `email`, `user_image_path`, `user_img` FROM `users`";
$conn = dbConnecting();
$req = mysqli_query($conn, $query) or die(mysqli_error($conn));
if (mysqli_num_rows($req) > 0) {
  $i = 1;
  while ($data = mysqli_fetch_assoc($req)) { ?>

    <tr>
      <td>
        <?php echo $i; ?>
      </td>
      <td>
        <?php echo $data['username']; ?>
      </td>
      <td>
        <?php echo $data['email']; ?>
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

<?php include "footer.php"; ?>