this page is made to test of the page act responsive or not.

<?php
include 'assets/library/library.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"  >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  ></script>
<style>
  .radial-grad {
  background-image: radial-gradient(#c6c6c6, #c6babacc, #ffffff,#ffffff);
}
</style>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/animations.css">
<link rel="stylesheet" href="assets/css/responsive.css">

  </head>
<body style="background:black;">

<!-- product container  -->
<!-- product container  -->
<!-- product container  -->
<!-- product container  -->
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 lh-1 p-4">
        <?php
  // extracting data from product table
  // extracting data from product table
  $sql = "SELECT id,name,LEFT(name,20)as trunkName,actualPrice,sellPrice,path,primaryImage,secondaryImage,urlLink FROM products";
  $conn = connectdb();
  $req = mysqli_query($conn,$sql) or die(mysqli_error($conn));
  if(mysqli_num_rows($req)>0){
  while($data = mysqli_fetch_assoc($req)){
  //product card layout 
  //product card layout 
        ?>
    <div class="col p-2" style="background: #fff9f9;border:5px solid black;border-radius:15px;;">
      <div class="rounded broder border-3 border-primary">
        <div>
          <!-- this only for displays -->
          <!-- this only for displays -->
          <div class="mb-2 pb-5 text-center" style="border-radius: 15px;background:#e3e3e3;">
            <a href="<?php echo $data['urlLink']; ?>"><img class="change-on-hover<?php echo $data['id']; ?> rounded w-75" style="width:100%;z-index:1;" src="<?php $img1 = $data['path'].$data['primaryImage']; echo $img1; ?>" class="card-img-top" alt="airdopes"></a>
          </div>
        
          <!-- this only for displays -->
          <!-- this only for displays -->
          <img id="primaryImg<?php echo $data['id']; ?>" style="width:100%;display:none;" src="<?php $img1 = $data['path'].$data['primaryImage']; echo $img1; ?>" class="card-img-top" alt="airdops">
          <img id="secondaryImg<?php echo $data['id']; ?>" style="width:100%;display:none;" src="<?php $img2 = $data['path'].$data['secondaryImage']; echo $img2;?>" class="card-img-top" alt="airdops">
          <div class="rounded pt-3 p-2 bg-white" style="margin-top:-2rem;">
            <div class="lh-sm">
              <div class="ps-3"><strong class="fw-bolder product-font-size" title="<?php echo $data['name'] ?>"><?php echo $data['trunkName'] ?>...</strong><br>
                <span><small><i class="bi bi-star-fill text-warning"></i> 4.5 | 999 reviews</small></span>
              </div>      
              <hr style="margin:3px 0px;">
              <p class="ps-3 mt-3 mb-0">
                <span class="fw-bolder product-font-size">Product price <br>
                  <!-- Rs.999 -->
                </span>
                <span class="fw-bolder product-font-size">Rs.<?php echo $data['sellPrice']; ?></span>  
                <span class="text-decoration-line-through fw-light">Rs.<?php echo $data['actualPrice']; ?></span><br>
                <small>You saved: Rs.<?php $saved = $data['actualPrice']-$data['sellPrice']; echo $saved;?></small>
              </p>
              <div class="p-3 pb-0">
                <a href="#" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight_1" aria-controls="offcanvasRight_1" style="width:100%;linear-gradient(to bottom,#5cb85c 0,#419641 100%);" class="btn text-center"><div class="fw-bold text-white">ADD TO CART</div></a>
              </div>
            </div>
          </div>
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
<!-- product container  -->
<!-- product container  -->
<!-- product container  -->
<!-- product container  -->
</body>
</html>

