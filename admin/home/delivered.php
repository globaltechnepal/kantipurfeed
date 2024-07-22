<?php 
include "header.php"
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
  <div class="p-1 mb-2 col-3 bg-dark text-white text-center">Delivered List</div>
</div>
<!-- datatable start -->
<!-- datatable start -->
<div class="col-12">
  <table id="table_id" class="display">
    <thead>
      <tr>
        <th>S.N</th>
        <th>Checkout Date</th>
        <th>Contact</th>
        <th>Refrence No.</th>
        <th>Payment Status</th>
        <th>Delevary Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody id="check_out_data">
      <?php
      $CheckoutQry = "SELECT dpd.`id`,dpd.`full_name`,dpd.`province`, dpd.`district`, dpd.`municipality`, dpd.`tole`, dpd.`phone`, dpd.`cart_id`, dpd.`payment_mode`, dpd.`payment_status`, dpd.`delivery_status`, dpd.`deliverd_by`, dpd.`deliverd_on`, dpd.`reference_no`, dpd.`modify_date`, dpd.`remarks`, ps.`remarks` as payment_remarks FROM `delivery_payment_details` dpd
INNER JOIN checkouts on dpd.id=checkouts.dpd_id
LEFT JOIN paymentstatus ps on ps.refID = dpd.reference_no
where checkouts.display=0
ORDER BY modify_date DESC";
      $conn = dbConnecting();
      $req = mysqli_query($conn, $CheckoutQry) or die(mysqli_error($conn));
      if (mysqli_num_rows($req) > 0) {
        $i = 1;
        while ($data = mysqli_fetch_assoc($req)) {
      ?>
      <tr>
        <td>
          <?php echo $i; ?>
        </td>
        <td>
          <?php echo $data['modify_date'] ?>
        </td>
        <td>
          <?php echo $data['phone'] ?>
        </td>
        <td>
          <?php echo $data['reference_no'] ?>
        </td>
        <td>
            <div><a class="payment_view_record" data-my_ref_code='<?php echo $data['reference_no'] ?>' data-bs-toggle="modal" data-bs-target="#paymentStatusPersondetail"><i class="bi bi-eye-fill" style="color:green; margin-start:0" title="View Details"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
             <label class="form-check-label lbl_payment">
              <?php echo strtoupper($data['payment_status']); ?>
            </label>
          </div>
        </td>
        <td>
            <div><a class="view_record" data-my_ref_code='<?php echo $data['reference_no'] ?>' data-bs-toggle="modal" data-bs-target="#deliveryPersondetail"><i class="bi bi-eye-fill" style="color:green; margin-start:0" title="View Details"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
            <label class="form-check-label lbl_delivery">
              <?php echo strtoupper($data['delivery_status']); ?>
            </label>
          </div>
        </td>
        <td>
          <a class="CheckoutDetails" data-bs-target="#contactDisplay" href="#contactDisplay" data-bs-toggle="modal"
            data-an-id="<?php echo $data['id']; ?>" data-an-name="<?php echo $data['full_name']; ?>"
            data-an-phone="<?php echo $data['phone']; ?>" data-an-province="<?php echo $data['province']; ?>"
            data-an-district="<?php echo $data['district']; ?>"
            data-an-reference_no="<?php echo $data['reference_no']; ?>"
            data-an-municipality="<?php echo $data['municipality']; ?>" data-an-tole="<?php echo $data['tole']; ?>">
            <i class="bi bi-eye-fill" style="color:green" title="View Details"></i></a>
            <a href="invoiceReport.php?refID=<?php echo $data['reference_no'] ?>" target="_blank" class="col-2 me-2 d-none d-sm-inline-block text-primary shadow-sm" ><i class="bi bi-printer-fill"></i></a >
           <a class="d-none d-sm-inline-block text-success shadow-sm close_data_btn" data-ref_id='<?php echo $data['reference_no']; ?>'  id="close_data_btn" data-bs-toggle="modal" data-bs-target="#checkoutClosemodel"><i class="bi bi-cart-check-fill"></i></a>
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
<!-- datatable end -->
<!-- datatable end -->


<div class="modal fade ms-5  abcclass" id="contactDisplay" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle2"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:90px;">
    <div class="modal-content p-3">
      <div class="p-3 mb-2 bg-dark text-white text-center">Client Details</div>
      <div class="row">
        <div class="col">
          <span class="input-group-text">Name :&nbsp; <span class="fw-bold" id="namecheckout">
              &nbsp;</span>
        </div>
        <input type="hidden" id="checkoutID">
        <div class="col">
          <span class="input-group-text">Phone Number :&nbsp; <span class="fw-bold" id="phoneCheckout">
              &nbsp;</span>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
          <span class="input-group-text">Province :&nbsp; <span class="fw-bold" id="provinceCheckout"></span></span>
        </div>
        <div class="col">
          <span class="input-group-text">District :&nbsp; <span class="fw-bold" id="districtCheckout"></span></span>
        </div>
      </div>
      <div class="row mt-3">
        <div class="col">
          <span class="input-group-text">Municipality :&nbsp; <span class="fw-bold"
              id="municipalityCheckout"></span></span>
        </div>
        <div class="col">
          <span class="input-group-text">Chowk/Tole :&nbsp; <span class="fw-bold" id="toleCheckout"></span></span>
        </div>
      </div>
      <hr>
      <div class="text-center fw-bold mt-2"><span>Products</span></div>
      <hr>
      <table class="table">
        <thead>
          <tr>
            <th scope="col">S.N.</th>
            <th scope="col">Product</th>
            <th scope="col">Color</th>
            <th scope="col">Quantity <small>(pic)</small></th>
            <th scope="col">Rate</th>
            <th scope="col">Discount</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody id="cart_products">

        </tbody>
      </table>
      <div class="text-end" id="referenceNo">

      </div>
      <div class="col-12 text-end">
       <button type="button" class="btn btn-secondary col-1" data-bs-dismiss="modal">Close</button>
       </div>
    </div>
  </div>
</div>
<!-- contact form -->
<!-- contact form -->



<!--delivery detail -->
<!--delivery detail -->

<div class="modal fade" id="deliveryPersondetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body m-2">
          <div class="mb-2" id="courierDetailhere">
               <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Courier Name :</span> <span><?php echo $courierName ?></span> </div>
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Consignment No :</span> <span><?php echo $consignmentNo ?></span> </div>
               </div>
                <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Consignment Date :</span> <span><?php echo $consignmentDate ?></span> </div>
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Contact Person :</span> <span><?php echo $contactPerson ?></span> </div>
               </div>
                <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Mobile No. :</span> <span><?php echo $mobileNo ?></span> </div>
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Remarks :</span> <span><?php echo $remarks ?></span> </div>
               </div>
       </div>
        <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--delivery detail -->
<!--delivery detail -->

<!--payment detail -->
<!--payment detail -->
<div class="modal fade" id="paymentStatusPersondetail" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body m-2">
          <div class="mb-2" id="paymentStatusHere">
               <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Payment Received Mode :</span> <span></span> </div>
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Date :</span> <span></span> </div>
               </div>
                <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Code :</span> <span></span> </div>
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Amount :</span> <span></span> </div>
               </div>
                <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Remarks :</span> <span></span> </div>
               </div>
       </div>
        <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--payment detail -->
<!--payment detail -->

<script>
$(".CheckoutDetails").click(function () {// button class where button clicked
    var cid = $(this).attr("data-an-id"); //attribute from button data-category
    $("#checkoutID").attr("value", cid.trim());// where to show id

    var cname = $(this).attr("data-an-name");
    $("#namecheckout").text(cname.trim());

    var refNum = $(this).attr("data-an-reference_no");
    // var htm = '<a href="invoiceReport.php?refID=' + refNum.trim() + '" target="_blank" class="col-2 d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" > <i class="fas fa-download fa-sm text-white-50"></i> Print Report</a > ';
    var htm = '';
    $("#referenceNo").empty();
    $("#referenceNo").append(htm);

    var cphone = $(this).attr("data-an-phone");
    $("#phoneCheckout").text(cphone.trim());

    var cprovince = $(this).attr("data-an-province");
    $("#provinceCheckout").text(cprovince.trim());

    var cdistrict = $(this).attr("data-an-district");
    $("#districtCheckout").text(cdistrict.trim());

    var cmunicipality = $(this).attr("data-an-municipality");
    $("#municipalityCheckout").text(cmunicipality.trim());

    var ctole = $(this).attr("data-an-tole");
    $("#toleCheckout").text(ctole.trim());

    var dpd_id = $(this).attr("data-an-id");
    // alert(dpd_id);
    $.ajax({
      url: 'library/checkoutcontrol.php',
      type: 'POST',
      data: { checkedout_items: dpd_id },
      datatype: 'JSON',
      success: function (data) {
        // console.log(data);
        var da = JSON.parse(data);
        // console.log(da);
        if (da.success_code = '200') {
          // alert("ok");
          var html = '';
          var grand_Total = 0;
          jQuery.each(da.data, function (i, val) {
            html += '<tr>';
            html += '<td>' + i + '</td>';
            html += '<td>' + da.data[i].product_name + '</td>';
            html += '<td>' + da.data[i].varient_name + '</td>';
            html += '<td>' + da.data[i].quantity + '</td>';
            html += '<td> Rs.' + da.data[i].rate + '</td>';
            html += '<td> Rs.' + da.data[i].discount + '</td>';
            html += '<td> Rs.' + da.data[i].total + '</td>';
            html += '</tr>';
            var total = parseFloat(da.data[i].total);
            grand_Total = grand_Total + total;
          });
          html += '<tr>';
          html += '<td colspan="6" class="text-end fw-bold"> Grand Total </td>';
          html += '<td class="fw-bold"> Rs.' + grand_Total + '</td>';
          html += '</tr>';
          $("#cart_products").empty();
          $("#cart_products").append(html);
        }
      },
    //   error: function (er) {
    //     console.log(er);
    //   }
    });
  })
    $(document).on('click',".payment_view_record",function(){
    var refIDForpayment = $(this).attr("data-my_ref_code");
    // alert(refIDForpayment);
    $.ajax({
       url: 'library/checkoutcontrol.php',
       type: 'POST',
       data: {get_payment_detail:refIDForpayment},
       datatype: 'JSON',
       success: function (data) {
           console.log(data);
          alert(data);
           var da = JSON.parse(data);
            var payment_received_Mode ='';
            var transactionCode ='';
            var transactionAmt='';
            var transactionDate ='';
            var remarks ='';
            jQuery.each(da.paymentstatus, function (i, da) {
                payment_received_Mode= da.payment_received_Mode;
                transactionCode = da.transactionCode;
                transactionAmt = da.transactionAmt;
                transactionDate = da.transactionDate;
                remarks = da.remarks;
            });
              var html = '';
              html += '<div class="row">';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Payment Received Mode :</span> <span>'+payment_received_Mode+'</span></div>';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Date :</span> <span>'+transactionDate+'</span></div>';
              html += '</div>';
              html += '<div class="row">';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Code :</span> <span>'+transactionCode+'</span></div>';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Amount :</span> <span>'+transactionAmt+'</span></div>';
              html += '</div>';
              html += '<div class="row">';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Remarks :</span> <span>'+remarks+'</span> </div>';
              html += '</div>';
              $("#paymentStatusHere").empty();
            $("#paymentStatusHere").append(html);
            $("#paymentStatusPersondetail").modal('show');
       }
    });
});


$(document).on('click',".view_record",function(){
    var refIDHo = $(this).attr("data-my_ref_code");
   $.ajax({
       url: 'library/checkoutcontrol.php',
       type: 'POST',
       data: {get_delivery_detail:refIDHo},
       datatype: 'JSON',
       success: function (data) {
           console.log(data);
            var da = JSON.parse(data);
            var courierName ='';
            var consignmentNo ='';
            var consignmentDate='';
            var contactPerson ='';
            var mobileNo ='';
            var remarks ='';
            jQuery.each(da.delevarydetails, function (i, da) {
                courierName= da.courierName;
                consignmentNo = da.consignmentNo;
                consignmentDate = da.consignmentDate;
                contactPerson = da.contactPerson;
                mobileNo = da.mobileNo;
                remarks = da.remarks;
            });
              var html = '';
              html += '<div class="row">';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Courier Name :</span> <span>'+courierName+'</span></div>';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Consignment No :</span> <span>'+consignmentNo+'</span></div>';
              html += '</div>';
              html += '<div class="row">';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Consignment Date :</span> <span>'+consignmentDate+'</span></div>';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Contact Person :</span> <span>'+contactPerson+'</span></div>';
              html += '</div>';
              html += '<div class="row">';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Mobile No. :</span> <span>'+mobileNo+'</span></div>';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Remarks :</span> <span>'+remarks+'</span> </div>';
              html += '</div>';
              $("#courierDetailhere").empty();
            $("#courierDetailhere").append(html);
            $("#deliveryPersondetail").modal('show');
       }
   });
});

$(".close_data_btn").click(function(){
    var ref_id = $(this).attr("data-ref_id");
    // alert(ref_id);
    $.ajax({
       url: 'library/checkoutcontrol.php',
       type: 'POST',
       data: {get_delivery_close_detail:ref_id},
       datatype: 'JSON',
       success: function (data) {
           console.log(data);
           var da = JSON.parse(data);
           var conform_by ='';
           var confirmdate ='';
           var remarks ='';
            jQuery.each(da.deliveryconfirmed, function (i, da) {
                conform_by=da.conform_by;
                // alert(conform_by);
                confirmdate = da.confirmdate;
                remarks=da.remarks;
            });
              var html = '';
              html += '<div class="row"><div style="background-color: #ddd;" class="col mb-2 me-2"><span>Name :</span> <span value="'+conform_by+'">'+conform_by+'</span></div><div style="background-color: #ddd;" class="col mb-2 me-2"><span>Date :</span> <span>'+confirmdate+'</span> </div></div>'
              html += '<div class="row"><div style="background-color: #ddd;" class="col mb-2 me-2"><span>Remarks :</span> <span>'+remarks+'</span> </div></div>';
              $("#checkoutClose").empty();
            $("#checkoutClose").append(html);
            $("#checkoutClosemodel").modal('show');
       }
    });
});
</script>

<!--closed by detail -->
<!--closed by detail -->
<div class="modal fade" id="checkoutClosemodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body m-2">
          <div class="mb-2" id="checkoutClose">
               <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Name :</span> <span></span> </div>
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Date :</span> <span></span> </div>
               </div>
                <div class="row">
                   <div style="background-color: #ddd;" class="col mb-2 me-2"><span>Remarks :</span> <span></span> </div>
               </div>
       </div>
        <div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--closed by detail -->
<!--closed by detail -->
<?php 
include "footer.php"
?>