<?php 
// include "header.php"; 
?>
<!-- FAQs start-->
<!-- FAQs start-->
<div class="row removeRow row-cols-12 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 d-flex flex-wrap pt-5" style="background:white;">
    <!-- FAQs 1 start-->
    <!-- FAQs 1 start-->
    <div class="col-2"></div>
    <div class="col-8 giveCol_10">
        <h1>FAQs</h1>
        <div>
            <?php 
                //   $product_id=$_SESSION['product_id'];
                  $myQuery = "SELECT `id`, `product_id`, `question`, `answer` FROM `faqs` where product_id=$displaying_product_id";
                  $conn = connectdb();
                  $req = mysqli_query($conn, $myQuery) or die(mysqli_error($conn));
                  if(mysqli_num_rows($req)>0){
                  $i=1;
                  while($data = mysqli_fetch_assoc($req)){ 
            ?>
        <div class="d-flex flex-wrap">
            <div class="col-11 ">
                <p>
                    <a class="fw-bold" style="color:black; text-decoration: none;" data-bs-toggle="collapse"
                        href="#collapseExample<?php echo $i;?>">
                        Q. <?php echo $data['question'] ?> 
                </p>
            </div>
            <div class="col-1"><i class="bi bi-chevron-down"></i></a></div>
        </div>

        <div class="collapse" id="collapseExample<?php echo $i; ?>">
            <div class="card card-body col-12">
                <?php echo $data['answer']; ?>
            </div>
        </div>
        <hr>
            <?php
                    $i++;
                }
            }
            ?>
    </div>
    </div>
    <div class="col-2"></div>

    <!-- FAQs 1 end-->
    <!-- FAQs 1 end-->
</div>
<!-- FAQs end-->
<!-- FAQs end-->
<?php 
// include "footer.php"; 
?>