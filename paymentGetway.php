z<!-- script   -->
<!-- script   -->
<!--<button type="button" id="esewaPayIT" data-refID="ult-01-02" data-amt="500">-->
    <!--Check-->
</button>
<?php
if (isset($_SESSION['email'])) {
     '<div class="text-danger"> This is ' . $_SESSION['email'] . '<br></div>';
    if ($_SESSION['email'] != '') {
         ($_SESSION['login_status'] = 1);
    } else {
         ($_SESSION['login_status'] = 0);
    }
} else {
     ($_SESSION['login_status'] = 0);
}
$sessionEmial = $_SESSION['email'];
$sql = "SELECT `id`, `username`, `email`, `phone` FROM `users` WHERE `email` ='$sessionEmial';";
// echo $sql;
$conn = connectDB();
$req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$username = "";
$phone = "";
if (mysqli_num_rows($req) > 0) {
    while ($data = mysqli_fetch_assoc($req)) {
        $username = $data['username'];
        $phone = $data['phone'];
        // echo $username;
        // echo $phone;
    }
}
?>
<script>
    $(function () {
        $("#continue_payment").on("click", function () {
            // alert("clicked");
            var full_name = $("#full_name").val();
            var phone = $("#phone_num").val();
            var province = $("#province").val();
            var district = $("#district").val();
            var nonloginemail = $("#nonloginemail").val();
            // var city = $("#city").val();
            var municipality = $("#municipality").val();
            var tole = $("#tole").val();
            // alert(phone + ',' + province + ',' + district + ',' + municipality + ',' + tole);
            if (full_name == '' || phone == '' || province == '' || district == '' || municipality == '' || tole == '' || nonloginemail == '') {
                alert("To proceed, Please do not leave any field empty, Thank you.");
            }
            else {
                $(this).parent().css("display", "none");
                $("#Payment").css("display", "block");
            }
        });


        $(".check_out_btn").on("click", function () {
            var full_name = $("#full_name").val();
            var cart_id = $("#cart_id").attr("data-cart_id");//data-cart_id kata ko ho => header ma xa 
            // alert(cart_id);
            var province = $("#province").val();
            var district = $("#district").val();
            var nonloginemail = $("#nonloginemail").val();
            // var city = $("#city").val();
            var municipality = $("#municipality").val();
            var tole = $("#tole").val();
            var phone = $("#phone_num").val();
            var payment_mode = $(this).attr("data-payment_mode");
            var hasCouponID = $("#hasThisCouponID").val();
            // alert("hasCouponID : "+hasCouponID);
            var products_to_checkout = '';
            //product details
            var i = 1;
            $(".checkout_products_list").each(function () {//checkout_products_list class kata ko ho
                var product_v_id = $(this).attr("data-pv_id");
                var quantity = $(this).attr("data-quantity");
                if (i == 1) {
                    products_to_checkout = product_v_id + '#' + quantity;
                }
                else {
                    products_to_checkout = products_to_checkout + ',' + product_v_id + '#' + quantity;
                }
                i++;
                // console.log(products_to_checkout);
            });
            if (products_to_checkout == '') {
                alert("Please do not leave any field empty to proceed, Thank you.");
            }
            else {
                var proceed_checkout = 'proceed_checkout';
                // alert('processing.....');
                // alert('details are: ' + products_to_checkout);
                $.ajax({
                    url: "assets/library/productCartControl.php",
                    method: "POST",
                    data: { proceed_checkout: proceed_checkout, full_name: full_name, cart_id: cart_id, province: province, district: district, municipality: municipality, tole: tole, phone: phone, payment_mode: payment_mode, products_to_checkout: products_to_checkout, nonloginemail: nonloginemail,hasCouponID:hasCouponID },
                    success: function (data) {
                        console.log(data);
                        var da = JSON.parse(data);
                        // console.log(da.status_code);
                        if (da.status_code == '200') {
                            var amt = da.receivable_amt;
                            amt = Math.round(amt);
                            console.log(amt);
                            $("#grand_total").val(0);
                            console.log(da.payBy);
                            var refCode=da.reference_code;
                            $("#cashONDelevary").modal('hide');
                            var url="https://kantipurfeed.com/invoice_print.php?refID="+refCode;
                            $("#refCode").attr("href",url);
                            $('.selected_item').fadeOut("slow", function() {$(this).remove();giveIndex();});
                            if(da.payBy=='cash_on_delivery'){
                            setTimeout(gotoInvoice, 1000);}
                            else if(da.payBy=='esewa'){
                                // alert ('eSewa');
                                payByEsewa(refCode,amt);
                            }
                            $("#check_out_btn").attr("disabled", "disabled");
                            // $("#copyRefCode").click();
                            // location.reload();
                        }
                        else {
                            alert('not ok');
                        }
                    },
                    error: function (er) {
                        console.log(er);
                    }
                });
            }
        });
        
        $("#province").change(function () {
            var province = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'assets/library/productCartControl.php',
                data: { give_district_from_server: province },
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    if (da.status_code == '200') {
                        $("#district").empty();
                        $("#district").append('<option value="">Choose..</option>');
                        jQuery.each(da.address, function (i, district) {
                            var dis = district.district;
                            dis = dis.toUpperCase();
                            $("#district").append('<option value="' + dis + '" >' + dis + '</option>');
                        });
                    }
                    else {
                        $("#district").empty();
                        $("#district").append('<option value="">Choose..</option>');
                    }
                }
            });
        });

        $("#district").change(function () {
            var district = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'assets/library/productCartControl.php',
                data: { give_municipality_from_server: district },
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    if (da.status_code == '200') {
                        $("#municipality").empty();
                        $("#municipality").append('<option value="">Choose..</option>');
                        jQuery.each(da.address, function (i, municipality) {
                            var muni = municipality.municipality;
                            muni = muni.toUpperCase();
                            $("#municipality").append('<option value="' + muni + '" >' + muni + '</option>');
                        });
                    }
                    else {
                        $("#municipality").empty();
                        $("#municipality").append('<option value="">Choose..</option>');
                    }
                }
            });
        });
        
        function gotoInvoice(hasRefID){
            var url="https://kantipurfeed.com/invoice.php?refID="+hasRefID;
            $("#refCode").attr("href",url);
            // window.open(url, '_blank');
            // setTimeout($("#refCode").click(),2000);
        }

        function giveIndex(){
            var i = 1;
            $('.indexing').each(function(){
               $(this).text(i);
               i++;
            });
        }
        // giveIndex();
        function gotoInvoice(){
            $('#copyModal').modal('show');
        }
        
        function eSewaPay(refID){
            $.ajax({
                    url: "assets/library/productCartControl.php",
                    method: "POST",
                    data: { eSewaPay: refID},
                    success: function (data) {
                        // console.log(data);
                        var da = JSON.parse(data);
                        // console.log(da.status_code);
                        if (da.status_code == '200') {
                            var refCode=da.reference_code;
                            var url="https://kantipurfeed.com/invoice.php?refID="+refCode;
                            $("#refCode").attr("href",url);
                            setTimeout(gotoInvoice, 2000);
                        }
                        else {
                            alert('not ok');
                        }
                    },
                    error: function (er) {
                        console.log(er);
                    }
                });
        }
        
$("#esewaPayIT").click(function(){
    var refID=$(this).attr('data-refID');
    var amt=$(this).attr('data-amt');
    alert (refID+'this is amt'+amt);
    payByEsewa(refID,amt);
})

function payByEsewa(refID,amt){
    var pid = refID;
    // alert("working"+pid);
    var path="https://uat.esewa.com.np/epay/main";
    var params= {
        amt: amt,
        psc: 0,
        pdc: 0,
        txAmt: 0,
        tAmt: amt,
        pid: pid,
        scd: "EPAYTEST",
        su: "https://ultimanepal.com/eSewa/main/success.php",
        fu: "https://ultimanepal.com/eSewa/main/failed.php"
    }
    console.log(path);
    post(path, params);
}
function post(path, params) {
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", path);

    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }

    document.body.appendChild(form);
    form.submit();
}
// payByEsewa('utuyu-4345','45223');
    });   
</script>
<!-- script   -->
<!-- script   -->
<!-- cash on delivery -->
<!-- cash on delivery -->
<div class="modal fade" id="cashONDelevary" style="width:100%;" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-3"><img src="assets/images/deli-logo.png" alt="" class="w-25"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    id="close_checkout_btn"></button>
            </div>
            <div class="row modal-body">
                <div class="col text-center">
                    <div class="mb-3">
                        <div class="mt-2"><span class="fw-bold fs-5">Full Name</span></div>
                    </div>
                    <div>
                        <span class="col-12 input-group-text" id="basic-addon1">
                            <input id="full_name" name="full_name" type="text" placeholder="Username"
                                class="form-control w-100 text-center text-bold" style="background-color: white;"
                                value="<?php echo $username ?>"></span>
                    </div>
                    <div class="mb-3">
                        <div class="mt-2"><span class="fw-bold fs-5">Mobile Number</span></div>
                    </div>
                    <div>
                        <span class="input-group-text">
                            <span>+977</span>
                            <span>|</span>
                            <input type="text" class="form-control w-100" id="phone_num" placeholder="Phone Number"
                                maxlength="10" minlength="10"
                                onkeypress="return event.charCode>=48 && event.charCode<=57" ondrop="return false"
                                pattern="[9]{1}[6-8]{1}[0-2,4-8]{1}[0-9]{7}" style="background-color:white !important;"
                                value="<?php echo $phone ?>">
                    </div>
                    <!-- email added -->
                    <!-- email added -->
                    <div class="mb-3">
                        <div class="mt-2"><span class="fw-bold fs-5">Email:</span></div>
                    </div>
                    <div>
                        <span class="input-group-text">
                            <input type="email" class="form-control w-100 text-center" placeholder="Email Address"
                                id="nonloginemail" name="nonloginemail"
                                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,3}$" value="<?php echo $sessionEmial ?>">
                    </div>
                    <!-- email added -->
                    <!-- email added -->
                    <div id="address">
                        <div class="mt-3"><span class="fw-bold fs-5">Delivery Address</span></div>
                        <div class="row">
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">Province : &nbsp;
                                    <select class="form-select text-center" id="province" name="province">
                                        <option selected value=''>CHOOSE..</option>
                                        <?php
                                        $query = "SELECT DISTINCT `province` FROM `address`;";
                                        $conn = connectDB();
                                        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                        if (mysqli_num_rows($req) > 0) {
                                            while ($data = mysqli_fetch_assoc($req)) {
                                                $province = strToUpper($data["province"]); ?>
                                        <option value="<?Php echo $province; ?>">
                                            <?Php echo $province; ?>
                                        </option>
                                        <?php
                                            }
                                        } ?>
                                    </select>
                                </span>
                            </div>
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">District : &nbsp;
                                    <select class="form-select text-center" id="district" name="district">
                                        <option selected value=''></option>
                                    </select>
                                </span>
                            </div>

                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">Municipality : &nbsp;
                                    <select class="form-select text-center" id="municipality" name="municipality">
                                        <option selected value=''></option>
                                    </select>
                                </span>
                            </div>
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">Chowk/Tole :
                                    <input id="tole" name="tole" type="text" class="form-control w-100 text-end"
                                        style="background-color: white;"></span>
                            </div>
                            <div class="text-center col-5 my-1">
                                <button type="button" class="btn btn-primary" id="continue_payment">Continue <i
                                        class="bi bi-arrow-right"></i></button>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mt-2 mb-2">
                        <i class="bi bi-cart3 fw-bold fs-5 ms-2"></i>
                        <span class="ms-3"> Order Summery</span>
                    </div>
                    <div class="col-12" style="overflow-y: scroll; height: 100px;" id="products_being_checked_out">
                    </div>
                    <footer>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div><span>SumTotal : </span></div>
                            <div style="text-align:end;"><span id="grand_total_amt">Rs.</span></div>
                        </div>
                        <!--<div class="d-flex justify-content-between">-->
                        <!--    <div><span>Copon Discount : </span></div>-->
                        <!--    <div style="text-align:end;"><span id="coupen_discount">----</span></div>-->
                        <!--</div>-->
                        <div class="d-flex justify-content-between">
                            <div><span>Shipping : </span></div>
                            <div><span>To be calculated</span></div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-5">
                            <div><span class="fw-bold">To Pay : </span></div>
                            <div style="text-align:end;"><span class="fw-bold">Rs.<input type="number" value="0"
                                        style="background:transparent;width:40%;border:0;" readonly
                                        id="grand_total_calculated"></span></div>
                        </div>
                        <div>
                                    <input type="hidden" value='0' id="hasThisCouponID">
                            <!--<div class="col-12 d-flex">-->
                            <!--    <div class="col-3">-->
                            <!--        <img src="assets\images\paymentgetways\coupon.png" alt="" class="w-100"-->
                            <!--            style="transform: rotate(305deg);">-->
                            <!--    </div>-->
                            <!--    <div class="col-8">-->
                            <!--        <input type="text" id="hasCouponID" class="form-control w-100" placeholder="Discount Code"-->
                            <!--            style="border: 2px dotted;">-->
                            <!--        <button class="btn btn-primary p-1" type="button" id="validateCoupon" style="margin-top:1rem;width:100%;">Apply Coupon</button>-->
                            <!--        <small><div id="copuonMessage" class="text-red"></div></small>-->
                            <!--    </div>-->
                            <!--</div>-->
                        </div>
                    </footer>
                </div>
            </div>
            <div class="col-12" id="Payment" style="display:none;">
                <div class="mt-2"><span class="fw-bold fs-5">Payment</span></div>
                <div class="mb-2">
                    <div class="container text-center row">
                        <div class="col col-md-2 me-2 card check_out_btn" data-payment_mode="cash_on_delivery">
                            <button id="cash_on_delivery" style="background:none;border:0;">
                                <img src="assets\images\paymentgetways\cash.png" class="w-100">
                                <span>Cash On Delevary</span></button>
                        </div>
                        <div class="col col-md-2 me-2 card check_out_btn" data-payment_mode="esewa"><button type="button" id="payeSewa"
                                style="background:none;border:0;"> <!--onclick="alert('Feature available soon !!!');" -->
                                <img src="assets\images\paymentgetways\esewa.png" class="w-100">
                                <span>Esewa</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cash on delivery -->
<!-- cash on delivery -->
<script>
    $(document).ready(function(){
// api integration part api integration part api integration part api integration part 
// api integration part api integration part api integration part api integration part
$("#cash_on_delivery").click(function() {
    // alert("i am click button !!!");
    var grandTotalAmt = 0;
    var orderDetailsArray = [];
    $(".checkout_item:checked").each(function() {
        var dataProductCode = $(this).data("product_code");
          alert(dataProductCode);
        var quantity = parseInt($(this).data("product_quantity"));
          alert(quantity);
        var rate = parseFloat($(this).data("product_price"));
          alert(rate);
        var unitTotal = quantity * rate;
        grandTotalAmt += unitTotal;
          alert(grandTotalAmt);

        orderDetailsArray.push({
            "PCode": dataProductCode,
            "Qty": quantity,
            "Rate": rate,
            "TotalAmt": unitTotal
        });
    });

    const orderDetails = {
        "DbName": "erpdemo101",
        "UserCode": "oms",
        "Remarks": "Confirm",
        "GLCode": "50",
        "Lat": "10001",
        "Lng": "10001",
        "BToBorderDetails": orderDetailsArray
    };

   const apiUrl = 'order_processing.php';

    $.ajax({
        url: apiUrl,
        type: 'POST',
        contentType: 'application/json',
        data: JSON.stringify(orderDetails),
         success: function(response, status, xhr) {
            // Display success message in an alert along with status code
            alert('Order placed successfully! Status Code: ' + xhr.status);
        },
        error: function(xhr, status, error) {
            $('#response').html('Error placing order: ' + xhr.responseText);
            alert('Error placing order: ' + xhr.responseText);
        }
    });
});
// api integration part api integration part api integration part api integration part 
// api integration part api integration part api integration part api integration part 
    });
</script>
