<?php include "header.php"; ?>
<div class="col-6 d-flex">
  <div class="p-1 mb-2 col-5 bg-dark text-white text-center">Vendor Checkout List</div>
</div>

<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th>S.N</th>
      <th>Order Date</th>
      <th>User Type</th>
      <th>Company Name</th>
      <th>Contact</th>
      <th>No.of Product Order</th>
      <th>Order Status</th>
      <th>Action</th>
    </tr>
  </thead>
    <tbody>
    <?php 
    function action_completed($checkoutID,$vendor_email,$order_Status,$orderDispatch,$orderDeliver){
        if($order_Status==1){
            // return order confirm done logo
             echo '<i class="bi bi-cart-check-fill text-success fw-bold"></i>';
        }
        if($orderDispatch!=null){
            //return dispatch done logo
            echo '<i class="bi bi-card-checklist text-success ps-2"></i>';
        }
        if($orderDeliver!=null){
            echo '<i class="bi bi-truck text-success ps-2"></i>';
        }
    }//for order status    
    
    
    function action_controler($checkoutID,$vendor_email,$order_Status,$orderDispatch,$orderDeliver){
        if($order_Status==0){
            // return order confirm pannel
            echo '<a href="#" class="ms-2 orderConfirm" data-checkoutID="'.$checkoutID.'"  data-checkoutEmail="'.$vendor_email.'" style="text-decoration:none; color:black;"><i class="bi bi-cart"></i></a>';
        }else{
            if($orderDispatch==null){
                //return dispatch panel
                echo'<a class="dispbtn" data-maxval="'.give_total_receivable_amt($checkoutID).'" href="#" data-checkoutId="'.$checkoutID.'" data-bs-toggle="modal" data-bs-target="#dispatchModal" style="text-decoration:none; color:black;"><i class="bi bi-card-checklist"></i></a>';
            }else{
                if($orderDeliver==null){
                    //return delivered panel
                    $due=give_due_amt($checkoutID);
                    echo '<a class="deliverBtn" data-due_amt="'.$due.'" href="#" data-checkoutID="'.$checkoutID.'"  data-vendorEmail="'.$vendor_email.'" data-bs-toggle="modal" data-bs-target="#deliverModal" style="text-decoration:none; color:black;"><i class="bi bi-truck"></i></a>';
                }else{
                    //return all action completed button to remove it from list.
                    echo '<a href="#" class="orderclosed" data-close-checkoutID="'.$checkoutID.'"  data-close-vendorEmail="'.$vendor_email.'"><i class="bi bi-archive" style="text-decoration:none; color:black;"></i><a>';
                }
            }
        }
    }//for action 

        $checkoutID = '';
        // $query_checkoutQry = "SELECT `id` as checkoutID, `vendor_email`, `order_confirmed`,`product_count`, `order_place_date` FROM `vendor_checkout` ";
         $query_checkoutQry = "SELECT vendor_checkout.`id` as checkoutID, vendor_checkout.`vendor_email`,`user_type`,`vendor_contact`, `vendor_company_name`, `product_count`,
         `order_confirmed`, `order_place_date`,`order_dispatched_date`, `order_delivered_date` FROM `vendor_checkout` inner JOIN  vendor_users ON vendor_users.vendor_email = vendor_checkout.vendor_email WHERE vendor_checkout.archived=0;";
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
      <td><?php echo $data_show['vendor_contact'] ?></td>
      <td><?php echo $data_show['product_count'] ?></td>
      <td><?php action_completed($checkoutID,$vendor_email,$order_Status,$orderDispatch,$orderDeliver); ?></td>
      <!--to see order product-->
      <td><a href="#" style="text-decoration:none; color:black;" data-maxval="<?php echo give_total_receivable_amt($data_show['checkoutID']); ?>" data-checkoutID="<?php echo $data_show['checkoutID'] ?>" data-checkoutEmail="<?php echo $vendor_email; ?>"><i class="bi bi-eye toggleBtn"></i></a>
      <!--to see order product-->
      <?php action_controler($checkoutID,$vendor_email,$order_Status,$orderDispatch,$orderDeliver) ?>
     <a href="vendor_invoiceReport.php?ref=<?php echo $vendor_email; ?>& id=<?php echo $checkoutID; ?>" target="blabk"><i class="bi bi-printer text-primary"></i></a> 
     </td>
     
    </tr>
    <tr class="childTable">
        <td></td>
        <td colspan="6">
         <table class="table">
              <thead>
                <tr>
                  <th >S.N</th>
                  <th >Product</th>
                  <th >Quantity</th>
                  <th >Price</th>
                  <th>Discount</th>
                  <th>Total</th>
                  <th >Image</th>
                </tr>
              </thead>
                <tbody>
                    <?php 
                         $query = "SELECT  `vendor_checkout_items`.`id`,`product_name`, `vendor_checkout_id`,`product_id`, `order_quantity`,`img_path`, `primary_image`, `sales_rate`, `total_amt`,`discountAmount`, `total_after_discount` FROM `vendor_checkout_items`
                          INNER JOIN products on products.id = vendor_checkout_items.product_id WHERE `vendor_checkout_id` ='$checkoutID';";
                         $conn = dbConnecting();
                        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                        if (mysqli_num_rows($req) > 0) {
                            $j = 1;
                            while ($data = mysqli_fetch_assoc($req)) {
                    ?>
                <tr>
                  <td><?php echo $j; ?></td>
                  <td><?php echo $data['product_name']; ?></td>
                  <td><?php echo $data['order_quantity']; ?></td>
                  <td><?php echo intval($data['total_amt']); ?></td>
                  <td><?php echo intval($data['discountAmount']); ?></td>
                  <td><?php echo intval($data['total_after_discount']); ?></td>
                  <td class="col-1"><img src="data:image/jpeg;base64,<?php echo $data['primary_image'];  ?>" class="w-100" onerror="this.onerror=null; this.src='../../product-icon.png';"></td>
                </tr>
                    <?php
                    $j++;
                        }
                        }
                    ?>
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

<!--delivery model-->
<script>
    $(".deliverBtn").click(function(){
    var checkoutId = $(this).attr("data-checkoutID"); //attribute from button data-category
    var due = $(this).attr("data-due_amt"); //attribute from button data-category
    $("#checkoutIddeliver").attr("value", checkoutId.trim());
    $("#checkoutIddeliver").attr("data-dueAmt", due.trim());
    $("#dueMsg").text("Due : "+due);
    var vEmail = $(this).attr("data-vendorEmail"); //attribute from button data-category
    $("#vendorEmail").attr("value", vEmail.trim());
    }); 
</script>
<div class="modal fade" id="deliverModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
          <div class="p-1 mb-2 bg-dark text-white text-center">Delivery Detail</div>
         <div class="row">
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Delivery Mode : &nbsp;
                <input type="text" class="form-control" id="deliveryModeThro"></span>
            </div>
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Dispatch No : &nbsp;
                <input type="text" class="form-control" id="dispatchNumber"></span>
            </div>
        </div>
        <div class="row">
            <div class="col input-group mb-2">
                <span class="input-group-text col-12" id="basic-addon1">Delivered On : &nbsp;
                <input type="date" class="form-control" id="deliveredOn"></span>
            </div>
            <div class="col input-group mb-2">
                <div style="position: absolute;z-index: 1;left: 20%;font-size: 0.8rem;top: -35%;" id="dueMsg">Total:</div>
                <span class="input-group-text col-12" id="basic-addon1">Amount: &nbsp;
                <input type="text" class="form-control" id="AmountReceive"></span>
            </div>
        </div>
        <div class="row">
            <div class="col input-group mb-2">
                <span class="input-group-text col-12" id="basic-addon1">Remarks: &nbsp;
                <input type="text" class="form-control" id="deliveryremarks"></span>
            </div>
            <span class="text-success mb-3">Note: 
            <ul>
                <li>Dispatch Number must match.</li>
                <li>If there is any change. Please, describe it in remarks.</li>
            </ul>
            </span>
        </div>
        <input type="hidden" id="checkoutIddeliver">
        <input type="hidden" id="vendorEmail">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="deliveryBtn">Submit</button>
      </div>
    </div>
  </div>
</div>


<!--Dispatch Modal -->
<script>
    $(".dispbtn").click(function(){
    var checkId = $(this).attr("data-checkoutId"); //attribute from button data-category
    var maxval = $(this).attr("data-maxval"); //attribute from button data-category
    $("#checkoutId").attr("value", checkId.trim());
    $("#checkoutId").attr("data-maxVal", maxval.trim()); //data-maxVal
    var msg="Total : "+maxval;
    $(".totalMsg").text(msg);
    $("#dispatchBtn").attr("data-total_amt",maxval);
    }); 
</script>
<div class="modal fade" id="dispatchModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
          <div class="p-1 mb-2 bg-dark text-white text-center">Delivery Detail</div>
         <div class="row">
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Delivery Mode : &nbsp;
                <input type="text" class="form-control" id="deliveryMode"></span>
            </div>
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Dispatch No : &nbsp;
                <input type="text" class="form-control" id="dispatchNum"></span>
            </div>
        </div>
        <input type="hidden" id="checkoutId">
        <div class="row">
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Contact Person :  &nbsp;
                <input type="text" class="form-control" id="contactPerson"></span>
            </div>
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Mobile No : &nbsp;
                <input type="text" class="form-control numberOnly" id="contactNum"></span>
            </div>
        </div>
        <div class="row">
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Payment Mode : &nbsp;
                <select class="form-select" aria-label="Default select example" id="paymentMode">
                  <option class="seletcOptio">Select</option>
                  <option value="Bank">Bank</option>
                  <option value="Cash on Delivery">Cash on Delivery</option>
                </select>
                <!--<input type="text" class="form-control" id="paymentMode">--></span>
            </div>
            <div class="col input-group mb-3">
                <div style="position: absolute;z-index: 1;right: 20%;font-size: 0.8rem;top: 90%;" class="totalMsg">Total:</div>
                <span class="input-group-text col-12" id="basic-addon1">Amount :  &nbsp;
                <input type="text" class="form-control numberOnly" id="amount" ></span>
            </div>
        </div>
        <div class="row">
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Dispatch Date :  &nbsp;
                <input type="date" class="form-control" id="dispatchDate"></span>
            </div>
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Remarks :  &nbsp;
                <input type="text" class="form-control" id="remarks"></span>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="dispatchBtn">Submit</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $("#paymentMode").click(function(){
      $(".seletcOptio").hide();  
    });
    
    
    $(document).on('click','.orderclosed',function(){
      var checkoutID = $(this).attr('data-close-checkoutID');
        var vendorEmail = $(this).attr('data-close-vendorEmail');
          var  admEmail = "<?php echo $_SESSION['adminemail']; ?>";
          if(confirm("Are you sure you want to colse the order?")){
         if(checkoutID==""||vendorEmail==""||admEmail==""){
           alert("Fill the form");
        }
        else{
            $.ajax({
            url: "library/vendorControl.php",
            method: "POST",
            data: {orderclosed:checkoutID,vendorEmail:vendorEmail,admEmail:admEmail},
            success: function (data) {
                console.log(data);
                var da = JSON.parse(data);
                if(da.status_code==200){
                    location.reload();
                }
                else if(da.status_code!=200){
                    alert(da.message);
                }
            }
          });
        }
        }
    });
    
    $(document).on('click','#deliveryBtn',function(){
        if(parseInt($("#AmountReceive").val())>parseInt($("#checkoutIddeliver").attr('data-dueAmt'))){
            alert ("Amount entered is greater than due value, please check and try again.");
        }else{
        var adminemail = '<?php echo $_SESSION['adminemail']; ?>';
        var vendorEmail = $("#vendorEmail").val();
        var checkoutIddeliver = $("#checkoutIddeliver").val();
        var deliveryModeThro = $("#deliveryModeThro").val();
        var dispatchNumber = $("#dispatchNumber").val();
        var deliveredOn = $("#deliveredOn").val();
        var deliveryremarks = $("#deliveryremarks").val();
        var AmountReceive = $("#AmountReceive").val();
        if(vendorEmail==""||checkoutIddeliver==""||deliveryModeThro==""||dispatchNumber==""||deliveredOn==""||deliveryremarks==""){
            alert("Please fill the form properly.");
        }
        else{
            $.ajax({
            url: "library/vendorControl.php",
            method: "POST",
            data: {delivery_completed:vendorEmail,adminemail:adminemail,checkoutIddeliver:checkoutIddeliver,deliveryModeThro:deliveryModeThro,dispatchNumber:dispatchNumber,deliveredOn:deliveredOn,deliveryremarks:deliveryremarks,AmountReceive:AmountReceive},
            success: function (data) {
                console.log(data);
                var da = JSON.parse(data);
                if(da.status_code==200){
                    location.reload();
                }
                else if(da.status_code!=200){
                    alert(da.message);
                }
            }
          });
        }
        }
    });
    
    $(document).on('click','#dispatchBtn',function(){
        var maxval=$(this).attr('data-total_amt');
        if(parseInt($("#amount").val())>parseInt(maxval)){
            //amount is greater then receivable
            alert ('Amount is greater than receibable amount. i.e. = '+maxval);
        }else{
            //hit request
              var userDispatch = "<?php echo $_SESSION['adminemail'] ?>";
               var dispatchNum = $("#dispatchNum").val();
                var dispatchDate = $("#dispatchDate").val();
                 var deliveryMode = $("#deliveryMode").val();
                  var contactPerson = $("#contactPerson").val();
                   var contactNum = $("#contactNum").val();
                    var paymentMode = $("#paymentMode").val();
                     var amount = $("#amount").val();
                      var checkout_id = $("#checkoutId").val();
                       var remarks = $("#remarks").val();
                   if(userDispatch==""||dispatchDate==""||deliveryMode==""||checkout_id==""||contactPerson==""||contactNum==""||paymentMode==""||remarks==""){
                       alert("Please fill all the form properly");
                   }
                    else{
                    $.ajax({
                    url: "library/vendorControl.php",
                    method: "POST",
                    data: {insert_dispatch_info:userDispatch,dispatchNum:dispatchNum,dispatchDate:dispatchDate,deliveryMode:deliveryMode,contactPerson:contactPerson,contactNum:contactNum,paymentMode:paymentMode,amount:amount,checkout_id:checkout_id,remarks:remarks},
                    success: function (data) {
                        console.log(data);
                        var da = JSON.parse(data);
                        if(da.status_code==200){
                            location.reload();
                        }
                        else if(da.status_code!=200){
                            alert(da.message);
                        }
                    }
                  });
               }
        }
           
    });
    
    $(".orderConfirm").click(function(){
       var checkoutID = $(this).attr('data-checkoutID'); 
       var checkoutEmail = "<?php echo $_SESSION['adminemail'] ?>";
      if(confirm("Did you confirmed order ?")){
       if(checkoutID==""||checkoutEmail==""){
       alert("Fill the form properly.");
       }
       else{
            $.ajax({
            url: "library/vendorControl.php",
            method: "POST",
            data: {order_confirmation:checkoutID,checkoutEmail:checkoutEmail},
            success: function (data) {
                console.log(data);
                var da = JSON.parse(data);
                if(da.status_code==200){
                    location.reload();
                }
                else if(da.status_code!=220){
                    
                }
                else{
                   
                }
            }
          });
       }
    }
    });

    $(".childTable").css("display", "none");
    $(".toggleBtn").click(function(){
      $(this).parent().parent().parent().next('.childTable').toggle(); 
    });
    
    // only Number
$(".numberOnly").on("keypress", function (e) {
    // console.log(e.which);
 if(e.which >= 48 && e.which <=57 ){
       return true;

    }else{
      alert("Only Numbers are allowed");
      return false;   
    }
  });
    
});

</script>
<?php
include "footer.php" 
?>

    