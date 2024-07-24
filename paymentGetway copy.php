<!-- script   -->
<!-- script   -->
<script>
    $(function () {
        $(".comming_soon_btn").on("click", function () {
            alert("comming Soon");
        })
        $("#continue_payment").on("click", function () {
            // alert("clicked");
            var phone = $("#phone_num").val();
            var province = $("#province").val();
            var district = $("#district").val();
            var city = $("#city").val();
            var municipality = $("#municipality").val();
            var tole = $("#tole").val();
            // alert(phone+','+province+','+district+','+city+','+municipality+','+tole);
            if (phone == '' || province == '' || district == '' || city == '' || municipality == '' || tole == '') {
                alert("To proceed, Please do not leave any field empty, Thank you.");
            }
            else {
                $(this).parent().css("display", "none");
                $("#Payment").css("display", "block");
            }
        });

        $("#cash_on_delivery").on("click", function () {
            var cart_id = $("#cart_id").attr("data-cart_id");//data-cart_id kata ko ho
            var province = $("#province").val();
            var district = $("#district").val();
            var city = $("#city").val();
            var municipality = $("#municipality").val();
            var tole = $("#tole").val();
            var phone = $("#phone_num").val();
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
                console.log(products_to_checkout);
            });
            if (products_to_checkout == '') {
                alert("Please do not leave any field empty to proceed, Thank you. hae");
            }
            else {
                var proceed_checkout = 'proceed_checkout';
                alert('processing.....');
                // alert('details are: '+products_to_checkout);
                $.ajax({
                    url: "assets/library/productCartControl.php",
                    method: "POST",
                    data: { proceed_checkout: proceed_checkout, cart_id: cart_id, province: province, district: district, city: city, municipality: municipality, tole: tole, phone: phone, products_to_checkout: products_to_checkout },
                    success: function (data) {
                        if (data.status_code == '200') {
                            alert('ok');
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
    });   
</script>
<!-- script   -->
<!-- script   -->
<!-- cash on delivery -->
<!-- cash on delivery -->
<div class="modal fade" id="cashONDelevary" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-3"><img src="assets\images\LOGO\logo black.png" alt="compeny_logo" class="w-100"></div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="row modal-body">
                <div class="col text-center">
                    <div class="mb-3">
                        <div class="mt-2"><span class="fw-bold fs-5">Enter Mobile Number</span></div>
                    </div>
                    <div>
                        <span class="input-group-text">
                            <span>+977</span>
                            <span>|</span>
                            <input type="text" class="form-control w-100" id="phone_num" placeholder="Phone Number"
                                maxlength="10" minlength="10"
                                onkeypress="return event.charCode>=48 && event.charCode<=57" ondrop="return false"
                                pattern="[9]{1}[6-8]{1}[0-2,4-8]{1}[0-9]{7}" style="background-color:white !important;"
                                value="9810203040">
                    </div>
                    <div id="address">
                        <div class="mt-3"><span class="fw-bold fs-5">Delivery Address</span></div>
                        <div class="row">
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">Province :
                                    <input id="province" name="province" type="text" class="form-control w-100 text-end"
                                        style="background-color: white;" value="2"></span>
                            </div>
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">District :
                                    <input id="district" name="district" type="text" class="form-control w-100 text-end"
                                        style="background-color: white;" value="Kathmandu"></span>
                            </div>
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">City :
                                    <input id="city" name="city" type="text" class="form-control w-100 text-end"
                                        style="background-color: white;" value="swayambhu"></span>
                            </div>
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">Municipality :
                                    <input id="municipality" name="municipality" type="text"
                                        class="form-control w-100 text-end" style="background-color: white;"
                                        value="Nagarjun"></span>
                            </div>
                            <div class="col-12 input-group my-1">
                                <span class="col-12 input-group-text" id="basic-addon1">Chowk/Tole :
                                    <input id="tole" name="tole" type="text" class="form-control w-100 text-end"
                                        style="background-color: white;" value="Rai Chowk"></span>
                            </div>
                            <div class="text-center col-5 my-1">
                                <button type="button" class="btn btn-primary" id="continue_payment">Continue <i
                                        class="bi bi-arrow-right"></i></button>
                            </div>
                            <div id="Payment" style="display:none;">
                                <div class="mt-2"><span class="fw-bold fs-5">Payment</span></div>
                                <div>
                                    <div class="container text-center row">
                                        <div class="col-4 m-2 card"><button id="cash_on_delivery"
                                                style="background:none;border:0;">
                                                <img src="assets\images\paymentgetways\cash.png" class="w-100">
                                                <span>Cash On Delevary</span></button>
                                        </div>
                                        <div class="col-4 m-2 card"><button
                                                onclick="alert('Feature available soon !!!');"
                                                style="background:none;border:0;">
                                                <img src="assets\images\paymentgetways\esewa.png" class="w-100">
                                                <span>Esewa</span></button>
                                        </div>

                                    </div>
                                    <div class="container row">
                                        <div class="col-4 m-2 card">
                                            <button id="payment-button" style="background:none;border:0;"><img
                                                    src="assets\images\paymentgetways\khalti.png" class="w-100">
                                                <span>Khalti</span></button>
                                        </div>
                                        <div class="col-4 m-2 card"><button
                                                onclick="alert('Feature Available soon !!!');"
                                                style="background:none;border:0;">
                                                <img src="assets\images\paymentgetways\fonepay.png" class="w-100">
                                                <span>Fone Pay</span></button>
                                        </div>
                                    </div>
                                </div>
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
                            <div><span>SubTotal : </span></div>
                            <div style="text-align:end;"><span>Rs.<input type="number" value="0"
                                        style="background:transparent;width:40%;border:0;" readonly
                                        id="grand_total_amt"></span></div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div><span>Copon Discount : </span></div>
                            <div style="text-align:end;"><span>Rs.<input type="number" value="0"
                                        style="background:transparent;width:40%;border:0;" readonly
                                        id="coupen_discount"></span></div>
                        </div>
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
                            <div class="col-12 d-flex">
                                <div class="col-3">
                                    <img src="assets\images\paymentgetways\coupon.png" alt="" class="w-100"
                                        style="transform: rotate(305deg);">
                                </div>
                                <div class="col-8">
                                    <input type="text" class="form-control w-100" placeholder="Discount Code"
                                        style="border: 2px dotted;">
                                </div>
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cash on delivery -->
<!-- cash on delivery -->


<!-- disable menu jquery -->
<!-- disable menu jquery -->

<!-- disable menu jquery -->
<!-- disable menu jquery -->