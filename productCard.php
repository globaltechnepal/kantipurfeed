<?php
// include 'header.php';
?>
<div class="container text-center mt-5 mb-5"><div class="h1 fw-bolder text-white"> <span class="border-bottom border-3 px-3">  Best Sellers</span></div> </div>
<div style="background-color:black;" class="container col-12 d-flex flex-wrap ">
<?php
for($i=0;$i<4;$i++){
  ?>
  <div class="card font-monospace m-3 product-wrapper" id="wrapper<?php echo $i; ?>" style="width:18rem;background-color:#e3e3e3;">
  <img class="change-on-hover-primary" style="width:100%;z-index:1;" src="assets/images/products/airdopesblue.png" class="card-img-top" alt="airdopes">
  <img class="change-on-hover-secondary" style="width:100%;display:none;" src="assets/images/products/airpodblue.png" class="card-img-top" alt="airdops">
  <div class="card-body border border-2 rounded mx-2 mb-2 bg-white">
    <div class="card-title">
    <span><strong class="fw-bolder">Ultima AirBuds</strong></span><br>
    <span><small><i class="bi bi-star-fill text-warning"></i> 4.5 | 999 reviews</small></span>
    <hr>
    <p class="card-text">
      <span class="fw-bolder">Rs.999 </span> <span class="text-decoration-line-through fw-light">Rs.1499</span><br>
      <small>You saved: Rs.500</small>
     </p>
    <a href="#" style="width:100%;" class="btn btn-danger text-center">ADD TO CART</a>
    </div>
  </div>
</div>
  <?php
}
?>
</div>
<!-- script to control product image toggle  -->
<!-- script to control product image toggle  -->
<script>
   $(function(){
    $('.change-on-hover-primary').hover(function(){
      //for dynamic track primary image name and secondary imagename along with paths
      $(this).attr("src","assets/images/products/airdopesblue.png");
    },
      function(){
        $(this).attr("src","assets/images/products/airdopesblack.png");
  });
   });
</script>
<!-- script to control product image toggle  -->
<!-- script to control product image toggle  -->
<?php
// include 'footer.php';
?>