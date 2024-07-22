<div class="text-center">
    <div class="h1 fw-bolder text-dark mt-3 mb-3"><span class="border-bottom border-3 px-3"> New Launch </span></div>
</div>
<div class="ms-3 me-2" style="overflow-x:scroll;width:99%">
<div class="d-flex" >
<?php 
$calc="";
$sql = "SELECT nl.`id`,nl.`product_id`,`category_name`,`product_name`,`actual_Price`,`sell_Price`, `discriptions`,p.`primary_image`,clr.color_name,clr.color_code  FROM `new_launch` nl
 INNER join products p on p.id= nl.product_id
 INNER JOIN category c ON c.category_id = p.category_id
 INNER JOIN productvariant pv on pv.product_id = p.id
 INNER JOIN colors clr on pv.color_id = clr.id
WHERE nl.display='Active';";
  $conn = connectdb();
  $req = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  if (mysqli_num_rows($req) > 0) {
    while ($data = mysqli_fetch_assoc($req)) {
        $calc = ((($data['actual_Price']-$data['sell_Price'])/$data['actual_Price'])*100);
?>
<div class="card col-4 removeColclass" style="width:16rem; position: relative;">
   <div class="pe-2 mt-2 newlaunchCls" style="position: absolute;color: white;background: rgba(129.00000751018524, 9.000000413507223, 250.00000029802322, 1);">
      🎉 New Launch
   </div>
  <img src="data:image/png;base64,<?php echo $data["primary_image"]; ?>" class="card-img-top" style="height:16rem;">
  <div class="card-body">
     <div class="text-center" style="border-bottom: 1px solid #d5d5d5;">
        <span class="card-title fw-bold"><?php echo $data["product_name"]; ?></span><br>
        <span class="fs-6 pb-3"><?php echo $data["category_name"]; ?></span>
    </div>
    
   <div class="text-center mt-3"><i class="bi bi-star-fill text-success"></i> Be the first to review</div>
   <div class="text-center">
       <span class="text-success"><?php echo round($calc,2); ?> % off</span> <span class="fw-bold">Rs <?php echo round($data["sell_Price"]); ?></span> <br> <span style="text-decoration:line-through">Rs <?php echo round($data["actual_Price"]); ?></span>
   </div>
  </div>
</div>
<?php 
  }
} 
?>
</div>
</div>

<script>
    $(".product-colors span").click(function () {
        $(".product-colors span").removeClass("active");
        $(this).addClass("active");
        $(".active").css("border-color", $(this).attr("data-color-sec"))
        // $("body").css("background", $(this).attr("data-color-primary"));
        $(".content h2").css("color", $(this).attr("data-color-sec"));
        $(".content h3").css("color", $(this).attr("data-color-sec"));
        // $(".container-wrapper .imgBx").css("background", $(this).attr("data-color-sec"));
        // $(".container-wrapper .details button").css("background", $(this).attr("data-color-sec"));
        $(".imgBx img").attr('src', $(this).attr("data-pic"));
    });
</script>
