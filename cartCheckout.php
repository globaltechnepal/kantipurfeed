<?php include 'header.php'; ?>
<!-- add to cart display -->
<!-- add to cart display -->
<div class="bg-white">
    <div class="card container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6" style="overflow-y: scroll; height: 300px;">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="fw-bold fsSize fs-5" scope="col">S.N</th>
                        <th class="fw-bold fsSize fs-5" scope="col">Select All <input class="" type="checkbox" id="check_out_all" style="border: 0.5px solid;border: 1px solid rgba(0,0,0,.25);height: 1em;width: 1em;border-radius: .25em;"></th>
                        <th class="fw-bold fsSize fs-5" scope="col" style="width:8%">Image</th>
                        <th class="fw-bold fsSize fs-5" scope="col-2">Product Name</th>
                        <th class="fw-bold fsSize removeCol fs-5" scope="col">Color</th>
                        <th class="fw-bold fsSize fs-5" scope="col-2">Quantity</th>
                        <th class="fw-bold fsSize fs-5" scope="col">Actual Price</th>
                        <th class="fw-bold fsSize fs-5" scope="col">Sell Price</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conn = connectdb();
                    // $query = "SELECT p.id as p_id,pv.id as pv_id,pv_img.img_path,pv_img.img,p.product_code,p.product_name,clr.color_name,p.actual_Price,p.sell_Price,o.quantity 
                    // from orders o
                    // inner join productvariant pv on o.product_variant_id=pv.id
                    // inner join productvariant_image pv_img on pv_img.product_varient_id=pv.id
                    // inner join products p on pv.product_id=p.id
                    // inner join colors clr on pv.color_id=clr.id
                    // where cart_id=$cart_id order by o.remarks desc;";
                    $query = "

                    SELECT p.id as p_id,pv.id as pv_id,pv_img.img_path,pv_img.img,p.product_code,p.product_name,clr.color_name,p.actual_Price,p.sell_Price,o.quantity 
                                        from orders o
                                        inner join productvariant pv on o.product_variant_id=pv.id
                                        inner join products p on pv.product_id=p.id
                                        inner join colors clr on pv.color_id=clr.id
                                        INNER JOIN productvariant_image pv_img on p.id = pv_img.product_varient_id
                                        where cart_id=$cart_id order by o.remarks desc;";
                    $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                    if ($req == false) {
                        popMsg("Please reload. Connection Lost!!!.");
                    } else if ($req == true) {
                        $i = 1;
                        while ($data = mysqli_fetch_assoc($req)) {
                    ?>
                    <tr>
                        <td scope="row" class="fw-bold hasSN indexing fsSize" data-hasSN="<?php echo $i; ?>">
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input checkout_item" type="checkbox" data-p_id="<?php echo $data['p_id']; ?>" data-product_code="<?php echo $data['product_code']; ?>"
                                    data-pv_id="<?php echo $data['pv_id']; ?>"
                                    data-product_name="<?php echo $data['product_name']; ?>"
                                    data-product_price="<?php echo round($data['sell_Price'], 2); ?>"
                                    data-discounted_value="<?php $disc = $data['actual_Price'] - $data['sell_Price'];
                            echo round($disc, 2); ?>" data-product_quantity="<?php echo $data['quantity']; ?>"
                                    data-product_image="<?php echo $data['img']; ?>">
                            </div>
                        </td>
                        <td class="text-center"><img src="data:image/jpeg;base64,<?php echo $data['img']; ?>"
                                class="w-100"></td>
                        <td class="col-2 fw-bold fsSize">
                            <?php echo $data['product_name']; ?>
                        </td>
                        <td class="fw-bold abc fsSize removeCol">
                            <?php echo $data['color_name']; ?>
                        </td>
                        <td>
                            <div class="d-flex fsSize">
                                <span>
                                    <?php echo $data['quantity']; ?>
                                </span>

                            </div>
                        </td>
                        <td class="fw-bold fsSize"> <span style="text-decoration:line-through;">Rs.
                                <?php echo round($data['actual_Price'], 2); ?>
                            </span></td>
                        <td class="fw-bold fsSize">Rs.
                            <?php echo round($data['sell_Price'], 2); ?>
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
        <footer class="text-center" style="position:relative;">
            <div class="card col-12"
                style="background: linear-gradient(60deg, #ff000038, transparent);box-shadow: 0px 4px 10px 6px black;">
                <div class="d-flex text-start">
                    <div class="row col-5  fsClass">
                        <div class="col-12 mt-3">
                            <span class="fw-bold mb-2 ">Shipping :</span>
                            <span class="fw-bold ">FREE</span>
                        </div>
                        <div class="col-12">
                            <span class="fw-bold mb-2">Total :</span>
                            <span class="fw-bold">Rs. <input type="number"
                                    style="width:40%;background:transparent;border:0;" readonly id="grand_total"
                                    value="0"></span>
                        </div>
                    </div>
                    <div class="col-7 fsClass">
                        <div class="text-center fw-bold m-2" style="color:red;"><a href="dailyDeal.php"
                                style="color:red; text-decoration: none;">Continue Shopping</a></div>
                        <div class="text-center mb-3"><button type="button" class="btn fw-bold col-8"
                                style="background: red;color:white" data-bs-toggle="modal"
                                data-bs-target="#cashONDelevary" id="check_out_btn">Check Out</button>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- add to cart display -->
<!-- add to cart display -->


<!-- script part start -->
<!-- script part start -->
<script>
    $(document).ready(function () {
        $("#check_out_btn").attr("disabled", "disabled");
        $("#check_out_btn").click(function () {
            var list = [];
            var i = 1;
            var grand_total_amt = 0;
            var cart_id = $("#cart_id").attr("data-cart_id");
            alert(cart_id);
            $("#products_being_checked_out").empty();
            $(".checkout_item").each(function () {
                if($(this).prop("checked")){
                // alert($(this).attr("data-pv_id"));
                var img_name = $(this).attr("data-product_image");
                var pv_id = $(this).attr("data-pv_id");
                var discounted_value = $(this).attr("data-discounted_value");
                var product_name = $(this).attr("data-product_name");
                var qnty = $(this).attr("data-product_quantity");
                var price = $(this).attr("data-product_price");
                // var unit_total=parseInt(qnty)*parseInt(price);
                var unit_total = parseInt(qnty) * parseFloat(price);
                grand_total_amt = grand_total_amt + unit_total;
                html = '<div class="row">';
                html += '<div class="col-4 checkout_products_list" data-pv_id="' + pv_id + '" data-cart_id="' + cart_id + '" data-quantity="' + qnty + '" data-rate="' + price + '" data-discount="' + discounted_value + '">';
                html += '<img src="data:image/jpeg;base64,' + img_name + '" alt=""class="w-100">';
                html += '</div>';
                html += '<div class="col">';
                html += '<span>' + product_name + '</span><br>';
                html += '<span>Quantity:<strong>' + qnty + '</strong></span><br>';
                html += '<span>Price:Rs.' + price + '</span><br>';
                html += '</div>';
                html += '</div>';
                $("#products_being_checked_out").append(html);
                i = i + 1;
                }
            });
            $("#grand_total_amt").text('Rs.'+grand_total_amt);
            $("#grand_total_calculated").val(grand_total_amt);
            for (i = 1; i < list.length; i++) {
                // alert(list[i]);
            }
        });
        
        $("#check_out_all").on('click',function(){
            if($(this).prop("checked")){
                // alert('check');
                $('.checkout_item').each(function(){
                    if(!$(this).prop("checked")){
                    $(this).click();
                    }
                });
            }else{
                // alert('unchecked');
                $('.checkout_item').each(function(){
                    if($(this).prop("checked")){
                    $(this).click();
                    }
                });
            }
        });
        $(".checkout_item").click(function () {
            // alert ('clicked');
            //changing check_out_btn property
            var count_checked = 0;
            $("input[type='checkbox']:checked").each(function () {
                $(this).parent('div').parent('td').parent('tr').addClass('selected_item');
                count_checked = count_checked + 1;
            });
            $("input[type='checkbox']:not(:checked)").each(function () {
                $(this).parent('div').parent('td').parent('tr').removeClass('selected_item');
            });
            if (count_checked >= 1) {
                $("#check_out_btn").removeAttr("disabled");
            }
            else {
                $("#check_out_btn").attr("disabled", "disabled");
            }

            var total_price = $("#grand_total").val();
            total_price = parseInt(total_price);
            if ($(this).prop('checked') == true) {
                var price = $(this).attr("data-product_price");
                price = parseInt(price);
                var quantity_count = $(this).attr("data-product_quantity");
                quantity_count = parseInt(quantity_count);
                total_price = total_price + (price * quantity_count);
                // alert("Price "+price);
            }
            else {
                var price = $(this).attr("data-product_price");
                price = parseInt(price);
                var quantity_count = $(this).attr("data-product_quantity");
                quantity_count = parseInt(quantity_count);
                total_price = total_price - (price * quantity_count);
                // alert("Price "+price);
            }
            // alert("Total "+total_price);
            $("#grand_total").val(total_price);
            // $("input:checkbox[name=type]:checked").each(function(){
            //     yourArray.push($(this).val());
            // });
            // $("input[type='checkbox']:checked").each(function(){
            //     alert($(this).attr("data-pv_id"));
            // });
        });

        // <!-- this is khalti script  -->
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_5a16f3f0b9a34df585ffa391413c87b5",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                // "EBANKING",
                // "MOBILE_BANKING",
                // "CONNECT_IPS",
                // "SCT",
            ],
            "eventHandler": {
                onSuccess(payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                },
                onError(error) {
                    console.log(error);
                },
                onClose() {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        // var btn = document.getElementById("payment-button");
        // btn.onclick = function () {
        //     // minimum transaction amount must be 10, i.e 1000 in paisa.
        //     checkout.show({amount: 1000});
        // }
        $(document).on("click", "#payment-button", function () {
            checkout.show({ amount: 2000 });
        })
        //          <!-- Paste this code anywhere in you body tag -->
        // <!-- this is khalti script  -->
    });

</script>
<!-- script part start -->
<!-- script part End -->


<!-- this is copy reference code part  -->
<!-- this is copy reference code part  -->
<button type="button" class="btn btn-primary" id="copyRefCode" data-bs-toggle="modal" data-bs-target="#copyModal"
    style="display:none;">Click Me</button>
<div class="modal fade" id="copyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center fw-bold" id="copyModalLabel">Refrence Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center"><strong>Order Placed Successfully, Our team will contact you before delivery.
                        <br>Thank you for your patience !<br></strong>
                    <span class="text-bold"><strong>Note</strong>: Please, Save this invoice for later.
                        :</span>
                    <!--<input type="text " readonly style="width:20vh;font-weight:bold; id="refCode""> -->
                    <a class="btn btn-success" target="_blank" id="refCode">Show Invoice</a>
                    <!--<button class="btn border fw-bold" id="btnRefCode" onclick="copyFunction()">Copy text</button>-->
                </div>
                <script>
                $(document).ready(function(){
                 $("#btnRefCode").click(function(){
                     $("#refCode").select();
                     document.execCommand("copy");
                 });
                });
               </script>
            </div>
        </div>
    </div>
</div>
<!-- this is copy reference code part  -->
<!-- this is copy reference code part  -->
<?php include 'paymentGetway.php'; ?>
<?php
include 'footer.php';
?>