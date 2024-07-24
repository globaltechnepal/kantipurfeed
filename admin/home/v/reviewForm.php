<?php include "../header.php" ?>
<div class=" m-4" style="border: 1px solid;">
<div class="p-3 mb-2 col bg-dark text-white text-center">Review</div>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 mx-2 text-center text-danger fw-bold">
<?php 
$FAQsquery = "SELECT `id`,`product_name`,LEFT(product_name,20)as trunkName, `category_id`, `actual_Price`, `sell_Price`, `img_path`, `primary_image`, `secondary_image`, `remarks` FROM `products`";
$conn = dbConnecting();
$req = mysqli_query($conn,$FAQsquery) or die(mysqli_error($conn));
if(mysqli_num_rows($req)>0){
for($i=1;$i<15;$i++){
  while ($data = mysqli_fetch_assoc($req)) { ?>
  <div class="col text-center mt-3 p-2">
    <a href="review.php?id=<?php echo $data['id']; ?>" style="text-decoration:none; color: red;">
    <div class="card" style="background: #e6e6e6;" title="<?php echo $data['product_name']; ?>">
      <div class="col-12"><img src="data:image/jepg;base64,<?php echo $data['primary_image'] ?>" alt="" class="w-75"></div>
      <div class="col-10"><span ><?php echo $data['trunkName']; ?></span></div>
    </div>
    </a>
  </div>
  <?php
  }
}
}
?>  
</div>
</div>
<?php include "../footer.php" ?>