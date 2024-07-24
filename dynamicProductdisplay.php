<?php 
// include 'header.php'; 
?>
<div class=" col-12 d-flex flex-wrap pt-3 mb-1" style="background: white;">
    <div class="col-5 d-flex flex-wrap mb-3">
      <div class="col-2 ms-2">
      <button class="mb-2" style="border: 1px solid #e1e1e1; border-radius: 10px;">
      <img class="w-75" id="img1" src="assets\images\products\atom192\ATOM 192.jpg">
      </button>
      <button class="mb-2" style="border: 1px solid #e1e1e1; border-radius: 10px;">
      <img class="w-75" id="img2"  src="assets\images\products\atom192\atom192use.png">
        </button>
        <button class="mb-2" style="border: 1px solid #e1e1e1; border-radius: 10px;">
        <img class="w-75" id="img3" src="assets\images\products\atom192\fastcharge.jpg">
        </button>
        <button class="mb-2" style="border: 1px solid #e1e1e1; border-radius: 10px;">
        <img class="w-75" id="img4" src="assets\images\products\atom192\fastcharge2.jpg">
        </button>
        <button class="mb-2" style="border: 1px solid #e1e1e1; border-radius: 10px;">
        <img class="w-75" id="img5" src="assets\images\products\atom192\music bg.png">
        </button>

      </div>
      <div class="col-8 ms-4">
        <img src="assets\images\products\atom192\fastcharge.jpg" class="w-100" id="display">
      </div>
    </div>
    <div class="col-7">
      <div class="progress col-8">
        <div class="progress-bar bg-warning text-dark fw-bold text-start ps-5" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Sold 80%</div>
      </div>
      <h2>Ultima Atom 192 - Wireless Earbuds</h2>
      <p class="product-type text-uppercase">Wireless Earbuds</p>
      <div class="col-12 d-flex">
      <div class="col-6">
    <span class="fw-bold col-12">
      <small class="text-danger">
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-fill"></i>
        <i class="bi bi-star-half"></i>
      </small>
      4.8 | 987 Reviews
      <small><i class="bi bi-patch-check-fill text-success"></i></small>
    </span>
    <div class="col-12 d-flex flex-wrap">
      <div class="col-12">
        <hr>
        <div class="me-1 d-flex justify-content-between align-items-baseline product-form__option-info"><div>
          <span class="text-capitalize product-form__option-name"></span><span id="option-template--14357041315938__main--4460669370466-1-value" class="product-form__option-value"><a style="text-decoration: none; color: black; font-weight: bold;" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Color : CrimsonCream </span></div><img class="varnt-drop h-100"> <i class="bi bi-caret-down-fill"></i></a>
        </div>
        <div class="row">
          <div>
            <div class="collapse multi-collapse show" id="multiCollapseExample1">
              <div class="d-flex flex-wrap">
                <button class="col-4 btn" type="button"  onClick="airdopesblack()"><img class="w-100" src="assets/images/products/airdopesblack.png"></button>
                <button class="col-4 btn"  onClick="airdopesblue()"><img class="w-100" src="assets/images/products/airdopesblue.png"></button>
                <button class="col-4 btn"  onClick="airdopesgray()"><img class="w-100" src="assets/images/products/airdopesgray.png"></button>
              </div>
            </div>
          </div>
        </div>
        <hr>
      </div>
    </div>
    </div>
    <div class="col-6">
      <div class="card col-11 ms-4 mb-2" style="background:#efefef;">
      <div class=" d-flex flex mt-2">
          <span class="fs-5 fw-bold ms-5  me-2" style="color:red"><i class="bi bi-lightning-charge-fill"style="color:#fbc50b"></i> ₹ 2,699</span>
          <span class="fs-5" style="color:#616161"><del>₹ 3,599</del></span>
        </div>
        <div class="d-flex flex">
        <p class="custom-saved-price ms-2" style="letter-spacing: -0.045em;  color: #00C68C;  font-weight: 600; font-size: 14px; line-height: 20px;">You Save: ₹ 1,891 (63%) </p>
        <p class="inclusive ms-5" style="color:#616161">Inclusive of all taxes</p>
        </div>
        <div class="d-flex  justify-content-between" style="background: #DCDCDC;">
        <span class="fw-bold mt-1 ms-2" style=" color: rgb(0, 198, 140); visibility: visible;">In Stock</span>
        <p class="currently-in-cart pt-2" style="font-weight: 500; font-size: 14px; line-height: 17px; color: rgb(255, 3, 13); visibility: visible;">
        Currently in 
        <span class="pe-3">105 carts</span>
      </div>
      <div class="d-flex flex-wrap ms-3">
        <?php 
        include "product_counter.php";
        ?>
      </div>
      <div class="container col-12">
        <button type="button" class="btn col-12 fs-6 fw-bold" style="background:red; color:white;">ADD TO CART</button>
      </div>
    <div class="container col-12">
      <button type="button" class="btn col-12 fw-bold mt-3 mb-3" style="background: white; color: red; border: 3px solid;">
      ADD TO CART
      </button>
    </div>
    </div>
      </div>
      </div>
  </div>
</div>

<script>
   $(function(){
    $('#img1').hover(function(){
      //for dynamic track primary image name and secondary imagename along with paths
      var imgName2 = $(this).attr('src');
      $("#display").attr("src",imgName2);
    },
      function(){
      var imgName1 = $("#display").attr('src');
        $("#display").attr("src",imgName1);
  });
  $('#img2').hover(function(){
      //for dynamic track primary image name and secondary imagename along with paths
      var imgName2 = $(this).attr('src');
      $("#display").attr("src",imgName2);
    },
      function(){
      var imgName1 = $("#display").attr('src');
        $("#display").attr("src",imgName1);
  });
  $('#img3').hover(function(){
      //for dynamic track primary image name and secondary imagename along with paths
      var imgName2 = $(this).attr('src');
      $("#display").attr("src",imgName2);
    },
      function(){
      var imgName1 = $("#display").attr('src');
        $("#display").attr("src",imgName1);
  });
  $('#img4').hover(function(){
      //for dynamic track primary image name and secondary imagename along with paths
      var imgName2 = $(this).attr('src');
      $("#display").attr("src",imgName2);
    },
      function(){
      var imgName1 = $("#display").attr('src');
        $("#display").attr("src",imgName1);
  });
  $('#img5').hover(function(){
      //for dynamic track primary image name and secondary imagename along with paths
      var imgName2 = $(this).attr('src');
      $("#display").attr("src",imgName2);
    },
      function(){
      var imgName1 = $("#display").attr('src');
        $("#display").attr("src",imgName1);
  });
   });
</script>
<?php 
// include 'footer.php'; 
?>
