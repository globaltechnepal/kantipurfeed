<?php include "../header.php" ?>
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
  <div class="p-1 mb-2 col-3 bg-dark text-white text-center">Checkout List</div>
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
      $CheckoutQry = "SELECT dpd.`id` as dpdID,dpd.`full_name`,dpd.`province`, dpd.`district`, dpd.`municipality`, dpd.`tole`, dpd.`phone`, dpd.`cart_id`, dpd.`payment_mode`, dpd.`payment_status`, dpd.`delivery_status`, dpd.`deliverd_by`, dpd.`deliverd_on`, dpd.`reference_no`, dpd.`modify_date`, dpd.`remarks`, ps.`remarks` as payment_remarks FROM `delivery_payment_details` dpd
INNER JOIN checkouts on dpd.id=checkouts.dpd_id
LEFT JOIN paymentstatus ps on ps.refID = dpd.reference_no
where checkouts.display=1
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
         <?php 
         $payment_remarks=$data['payment_remarks']; 
         $payment_status_is=strtoupper($data['payment_status']); 
         if ($payment_remarks ==""){
         echo '<div class="form-check form-switch"><input class="form-check-input toggle_payment paymentSwitch" data-refID="'.$data['reference_no'].'" data-bs-toggle="modal" data-bs-target="#paymentStatus" style="border-color: transparent;" type="checkbox" role="switch" data-ref_code="'. $data['reference_no'].' ">';
         } 
         if($payment_remarks !=""){
                echo '<div><a class="payment_view_record" data-my_ref_code='.$data['reference_no'].' data-bs-toggle="modal" data-bs-target="#paymentStatusPersondetail"><i class="bi bi-eye-fill" style="color:green; margin-start:0" title="View Details"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;'; 
              }
         ?>
            <label class="form-check-label lbl_payment">
              <?php echo strtoupper($data['payment_status']); ?>
            </label>
          </div>
        </td>
        <td>
          
              <?php $status_is=strtoupper($data['delivery_status']); if ($status_is=="PROCESSING" ||$status_is=="PENDING")
              { echo '<div class="form-check form-switch"><input class="form-check-input toggle_delivery" data-refID="'.$data['reference_no'].'" data-bs-toggle="modal" data-bs-target="#deliveryStatus" style="border-color: transparent;" type="checkbox" role="switch" data-ref_code="'.$data['reference_no'].'">'; } 
              else{
                echo '<div><a class="view_record" data-my_ref_code='.$data['reference_no'].' data-bs-toggle="modal" data-bs-target="#deliveryPersondetail"><i class="bi bi-eye-fill" style="color:green; margin-start:0" title="View Details"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;'; 
              }?>
            <label class="form-check-label lbl_delivery">
              <?php echo strtoupper($data['delivery_status']); ?>
            </label>
          </div>
        </td>
        <td>
          <a class="CheckoutDetails" data-bs-target="#contactDisplay" href="#contactDisplay" data-bs-toggle="modal"
            data-an-id="<?php echo $data['dpdID']; ?>" data-an-name="<?php echo $data['full_name']; ?>"
            data-an-phone="<?php echo $data['phone']; ?>" data-an-province="<?php echo $data['province']; ?>"
            data-an-district="<?php echo $data['district']; ?>"
            data-an-reference_no="<?php echo $data['reference_no']; ?>"
            data-an-municipality="<?php echo $data['municipality']; ?>" data-an-tole="<?php echo $data['tole']; ?>">
            <i class="bi bi-eye-fill" style="color:green" title="View Details"></i></a>
            <a href="invoiceReport.php?refID=<?php echo $data['reference_no'] ?>" target="_blank" class="col-2 me-2 d-none d-sm-inline-block text-primary shadow-sm" ><i class="bi bi-printer-fill"></i></a >
            <?php $delivery_status_is=strtoupper(trim($data['delivery_status'])); $payment_status_is=strtoupper(trim($data['payment_status'])); if ($delivery_status_is=="DISPATCHED" && $payment_status_is=="PAID"){
            echo '<a class="d-none d-sm-inline-block text-success shadow-sm close_data_btn" data-ref_id='.$data['reference_no'] .' data-dpd='.$data['dpdID'] .' id="close_data_btn" data-bs-toggle="modal" data-bs-target="#deliveryClose"><i class="bi bi-cart-check-fill"></i></a>';} ?>
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

<!-- contact form -->
<!-- contact form -->
<script>
$(".close_data_btn").click(function () {// button class where button clicked
    var refID = $(this).attr("data-ref_id"); //attribute from button data-category
    $("#refIDaa").attr("value", refID.trim());
    var dpd = $(this).attr("data-dpd"); 
    $("#cartIDaa").attr("value", dpd.trim());
});
    $(document).on('click',"#checkoutClosebtn",function(){
    var refId = $("#refIDaa").val();
    var cartId = $("#cartIDaa").val();
    var nameAdm = $("#nameAdm").val();
    var closeDate = $("#closeDate").val();
    var closeRemarks = $("#closeRemarks").val();
    if(refId==""||nameAdm==""||closeDate==""||closeRemarks==""){
        alert("Form field are empty.");
        alert(cartId);
    }
    else{
        $.ajax({
          url: '../library/checkoutcontrol.php',
          type: 'POST',
          data: { close_checkout_transaction: refId,nameAdm:nameAdm,cartId:cartId,closeDate:closeDate,closeRemarks:closeRemarks},
          datatype: 'JSON',
          success: function (data) {
              console.log(data);
              location.reload();
          }   
        });
    }
    });
    
    
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
      url: '../library/checkoutcontrol.php',
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
</script>
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

<!-- payment status -->
<!-- payment status -->
<div class="modal fade" id="paymentStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="p-1 mb-2 bg-dark text-white text-center">Payment Detail</div>
        <div class="row input-group mb-3">
            <span class="col input-group-text ms-2 me-2" id="basic-addon1">Payment Received Mode :
            <select class="form-select" aria-label="Default select example" id="paymentMethod">
                  <option value="esewa">E-sewa</option>
                  <option value="cashondelevary">Cash on Delivery</option>
                  <!--<option value="khalti">Khalti</option>-->
            </select>
           </span>
            <input type="hidden" id="refreID">
             <input type="hidden" id="amount">
            <span class="col input-group-text" id="basic-addon1">Transaction Date :
            <input type="datetime-local" class="form-control" id="transDate" name="transDate"></span>
        </div>
        
        <div class="row input-group mb-3">
            <span class="col input-group-text me-2" id="basic-addon1">Transaction Code :
            <input type="text" class="form-control" id="transCode" name="transCode"></span>
             <span class="col input-group-text" id="basic-addon1">Transaction Amount :
            <input type="text" class="form-control" id="transAmt" name="transAmt"></span>
        </div>
        <div class="row input-group mb-3">
            <span class="col input-group-text" id="basic-addon1">Remarks :
            <input type="text" class="form-control" id="transRemark" name="transRemark"></span>
        </div>
      </div>
      <div class="col-12 mb-2">
        <button type="button" class="btn btn-primary text-center col-2" id="paymentSubmit" name="paymentSubmit">Submit</button>
        <button type="button" class="btn btn-secondary col-1 unckeck_btn" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- payment status -->
<!-- payment status -->

<!-- delivery status -->
<!-- delivery status -->
<div class="modal fade" id="deliveryStatus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="p-1 mb-2 bg-dark text-white text-center">Delivery Detail</div>
        
        <div class="row input-group mb-3">
            <span class="col input-group-text ms-2 me-2" id="basic-addon1">Courier Name :
            <input type="text" class="form-control" id="courierName" name="courierName"></span>
             <span class="col input-group-text" id="basic-addon1">Consignment No :
            <input type="text" class="form-control" id="consignmentNo" name="consignmentNo"></span>
        </div>
        
        <div class="row input-group mb-3">
            <span class="col input-group-text ms-2 me-2" id="basic-addon1">Consignment Date :
            <input type="datetime-local" class="form-control datepickgar" id="consignmentDate" name="consignmentDate"></span>
             <span class="col input-group-text" id="basic-addon1">Contact Person :
            <input type="text" class="form-control" id="contactPerson" name="contactPerson"></span>
        </div>
        
        <div class="row input-group mb-2">
            <span class="col input-group-text ms-2 me-2" id="basic-addon1">Mobile No :
            <input type="text" class="form-control" id="mobileNo" name="mobileNo" maxlength="10" minlength="10" onkeypress="return onlyNumberKey(event)" ></span>
             <span class="col input-group-text" id="basic-addon1">Remarks :
            <input type="text" class="form-control" id="remarks" name="remarks"></span>
            <input type="hidden" id="refID">
        </div>

      </div>
      <div class="col-12 mb-2">
        <button type="button" class="btn btn-primary text-center col-2" id="deliverySubmit" name="deliverySubmit">Submit</button>
        <button type="button" id="" class="btn btn-secondary col-1 unckeck_btn" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>
function giveDate(){
    var d=new Date();
    var year = d.getFullYear();
    var month = d.getMonth();
    if(month<10){
        month++;
        month='0'+month;
    }else{
        month++;
    }
    var day = d.getDate();
    var hrs = d.getHours();
    var min = d.getMinutes();
    // alert(year);
    // alert(month);
    // alert(day);
    // alert(hrs);
    // alert(min);
    return year+'-'+month+'-'+day+'T'+hrs+':'+min;
}

 $(".toggle_payment").click(function () {
            $(this).parent().addClass('add_new_controls');
            $(this).addClass('click_this_btn_while_close');
             var rID = $(this).attr("data-refID");
            $("#refreID").attr("value", rID.trim());
        });
        $(".toggle_delivery").click(function () {
            $("#consignmentDate").attr('max',giveDate());
            $("#transDate").attr('max',giveDate());
            $(this).parent().addClass('add_new_controls');
            $(this).addClass('click_this_btn_while_close');
            // $(this).next().find(".lbl_delivery").addClass('new_lable');
            var refID = $(this).attr("data-refID");
            $("#refID").attr("value", refID.trim());
        });

$("#paymentSubmit").click(function(){
var refides = $("#refreID").val();
var htm = '<a class="payment_view_record" data-my_ref_code='+refides+'><i class="bi bi-eye-fill" style="color:green; margin-start:0" title="View Details"></i></a><label class="form-check-label lbl_payment"> &nbsp;&nbsp;&nbsp;&nbsp; PAID</label>';
var paymentMethod = $("#paymentMethod").val();
// var transDate = $("#transDate").val();
// var transDate = $("#transDate").attr('max');
// var transDate = "28/04/2024";
   var transDate = $("#transDate").val();
var transCode = $("#transCode").val();
var transAmt = $("#transAmt").val();
var transRemark = $("#transRemark").val();
var amount = $("#amount").val();
alert(refides + '' + paymentMethod + '' + transDate + '' + transAmt + '' + amount + '' + transRemark);
if(refides==""|| paymentMethod==""|| transDate==""|| transCode==""|| transAmt==""|| transRemark==""){
    alert("Please fill the form properly");
    }
if(amount!=transAmt){
 alert("Enter amount and transaction amount doesn't match");   
}
    else{
        $.ajax({
    url: '../library/checkoutcontrol.php',
    type: 'POST',
    data: {
        insert_payment_status_detail: refides,
        paymentMethod: paymentMethod,
        transDate: transDate,
        transCode: transCode,
        transAmt: transAmt,
        transRemark: transRemark
    },
    dataType: 'JSON',
    success: function (data) {
        var da = JSON.parse(data);
        if (da.status_code === 200) {
            alert("Success");
            $(".add_new_controls").empty();
            $(".add_new_controls").append(htm);
            $(".add_new_controls").removeClass('form-check');
            $(".add_new_controls").removeClass('form-switch');
            $(".add_new_controls").removeClass('add_new_controls');
            $(".uncheck_btn").click();
        }
    }
});

    }
});

$(document).on('click',".paymentSwitch",function(){
    var refIDForpayment_amt = $(this).attr("data-refID");
   $.ajax({
       url: '../library/checkoutcontrol.php',
       type: 'POST',
       data: {get_payment_amount:refIDForpayment_amt},
       datatype: 'JSON',
       success: function (data) {
           console.log(data);
           var da = JSON.parse(data);
          var a = da.amount;
          $("#transAmt").val(a);
           $("#amount").val(a);
        //   console.log(a);
       }
   });
});


$(document).on('click',".payment_view_record",function(){
    var refIDForpayment = $(this).attr("data-my_ref_code");
    $.ajax({
       url: '../library/checkoutcontrol.php',
       type: 'POST',
       data: {get_payment_detail:refIDForpayment},
       datatype: 'JSON',
       success: function (data) {
           
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
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Date :</span> <span>'+transactionCode+'</span></div>';
              html += '</div>';
              html += '<div class="row">';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Code :</span> <span>'+transactionAmt+'</span></div>';
              html += '<div style="background-color: #ddd;" class="col mb-2 me-2"><span>Transaction Amount :</span> <span>'+transactionDate+'</span></div>';
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
       url: '../library/checkoutcontrol.php',
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

// $(document).ready(function(){
function onlyNumberKey(evt) {
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
    return false;
    return true;
}

$(document).on('click',".unckeck_btn",function(){
    // alert('clicked');
   $(".click_this_btn_while_close").click(); 
   $(".add_new_controls").removeClass('add_new_controls'); 
   $(".click_this_btn_while_close").removeClass('click_this_btn_while_close'); 
});

        $("#deliverySubmit").click(function(){
            var refNo = $("#refID").val();
            var htm = '<a class="view_record" data-my_ref_code='+refNo+'><i class="bi bi-eye-fill" style="color:green; margin-start:0" title="View Details"></i></a><label class="form-check-label lbl_delivery"> &nbsp;&nbsp;&nbsp;&nbsp; DISPATCHED</label>';
            var courierName = $("#courierName").val();
            var consignmentNo = $("#consignmentNo").val();
            var consignmentDate = $("#consignmentDate").val();
            // var consignmentDate = $("#consignmentDate").attr('max');
            var contactPerson = $("#contactPerson").val();
            var mobileNo = $("#mobileNo").val();
            var remarks = $("#remarks").val();
            alert(
    'Reference Number: ' + refNo + '\n' +
    'Courier Name: ' + courierName + '\n' +
    'Consignment No: ' + consignmentNo + '\n' +
    'Consignment Date: ' + consignmentDate + '\n' +
    'Contact Person: ' + contactPerson + '\n' +
    'Mobile No: ' + mobileNo + '\n' +
    'Remarks: ' + remarks
              );

            if(courierName==""||consignmentNo==""||consignmentDate==""||contactPerson==""||mobileNo==""||remarks==""){
                alert("Please fill the form properly");
            }
            else{
                $.ajax({
                    url: '../library/checkoutcontrol.php',
                    type: 'POST',
                    data: {
                    // deliveryDetails:1,
                    courierName:courierName,
                    refNo:refNo,
                    consignmentNo:consignmentNo,
                    consignmentDate:consignmentDate,
                    contactPerson:contactPerson,
                    mobileNo:mobileNo,
                    remarks:remarks
                    },
                    datatype: 'JSON',
                    success: function (data) {
                      console.log(data); 
                      location.reload();
                    //   var da = JSON.parse(data);
                    //   if(da.status_code==200){
                    //       $(".add_new_controls").empty();
                    //       $(".add_new_controls").append(htm);
                    //       $(".add_new_controls").removeClass('form-check');
                    //       $(".add_new_controls").removeClass('form-switch');
                    //       $(".add_new_controls").removeClass('add_new_controls');
                    //       $(".unckeck_btn").click();
                    //     //   $(".replace_this_btn").next(".lbl_delivery").text("DISPATCHED");
                    //   }
                    },
                    // error: function (jqXHR, textStatus, errorThrown) { alert("fail"); console.log(errorThrown); }
                });
            }
        });
</script>
<!-- delivery status -->
<!-- delivery status -->

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


<!--close checkout and convert into delivery detail -->
<!--close checkout and convert into delivery detail -->
<div class="modal fade" id="deliveryClose" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body m-2">
           <div class="p-1 mb-2 bg-dark text-white text-center">Delivery Close Form</div>
          <div class="row input-group mb-3">
            <input type="hidden" id="refIDaa">
            <input type="hidden" id="cartIDaa">
            <span class="col input-group-text ms-2 me-2" id="basic-addon1">Name :
            <input type="text" class="form-control" id="nameAdm"></span>
             <span class="col input-group-text" id="basic-addon1">Date :   
            <input type="text" class="form-control" id="closeDate" value="<?php echo date(("Y/m/d")) .'&nbsp;'. date("h:i:sa"); ?>" readonly></span>
        </div>
        <div class="row input-group mb-3">
            <span class="col input-group-text ms-2 me-2" id="basic-addon1">Remarks :
            <input type="text" class="form-control" id="closeRemarks"></span>
        </div>
        <div>
              <button type="button" class="btn btn-primary text-center col-2" id="checkoutClosebtn" name="checkoutClosebtn">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!--close checkout and convert into delivery detail -->
<!--close checkout and convert into delivery detail -->
<?php
include '../footer.php';
?>