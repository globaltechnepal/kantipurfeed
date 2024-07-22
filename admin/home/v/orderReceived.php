<?php
include '../header.php';
?>
<style>table.dataTable tbody td {
  padding: 0px 10px !important;
}
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }
</style>
<div class="col-6 d-flex">
  <div class="p-1 mb-2 col-4 bg-dark text-white text-center">Order List</div>
</div>
<!-- datatable start -->
<!-- datatable start -->
<div class="col-12">
  <table id="table_id" class="display">
    <thead>
      <tr>
        <th>S.N</th>
        <th>User</th>
        <th>Product Category</th>
        <th>Product Name</th>
        <th>Color</th>
        <th>Quantity</th>
      </tr>
    </thead>
   <tbody>
  <?php
  $query = "SELECT o.id as orderID, quantity, tmp_id, email, product_name, color_name, category_name 
            FROM orders o 
            INNER JOIN productvariant pv ON pv.id = o.product_variant_id
            INNER JOIN cart crt ON crt.id = o.cart_id
            INNER JOIN users u ON u.id = crt.user_id
            INNER JOIN products p ON p.id = pv.product_id
            INNER JOIN colors clr ON clr.id = pv.color_id
            INNER JOIN category c ON c.category_id = p.category_id
            ORDER BY o.id DESC;";
  // WHERE email != 'sangin@gmail.com' // use this if anonymous users need to be removed

  $conn = dbConnecting();
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_execute($stmt);
  $res = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($res) > 0) {
    $i = 1;
    while ($data = mysqli_fetch_assoc($res)) {
      ?>
      <tr>
        <td><?php echo $i; ?></td>
        <td>
          <?php 
          if ($data['email'] == 'sangin@gmail.com') {
            echo $data['tmp_id'];
          } else {
            echo $data['email'];
          }
          ?>
        </td>
        <td><?php echo $data['category_name']; ?></td>
        <td><?php echo $data['product_name']; ?></td>
        <td><?php echo $data['color_name']; ?></td>
        <td><?php echo $data['quantity']; ?></td>
      </tr>
  <?php
      $i++;
    }
  } else {
    echo "<tr><td colspan='6'>No data available</td></tr>";
  }
  mysqli_stmt_close($stmt);
  ?>
</tbody>
  </table>
</div>
<!-- datatable end -->
<!-- datatable end -->
<?php
include '../footer.php';
?>