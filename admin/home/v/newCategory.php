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
<?php include "../footer.php"; ?>