<script>
  function chooseColor(product_id) {
    alert ("Clicked :"+product_id);
    $.ajax({
      url: "assets/library/color_control.php",
      method: "POST",
      data: { getColors: product_id },
      dataType: "JSON",
      success: function (data) {
        // alert('OK');
        // console.log(data);
        data.length;
        // var urlLink = data[1].url_link;
        // $("#viewDetailFromCart").attr("href", urlLink);
        var imgName = data[1].img;
        $("#displayimg").attr("src", "data:image/jpeg;base64," + imgName);
        var productName = data[1].product_name;
           alert(productName);
        $("#productName").text(productName);
        var productSellPrice = data[1].sell_price;
        $("#productSellPrice").text("Rs." + productSellPrice);
        var productActualPrice = data[1].actual_price;
        $("#productActualPrice").text("Rs." + productActualPrice);
        var colorName = data[1].color_name;
        $("#colorName").text(colorName);
        var pv_id = data[1].pv_id;
        $("#selected_pv_id").attr("value", pv_id);
        $("#varient_images").empty();
        jQuery.each(data, function (i, val) {
          if (i == 0) { }
          else {
            var html = '<div class="col-4 m-0 p-0"><button class="btn imgchng" data-img_name="' + val.img + '" data-color_name="' + val.color_name + '" data-pv_id="' + val.pv_id + '"><img src="data:image/jpeg;base64,' + val.img + '"  class="w-100 rounded me-1 " style="background:#e1e1e1"></button></div>';
            $("#varient_images").append(html);
          }
        });
      }
    });
  }
</script>

<!-- choose color before add to cart start-->
<!-- choose color before add to cart start-->
<div class="offcanvas offcanvas-end" id="offcanvasRight_1" aria-labelledby="offcanvasRightLabel_1">
  <div class="offcanvas-header" style="background:black; Color:white">
    <h5 id="offcanvasRightLabel">Choose Option</h5>
    <button type="button" id="closeColorSelect" class="btn-close  text-white" data-bs-dismiss="offcanvas"
      aria-label="Close"><i class="bi bi-x-square-fill "></i></button>
  </div>
  <div class="offcanvas-body">
    <div class=" col-12 d-flex pt-2 pb-2">
      <div class="col-4">
        <img class="w-100" id="displayimg">
      </div>
      <div class="col-8 ">
        <h4 id="productName"></h4>
        <p class="card-text">
          <span class="fw-bolder" id="productSellPrice" style="color: red;"></span> &nbsp;
          <span class="text-decoration-line-through fw-light" id="productActualPrice"></span><br>
        </p>
      </div>
    </div>
    <div class="col-12 fw-bold pb-2">
      <span style="color: gray;">Color : &nbsp; </span><span id="colorName"></span>
    </div>
    <div class="col-12 mt-1" id="varient_images" style="display: flex;flex-wrap: wrap;flex-basis: 25%;">
      <!--<button class="btn"><img id="imgcng1" src="assets\images\products\eardopesblack.png"-->
      <!--    class="w-100 rounded me-1 bgonclick" style="background:#e1e1e1"></button>-->
      <!--<button class="btn"><img id="imgcng2" src="assets\images\products\eardopesblue.png" class="w-100 rounded  me-1"-->
      <!--    style="background:#e1e1e1"></button>-->
      <!--<button class="btn"><img id="imgcng3" src="assets\images\products\eardopesgray.png" class="w-100 rounded"-->
      <!--    style="background:#e1e1e1"></button>-->
    </div>
    <input type="hidden" name="selected" id="selected_pv_id">
    <div class="mt-4"><button type="button" id="addToCartBtn" class="btn fw-bold col-12"
        style="background: red;color:white;">ADD TO CART</button></div>
    <div class="mt-3 text-center fw-bold"> <a id="viewDetailFromCart" style="color: red;">VIEW DETAILS</a> </div>
  </div>
</div>

<!-- choose color before add to cart start-->
<!-- choose color before add to cart start-->


<!-- click event fire to change images start on offcanvas-->
<!-- click event fire to change images start on offcanvas-->
<script>
  $(document).on("click", ".imgchng", function () {
    var img_name = $(this).attr("data-img_name");
    var color_name = $(this).attr("data-color_name");
    var pv_id = $(this).attr("data-pv_id");
    $("#displayimg").attr("src","data:image/jpeg;base64," + img_name);
    $("#colorName").text(color_name);
    $("#selected_pv_id").attr("value", pv_id);
    // alert("data are : Img Name"+img_name+", color Name : "+color_name+" pv_id : "+pv_id);
    // alert("click bound to document listening for #test-element"+img_name);
  });
  $(document).ready(function () {

    $("#addToCartBtn").click(function () {
      var selected_pv_id = $("#selected_pv_id").val();
      var quantity = 1;
      var cart_id = $("#cart_id").attr("data-cart_id");
      alert ("ID is : "+selected_pv_id+" please proceed.");
      $.ajax({
        url: 'assets/library/productCartControl.php',
        type: 'POST',
        data: { addToCart: cart_id, pv_id: selected_pv_id, quantity: quantity },
        datatype: 'JSON',
        success: function (data) {
          console.log(data);
          var d = JSON.parse(data);
          console.log(d);
          if (d.status_code == "200") {
            // alert("DONE");
            $("#closeColorSelect").click();
            $("#lnkCart").click();
          }
          else if (d.status_code != "500") {
            alert("NOT DONE");
          }
        },
        error: function (er) {
          console.log(er);
        }
      });
    });
    $("#lnkCart").click(function () {
      var cart_id = $("#cart_id").attr("data-cart_id");
      $.ajax({
        url: 'assets/library/productCartControl.php',
        type: 'POST',
        data: { cartlist: cart_id },
        datatype: 'JSON',
        success: function (data) {
          // alert("ok");
          // console.log(data);
          var da = JSON.parse(data);
          // console.log(da);
          if (da.status_code != 200) {
            html = '<div class="h3 text-center">Cart is Empty.</div>';
            html += '<div class="col-12 p-3 mt-3"><button id="toggleCart" class="w-100 btn bg-primary bg-gradient text-center text-white">Continue Shopping</button></div>';
            $("#show_if_empty").empty();
            $("#show_if_empty").css("visibility", "visible");
            $("#show_if_empty").append(html);
          }
          if (da.status_code == 200) {
            var html = '';
            var cart_id = $("#cart_id").attr("data-cart_id");
            jQuery.each(da.data, function (i, val) {
              html += '<div class="col-12 d-flex" style="flex-wrap: wrap;" id="cnt-'+i+'">';
              html += '<div class="col-4 text-center">';
              html += '<img src="data:image/jpeg;base64,' + da.data[i].img + '" class="w-100">';
              html += '</div>';
              html += '<div class="col-8">';
              html += '<div class="fw-bold">' + da.data[i].product_name + '</div>';
              html += '<div class="fw-normal">' + da.data[i].color_name + '</div>';
              html += '<p class="card-text">';
              html += '<span class="fw-bolder">Rs.' + da.data[i].sell_Price + '</span> &nbsp;';
              html += '<span class="text-decoration-line-through fw-light"> Rs.' + da.data[i].actual_Price + '</span><br>';
              html += '</p>';
              html += '</div>';
              html += '<div class="col-12 d-flex">';
              html += '<div class="col-3"></div>';
              html += '<div class="col-8">';
              html += '<div class="d-inline-flex">';
              html += '<div class="v-counter">';
              html += '<input type="button" class="minusBtn" data-pv_id="' + da.data[i].id + '" data-cart_id="' + cart_id + '" value="-" />';
              html += '<input type="text" class="odrQty" size="25" value="' + da.data[i].quantity + '" class="count fs-5" style="color:red"/>';
              html += '<input type="button" class="plusBtn" data-pv_id="' + da.data[i].id + '" data-cart_id="' + cart_id + '" value="+" />';
              html += '</div>';
              html += '<div class="pt-3 fw-bold">Units</div>';
              html += '</div>';
              html += '</div>';
              html += '<div class="col-1 mt-3 me-3">';
              html += '<button type="button" style="background:transparent;border:none" data-pv_id="' + da.data[i].id + '" data-container-id="'+i+'"class="deleteProductFromCartBtn"><i class="bi bi-trash3-fill fs-6" style="color:red"></i></button>';
              html += '</div>';
              html += '</div>';
              html += '</div>';
              html += '<hr id="hr_line'+i+'">';
            });
            $("#show_if_empty").empty();
            $("#display_if_products_in_cart").empty();
            $("#display_if_products_in_cart").css("visibility", "visible");
            $("#display_if_products_in_cart").append(html);
            $("#checkout_btn").empty();
            $("#checkout_btn").append('<a class="btn fw-bold border-bottom"  style="color:red;" href="cartCheckout.php">Cart & Check Out</a>');
          }
        },
        error: function (er) {
          console.log(er);
        }
      });
    });
  })
</script>

<script>
  $(document).on("click", "#toggleCart", function () {
    // $("#lnkCart").click();
    // location.href ='index.php#products';
    location.href = 'offerZone.php';
  })
</script>
<!-- click event fire to change images start on offcanvas-->
<!-- click event fire to change images start on offcanvas-->
<script>
  var html = '';
  html += '<div class="col-12 d-flex" style="flex-wrap: wrap;">';
  html += '<div class="col-4 text-center">';
  html += '<img src="<?php //echo $data['img_path'].$data['img']; ?>" class="w-100">';
  html += '</div>';
  html += '<div class="col-8">';
  html += '<div class="fw-bold"><?php //echo $data['product_name']; ?></div>';
  html += '<div class="fw-normal"><?php //echo $data['color_name']; ?></div>';
  html += '<p class="card-text">';
  html += '<span class="fw-bolder">Rs.<?php //echo $data['sell_Price']; ?>.00</span> &nbsp;';
  html += '<span class="text-decoration-line-through fw-light"> Rs.<?php //echo $data['actual_Price']; ?>.00</span><br>';
  html += '</p>';
  html += '</div>';
  html += '<div class="col-12 d-flex">';
  html += '<div class="col-3"></div>';
  html += '<div class="col-8">';
  html += '<div class="d-inline-flex">';
  html += '<div class="v-counter">';
  html += '<input type="button" class="minusBtn" data-pv_id="<?php //echo $data['id']; ?>" data-cart_id="<?php //echo $_SESSION['cart_id']; ?>" value="-" />';
  html += '<input type="text" class="odrQty" size="25" value="<?php //echo $data['quantity']; ?>" class="count fs-5" style="color:red"/>';
  html += '<input type="button" class="plusBtn" data-pv_id="<?php //echo $data['id']; ?>" data-cart_id="<?php //echo $_SESSION['cart_id']; ?>" value="+" />';
  html += '</div>';
  html += '<div class="pt-3 fw-bold">Units</div>';
  html += '</div>';
  html += '</div>';
  html += '<div class="col-1 mt-3 me-3">';
  html += '<button type="button" style="background:transparent;border:none" class="deleteProductFromCartBtn"><i class="bi bi-trash3-fill fs-6" style="color:red"></i></button>';
  html += '</div>';
  html += '</div>';
  html += '</div>';
  html += '<hr>';
</script>