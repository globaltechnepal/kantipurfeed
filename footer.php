<div class="col-12 text-center pt-1 pb-1" style="background:#2c2c2c;">
  <marquee behavior="scroll" direction="left">
    <span class="fs-6" style="color:#8f8f8f;">Nepal's fastest growing stationary brand.Nepal's fastest growing stationary brand. </span>
  </marquee>
</div>
<!-- Footer -->
<footer class="col-12 text-center text-lg-start text-dark" style="background-color: #e1e1e1">
  <!-- Grid container -->
  <div class="p-5 pb-0 lh-sm">
    <!-- Section: Links -->
    <section class="">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-lg-5 col-md-8 mb-4 mb-md-0" id="aboutULT">
          <h5 class="text-uppercase fw-bold">About Company</h5>
          <p style="text-align: justify;">
          Deli Stationery is a world-leading stationery brand that has been recognised for its innovative designs, expert craftsmanship and high performance. Deli's commitment to providing the best quality writing instruments in Nepal has brought Trinity Exim Pvt. Ltd to the forefront of Nepal's stationery market.
          </p>
        </div>

        <!--Grid column-->
        <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
          <h5 class="text-uppercase fw-bold">Help</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="deliveryStatus.php" class="text-dark">Track Your Order</a>
            </li>
            <li>
              <a href="#!" class="text-dark">Warranty & Support</a>
            </li>
            <li>
              <a href="#!" class="text-dark">Return Policy</a>
            </li>
            
            <li>
              <a href="#!" class="text-dark">Why Buy Direct</a>
            </li>
            <li>
              <a href="cartOut.php" class="text-dark">check cart</a>
            </li>
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-2 col-md-6 mb-4 mb-md-0">
          <h5 class="text-uppercase fw-bold">Company</h5>

          <ul class="list-unstyled mb-0">
            <li>
              <a href="#aboutULT" class="text-dark">About DeliNepal</a>
            </li>
            <li>
              <a href="#blogNav" class="text-dark">Read Our Blog</a>
            </li>
            <li>
              <a href="#brandPromise" class="text-dark">Brand Promise</a>
            </li>
            <!--<li>-->
            <!--  <a href="#!" class="text-dark">Security</a>-->
            <!--</li>-->
            <li>
              <a href="#!" class="text-dark">Terms of Service</a>
            </li>
            <li>
              <a href="#!" class="text-dark">Privacy Policy</a>
            </li>
            <!--<li>-->
            <!--  <a href="#!" class="text-dark">Investor Relations</a>-->
            <!--</li>-->
          </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-2 col-md-6 mb-md-0">
          <h5 class="text-uppercase fw-bold">We Accept</h5>

          <ul class="list-unstyled">
            <li class="mb-4">
              <div >
                <a class="me-1"><img src="assets/images/paymentgetways/esewa.png"
                    style="width:55px;border-radius: 10px;">
                </a>
              </div>
            </li>
            <li class="mb-4">
              <div >
                <a class="me-1"><img src="assets/images/paymentgetways/phonepay.jpg"
                    style="width:55px;border-radius:3px;"></a>
              </div>
            </li>
            <li>
              <div > 
                <a class="me-1"><img src="assets/images/paymentgetways/khalti.jpg"
                    style="width:55px;border-radius: 20px;"></a>
              </div>
            </li>
          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </section>
    <!-- Section: Links -->


<?php 
if($_SESSION['login_status']==0 && $adminemail==''){
?>
    <hr class="mb-4" />
    <!-- Section: Register -->
    <section class="">
      <p class="d-flex justify-content-center align-items-center">
        <span class="me-3">Register for free</span>
        <a type="button" href="register.php" class="btn btn-outline-light btn-rounded" style="color:black !important;">
          Sign up!
        </a>
      </p>
    </section>
    <!-- Section: Register -->
<?php 
}
?>
    <hr class="mb-4" />

    <!-- Section: Social media -->
    <section class="mb-4 text-center">
      <!-- Facebook -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button" ><i class="bi bi-facebook"
          style="color:#022390"></i></a>

      <!-- Twitter -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button" ><i class="bi bi-twitter"
          style="color:#1da1f2"></i></a>

      <!-- Google -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button" ><i class="bi bi-whatsapp"
          style="color:#45c556"></i></a>

      <!-- Instagram -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button" ><i class="bi bi-instagram"
          style="color:#ec4b5f"></i></a>

      <!-- Linkedin -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button" ><i class="bi bi-linkedin"
          style="color:#0077B5"></i></a>

      <!-- Github -->
      <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button" ><i class="bi bi-youtube"
          style="color:red"></i></a>
    </section>
    <!-- Section: Social media -->
  </div>
  <!-- Grid container -->

  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
    © 2022 Copyright:
    <a class="text-dark" href="index.php">delinepal.com </a><br>
    <span class="text-end">Design by Globaltech Solution Pvt. Ltd</span>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->

<!-- bootstrap cdn -->
<!-- bootstrap cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- bootstrap cdn -->
<!-- bootstrap cdn -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/gh/alfrcr/paginathing/dist/paginathing.min.js"></script>


<div class="bottombanner col-12"></div>
<script>
$(document).ready(function(){
    //   paginathing
    //   paginathing
    $(document).on("click",".page-link", function(){
        //   $(this).attr("href","#dynamicContainer");
        window.location="#productsBar";
       });
   function pagenathingHO(){
       const listElement = $(".list-group");
        listElement.paginathing({
          perPage: 20,
          limitPagination: 3,
          containerClass: "panel-footer mt-4",
          pageNumbers: true,
          ulClass: "pagination flex-wrap justify-content-center",
        });
   }
   pagenathingHO()
   //   paginathing
   //   paginathing

    if(window.navigator.userAgent.indexOf("Mobile")>-1){
       //alerting something
      // alert("something");
       $("#product_image_display_part").height('30vh');
    //   $(".logoImg").removeClass("w-50");
       $(".carousel-indicators").css("display","none");
       $(".giveCol_10").removeClass('col-6');
       $(".giveCol_10").addClass('col-12');
       $(".giveCol_10").css('padding','0rem 1rem');
       //faq
       $(".removeRow").removeClass('row');
       //cart page
       $(".removeCol").remove();
       $(".fsSize").removeClass('fs-5');
       $(".fsSize").css('font-size','8px');
       $(".fsClass").css('font-size','12px');
       $(".headingCls").css('font-size','16px');
       $(".marginCls").css('margin-top','20px');
       $(".widthCls").css('width','100');
       $(".heightCls").css('height','200');
       $(".removeHeight").removeClass('h-75');
       $(".hoverProp").css("height","51%");
       $(".top_bar_user_menu").css("margin-top","0");
       
   }
   
   $(".hoverProp").hover(function(){
       //on hover in
    //   alert();
       $(this).attr('src',$(this).attr('data-secondary_img'))
   },
   function(){
      //on hover out 
       $(this).attr('src',$(this).attr('data-primary_img'))
    //   alert($(this).attr('data-primary_img'));
   });
   
   $(document).on("click","#validateCoupon", function(){
           $("#copuonMessage").empty();
       var hasCouponID=$("#hasCouponID").val();
       if(hasCouponID.length>3){
           $.ajax({
                    url: 'assets/library/productCartControl.php',
                    type: 'POST',
                    data: {apply_coupon_code:hasCouponID},
                    datatype: 'json',
                    success: function (data) { 
                        // console.log("Trying");
                        console.log(data);
                        var da = JSON.parse(data);
                        if(da.status_code==200){
                            var coupon_value = da.coupon_value;
                            $("#coupen_discount").text(coupon_value);
                            $("#hasThisCouponID").val(hasCouponID);
                            $("#copuonMessage").append('<i class="text-success">Coupon Code Applied.</i>');
                            $("#hasCouponID").attr("readonly","readonly");
                            $("#validateCoupon").remove();
                        }else if(da.status_code==222){
                            var noVal='';
                            $("#coupen_discount").text('----');
                            $("#hasCouponID").val(noVal);
                            $("#copuonMessage").append('<i class="text-danger">Coupon Already Used</i>');
                        }else if(da.status_code==333){
                            var noVal='';
                            $("#coupen_discount").text('----');
                            $("#hasCouponID").val(noVal);
                            $("#copuonMessage").append('<i class="text-danger">Cannot Use Coupon, Please Use another.</i>');
                        }
                        else{
                            var noVal='';
                            $("#coupen_discount").text('----');
                            $("#hasCouponID").val(noVal);
                            $("#copuonMessage").append('<i class="text-danger">Invalied Coupon Code</i>');
                        }
                     },
                    error: function (jqXHR, textStatus, errorThrown) { alert("fail"); console.log(errorThrown); }
                });
        //   $("#copuonMessage").append('<i class="text-success">Coupon Code Applied.</i>');
        //   $(this).remove();
       }
       else{
           $("#copuonMessage").append('<i class="text-danger">Invalied Entry</i>');
       }
});
});

    
</script>


</body>

</html>