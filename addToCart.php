<!-- add to cart start -->
<!-- add to cart start -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header" style="background:red; Color:white">
    <h5 id="offcanvasRightLabel">Your Cart</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="col-12 d-flex" style="flex-wrap: wrap;visibility:none;" id="show_if_empty">
    </div>
    <div class="col-12" id="display_if_products_in_cart" style="flex-wrap: wrap;visibility:none;"></div>
    <div class="text-center" id="checkout_btn"></div>
  </div>

  <script>
    //controls of cart
    $(document).ready(function () {
      function check_response_code($code) {
        if ($code == 200) {
          alert("Success");
        }
        else if ($code == 201) {
          alert("Failure");
        }
        else if ($code == 502) {
          alert("Errore");
        }
      }
      $(document).on("click", ".deleteProductFromCartBtn", function () {
        // alert('clicked');
        var pv_id = $(this).attr("data-pv_id");
        var cart_id = $("#cart_id").attr("data-cart_id");
        var container_id = $(this).attr("data-container-id");
        if(confirm("Are you sure you want to delete ?")){
        $.ajax({
          url: "assets/library/productCartControl.php",
          method: "POST",
          data: { delete_cart_product: pv_id, cart_id: cart_id },
          dataType: "JSON",
          success: function (data) {
            if (data.status_code == 200) {
            //   alert('ok');//i need to refresh only this protion of the page to show updated data, i.e. I need to reload or fetch data from database ?

               location.reload();
              // $('#lnkCart').load("index.php" +  ' #lnkCart');
              // $("#lnkCart").click();
            }
            console.log(data);
          }, error: function (er) {
            console.log(er);
          }
        });
        }
      });
      $(document).on("click", ".minusBtn", function () {
        // alert("clicked minus");
        var qty = $(this).next(".odrQty").val();
        qty = parseInt(qty);
        if (qty == 1) {
          alert("Please understand, Minimum order Quantity is 1. Thank You!");
        }
        else if (qty > 1) {
          var pv_id = $(this).attr("data-pv_id");
          var cart_id = $(this).attr("data-cart_id");
          qty = (qty - 1);
          $.ajax({
            url: "assets/library/productCartControl.php",
            method: "POST",
            data: { updateQty: qty, pv_id: pv_id, cart_id: cart_id },
            dataType: "JSON",
            success: function (data) {
              console.log(data);
              //  check_response_code(data.status_code);
            }, error: function (er) {
              console.log(er);
            }
          });
          $(this).next(".odrQty").attr("value", qty);
        }

      });
      $(document).on("click", ".plusBtn", function () {
        // alert("clicked Plus");
        var qty = $(this).prev(".odrQty").val();
        qty = parseInt(qty);
        if (qty == 20) {
          alert("Please understand, Maximum order Quantity is 20. Thank You!");
        }
        else if (qty < 20) {
          var pv_id = $(this).attr("data-pv_id");
          var cart_id = $(this).attr("data-cart_id");
          qty = (qty + 1);
          // alert("quantity is : "+qty);
          $.ajax({
            url: "assets/library/productCartControl.php",
            method: "POST",
            data: { updateQty: qty, pv_id: pv_id, cart_id: cart_id },
            dataType: "JSON",
            success: function (data) {
              console.log(data);
              //  check_response_code(data.status_code);
            }, error: function (er) {
              console.log(er);
            }
          });
          $(this).prev(".odrQty").attr("value", qty);
        }
      });
    })
  </script>

  <!-- 
  <footer>
    <div class="card col-12" style="background: linear-gradient(314deg, #ff000038, transparent);box-shadow: 0px 4px 10px 6px black;">
      <div class="col-12 d-flex">
        <div class="col-9">Shipping:</div>
        <div class="col-3 ">FREE</div>
      </div>
      <div class="col-12 d-flex">
        <div class="col-9">Total:</div>
        <div class="col-3">Rs. 1,099</div>
      </div>
      <div class="text-center fw-bold" style="color:red;"><a href="" style="color:red; text-decoration: none;">Continue Shopping</a></div>
      <div class="text-center mb-3"><button type="button" class="btn fw-bold col-11" style="background: red;color:white">CASH ON DELEVARY</button></div>
      <div class="text-center mb-3"><button type="button" class="btn fw-bold col-11" style="background: white;color:red; border: 4px solid;">PAY VIA CARD/OTHER</button></div>
    </div>
  </footer> -->
</div>
<!-- add to cart end -->
<!-- add to cart end -->