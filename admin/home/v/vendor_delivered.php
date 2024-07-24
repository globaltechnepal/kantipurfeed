<?php include "../header.php"; ?>
<div class="col-6 d-flex">
  <div class="p-1 mb-2 col-5 bg-dark text-white text-center">Vendor Checkout Completed List</div>
</div>

<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th>S.N</th>
      <th>Order Date</th>
      <th>User Type</th>
      <th>Company Name</th>
      <th>No.of Product Order</th>
      <th>Amount Receivable</th>
      <th>View Detail</th>
       <th>Remarks</th>
    </tr>
  </thead>
    <tbody>
    <?php 
        $checkoutID = '';
         $query_checkoutQry = "SELECT vendor_checkout.`id` as checkoutID, vendor_checkout.`vendor_email`,`user_type`, `vendor_company_name`, `product_count`,`process_completed`,
         `order_confirmed`, `order_place_date`,`order_dispatched_date`, `order_delivered_date`,vendor_checkout.`remarks`,
(SELECT sum(`total_amt`) FROM `vendor_checkout_items` WHERE `vendor_checkout_id`=vendor_checkout.`id` )
-
(SELECT `pay_amt` FROM `vendor_delivery_record` WHERE `checkout_id`=vendor_checkout.`id` ) as receivables FROM `vendor_checkout` inner JOIN  vendor_users ON vendor_users.vendor_email = vendor_checkout.vendor_email where `vendor_checkout`.archived='1';;";
        $conn = dbConnecting();
        $req_checkout = mysqli_query($conn, $query_checkoutQry) or die(mysqli_error($conn));
        if (mysqli_num_rows($req_checkout) > 0) {
            $i = 1;
            while ($data_show = mysqli_fetch_assoc($req_checkout)) {
                 $checkoutID = $data_show['checkoutID'];
                 $order_Status=$data_show['order_confirmed'];
                 $orderDispatch = $data_show['order_dispatched_date'];
                 $orderDeliver = $data_show['order_delivered_date'];
                 $vendor_email=$data_show['vendor_email'];
    ?>
    <tr>
      <td><?php echo $i; ?></td>
      <td><?php echo $data_show['order_place_date'] ?></td>
      <td><?php echo $data_show['user_type'] ?></td>
      <td><?php echo $data_show['vendor_company_name'] ?></td>
      <td><?php echo $data_show['product_count'] ?></td>
      <td><?php echo $data_show['receivables']; ?></td>
      <td><a href="#" style="text-decoration:none; color:black;" data-checkoutID="<?php echo $data_show['checkoutID'] ?>" data-checkoutEmail="<?php echo $vendor_email; ?>"><i class="bi bi-eye toggleBtn"></i>
      <a href="vendor_invoiceReport.php?ref=<?php echo $vendor_email; ?>& id=<?php echo $checkoutID; ?>" target="blabk"><i class="bi bi-printer text-primary"></i></a> 
      </td>
      <td class="remarksClass"><a data-bs-toggle="modal" data-bs-target="#remarks"><i class="bi bi-chat-dots"></i></a><div style="display:none;" class="thisremarks" ><?php echo $data_show['remarks']; ?></div>
      </td>
    </tr>
    <tr class="childTable">
        <td></td>
        <td colspan="6 m-auto">
         <table class="table">
              <thead>
                <tr>
                  <th >S.N</th>
                  <th >Product</th>
                  <th >Price</th>
                  <th >Quantity</th>
                  <th >Price(Before Discount)</th>
                  <th >Discount</th>
                  <th >Total</th>
                  <th >Image</th>
                </tr>
              </thead>
                <tbody>
                    <?php 
                         $query = "SELECT  `vendor_checkout_items`.`id`,`product_name`, `vendor_checkout_id`,`product_id`,`discountAmount`, `total_after_discount`, `order_quantity`,`img_path`, `primary_image`, `sales_rate`, `total_amt` FROM `vendor_checkout_items`
                          INNER JOIN products on products.id = vendor_checkout_items.product_id WHERE `vendor_checkout_id` ='$checkoutID';";
                         $conn = dbConnecting();
                        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        $sumTotal=0.0;
                        if (mysqli_num_rows($req) > 0) {
                            $j = 1;
                            while ($data = mysqli_fetch_assoc($req)) {
                    ?>
                <tr>
                  <td><?php echo $j; ?></td>
                  <td><?php echo $data['product_name']; ?></td>
                  <td><?php echo intval($data['sales_rate']); ?></td>
                  <td><?php echo $data['order_quantity']; ?></td>
                  <td><?php echo intval($data['total_amt']); ?></td>
                  <td><?php echo intval($data['discountAmount']); ?></td>
                  <td class="totalAfterDis"><?php echo intval($data['total_after_discount']); ?></td>
                  <td class="col-1"><img src="<?php echo '../../'.$data['img_path'].$data['primary_image'];  ?>" class="w-100"></td>
                </tr>
                    <?php
                    $sumTotal=$sumTotal+intval($data['total_after_discount']);
                    $j++;
                        }
                        }
                    ?>
                <tr>
                    <td colspan="6">Total</td>
                    <td class="totalAfterDiscount">Rs:<?php echo $sumTotal; ?></td>
                </tr>
              </tbody>
            </table> 
            </td>
      </tr>
    <?php 
    $i++;
            }
            }
?>
  </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="remarks" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Remarks</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <div id="remarksText"></div>
    </div>
  </div>
</div>
</div>



<script>
    // $(document).on('click','.bi-eye',function(){
    //     let sum = 0;
    //     $('.totalAfterDis').each(function() {
    //         sum += Number($(this).text());
    //     });
    //     $('.totalAfterDiscount').text("Rs. "+sum);
    //  });
    
    
    $(".remarksClass").click(function(){
        var re = $(this).children(".thisremarks").text();
        $("#remarksText").text(re);
    });
    
    $(".childTable").css("display", "none");
    $(".toggleBtn").click(function(){
      $(this).parent().parent().parent().next('.childTable').toggle(); 
    });
</script>
<?php include "../footer.php"; ?>