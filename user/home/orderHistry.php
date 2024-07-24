<?php include "header.php"; ?>
<!--<script>-->
<!--    $("#colpsCustom").click(function(){-->
<!--        alert("clicked");-->
<!--       $("#accordionSidebar").hide();-->
<!--    });-->
<!--</script>-->
<div class="topbar  pt-3 mb-2" style="background: red;"><a class="btn"><i class="bi bi-list p-3 text-white" id="colpsCustom"></i></a><span class="text-white p-3 fw-bold mt-3">Order
        History</span>
</div>
<div  style="overflow:auto;" class="font_size_in_mobile">
    <table id="table_id" class="display">
        <thead>
            <tr>
                <th scope="col">S.N</th>
                <th scope="col">Order Date</th>
                <th scope="col">Product</th>
                <th scope="col">Color</th>
                <th scope="col">Qty</th>
                <th scope="col">Price</th>
                <th scope="col">Order Status</th>
            </tr>
        </thead>
        <tbody>
            <input type="hidden" id="userEmail" value="<?php echo $_SESSION['email']; ?>">
            <?php
            $userEmail = $_SESSION['email'];
            ?>
            <?php
//             $orderHistry = "SELECT ch.`id`,`email`,p.`product_name`, `color_name`, ch.`cart_id`, ch.`product_v_id`, ch.`quantity`, ch.`modify_date`,ch.`rate`, ch.`discount`, ch.`total`, ch.`dpd_id`,ch.`display`, ch.`remarks` FROM `checkouts` ch
// INNER JOIN cart on ch.cart_id = cart.id
// INNER JOIN productvariant pv on ch.product_v_id = pv.id
// INNER JOIN products p on pv.product_id = p.id
// INNER JOIN colors c on pv.color_id = c.id
// INNER JOIN delivery_payment_details dpd on dpd.id=ch.dpd_id
// INNER JOIN users u ON u.id = cart.user_id WHERE email ='$userEmail' and (dpd.delivery_status='pending' or dpd.delivery_status='processing');";

// This query  is written by bikesh kumar gupta 
// This query  is written by bikesh kumar gupta 
$orderHistry = "SELECT ch.`id`,`refID`,`email`,p.`product_name`, `color_name`, ch.`cart_id`, ch.`product_v_id`, ch.`quantity`, ch.`modify_date`,ch.`rate`, ch.`discount`, ch.`total`, ch.`dpd_id`,ch.`display`, ch.`remarks` FROM `checkouts` ch
INNER JOIN cart on ch.cart_id = cart.id
INNER JOIN productvariant pv on ch.product_v_id = pv.id
INNER JOIN products p on pv.product_id = p.id
INNER JOIN colors c on pv.color_id = c.id
INNER JOIN delivery_payment_details dpd on dpd.id=ch.dpd_id
INNER JOIN delevarydetails refID on refID.id = c.id 
INNER JOIN users u ON u.id = cart.user_id WHERE email ='$userEmail' and (dpd.delivery_status='pending' or dpd.delivery_status='processing');";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $orderHistry) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
                $i = 1;
                while ($data = mysqli_fetch_assoc($req)) {
            ?>
            <tr>
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <?php echo $data['modify_date']; ?>
                </td>
                <td>
                    <?php echo $data['product_name']; ?>
                </td>
                <td>
                    <?php echo $data['color_name']; ?>
                </td>
                <td>
                    <?php echo $data['quantity']; ?>
                </td>
                <td>
                    <?php echo $data['total']; ?>
                </td>
                <td><button type="button" class="btn btn-secondary getID" 
                data-order_id="<?php echo $data['id']; ?>"
                data-cancel_order_refID = "<?php echo $data['refID']; ?>"
                data-order_product_name = "<?php echo $data['product_name']; ?>"
                data-order_color_name = "<?php echo $data['color_name']; ?>"
                data-order_quantity = "<?php echo $data['quantity']; ?>"
                data-order_total = "<?php echo $data['total'];?>"
                
                value="<?php echo $data['display'] == "1"?$data['id']:""; ?>" <?php echo $data['display'] == "1" ? '' : 'disabled'; ?>>  <?php echo $data['display'] == "1"?"Cancel":"Cancelled"; ?></button></td>
            </tr>
            <?php
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php include "footer.php" ?>

<script>
$(document).ready(function(){
    $('.getID').click(function(){
        var idValue = $(this).attr('value');
        var userEmail = "<?php echo isset($userEmail) ? $userEmail : ''; ?>";
        var button = $(this); 
        var confirmation = confirm("Are you sure you want to cancel the order?");
        if (confirmation) {
            var orderCancel = {
                id: idValue, 
                userEmail: userEmail
            };
            
            $.ajax({
                url: 'order_cancel.php', 
                type: 'POST',
                dataType: 'text',
                data: orderCancel,
                success: function(response) {
                    alert(response);
                    button.closest('td').html('<button type="button" class="btn btn-secondary" disabled>Cancelled</button>');
                },
                error: function(xhr, status, error) {
                    alert('Error canceling order: ' + xhr.responseText);
                }
            });
        }
    });
    
// Api integration part for cancel order from here 
// Api integration part for cancel order from here
$(".getID").click(function(){
   var getOrder_id =  $(this).attr('data-order_id');
   var getCancel_order_refID = $(this).attr('data-cancel_order_refID');
   var getOrder_quantity = $(this).attr('data-order_quantity');
   var getOrder_total = $(this).attr('data-order_total');

   // Concatenate the variables to display in an alert
   alert('getOrder_id: ' + getOrder_id +
         '\n getCancel_order_refID:' + getCancel_order_refID +
         '\n getOrder_quantity: ' +   getOrder_quantity +
         '\n getOrder_total: ' +  getOrder_total);
         
   var cancelOrderDetailsArray = [];
   cancelOrderDetailsArray.push({
      "PCode": getOrder_id,
      "Qty": getOrder_quantity,
      "TotalAmt": getOrder_total
   });
         
   const cancelOrderDetails = {
      "DbName": "erpdemo101",
      "UserCode": "oms",
      "Remarks": "Confirm",
      "GLCode": "50",
      "Lat": "10001",
      "Lng": "10001",
      "orderNo": getCancel_order_refID,
      "BToBorderDetails": cancelOrderDetailsArray
   };
    
   const apiUrl = 'cancel_order_api_process.php';

   $.ajax({
      url: apiUrl,
      type: 'POST',
      contentType: 'application/json',
      data: JSON.stringify(cancelOrderDetails),
      success: function(response, status, xhr) {
         // Display success message in an alert along with status code
         alert('Order cancel successfully! Status Code: ' + xhr.status);
      },
      error: function(xhr, status, error) {
         $('#response').html('Error cancel order: ' + xhr.responseText);
         alert('Error cancel order: ' + xhr.responseText);
      }
   });
});

// Api integration part for cancel order from here 
// Api integration part for cancel order from here 
});
</script>