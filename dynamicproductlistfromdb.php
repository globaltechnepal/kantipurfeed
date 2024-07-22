<?php
include 'header.php';
// include 'assets/library/library.php';
?>
<div class="container text-center mt-5 mb-5"><div class="h1 fw-bolder text-white"> <span class="border-bottom border-3 px-3">  Best Sellers</span></div> </div>
<div style="background-color:black;" class="col-12 d-inline-flex flex-wrap dynamic-product-container">
<?php
// extracting data from product table
// extracting data from product table
$sql = "SELECT id,product_name,actual_price,sell_price,img_path,primary_image,secondary_image,url_link FROM products";
$conn = connectdb();
$req = mysqli_query($conn,$sql) or die(mysqli_error($conn));
if(mysqli_num_rows($req)>0){
while($data = mysqli_fetch_assoc($req)){
//product card layout 
//product card layout 
      ?>
  <div class="card font-normal m-1 mt-3 mb-3 product-wrapper product-card-size text-start" style="background-color:#e3e3e3;">
    <!-- this only for displays -->
    <!-- this only for displays -->
    <a href="<?php echo $data['url_link']; ?>"> <div data-aos="zoom-in" data-aos-duration="1500"><img class="change-on-hover<?php echo $data['id']; ?>" style="width:100%;z-index:1;" src="<?php $img1 = $data['img_path'].$data['primary_image']; echo $img1; ?>" class="card-img-top" alt="airdopes"></div> </a>
    <!-- this only for displays -->
    <!-- this only for displays -->
    <img id="primaryImg<?php echo $data['id']; ?>" style="width:100%;display:none;" src="<?php $img1 = $data['img_path'].$data['primary_image']; echo $img1; ?>" class="card-img-top" alt="airdops">
    <img id="secondaryImg<?php echo $data['id']; ?>" style="width:100%;display:none;" src="<?php $img2 = $data['img_path'].$data['secondary_image']; echo $img2;?>" class="card-img-top" alt="airdops">
    <div class="card-body border border-2 rounded mx-2 mb-2 bg-white">
      <div class="card-title">
      <span><strong class="fw-bolder"><?php echo $data['product_name'] ?></strong></span><br>
      <span><small><i class="bi bi-star-fill text-warning"></i> 4.5 | 999 reviews</small></span>
      <hr>
      <p class="card-text">
        <span class="fw-bolder">Product price 
          <!-- Rs.999 -->
         </span>
         <span class="text-decoration-line-through fw-light">Rs.<?php echo $data['actual_price']; ?></span><br>
         <span class="fw-light">Rs.<?php echo $data['sell_price']; ?></span><br>
        <small>You saved: Rs.<?php $saved = $data['actual_price']-$data['sell_price']; ?></small>
       </p>
      <a href="#" style="width:100%;" class="btn btn-danger text-center">ADD TO CART</a>
      </div>
    </div>
  </div>
<!-- script to control product image toggle  -->
<!-- script to control product image toggle  -->
<script>
   $(function(){
    $('.change-on-hover<?php echo $data['id']; ?>').hover(function(){
      //for dynamic track primary image name and secondary imagename along with paths
      var imgName2 = $("#secondaryImg<?php echo $data['id']; ?>").attr('src');
      $(this).attr("src",imgName2);
    },
      function(){
      var imgName1 = $("#primaryImg<?php echo $data['id']; ?>").attr('src');
        $(this).attr("src",imgName1);
  });
   });
</script>
<!-- script to control product image toggle  -->
<!-- script to control product image toggle  -->
  <?php
//product card layout 
//product card layout 


}
}else{
    echo "<h1> Nothing to show </h1>";
}

// extracting data from product table
// extracting data from product table

?>
</div>

<?php
include 'footer.php';
?>