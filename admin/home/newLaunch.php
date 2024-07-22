<?php include "header.php" ?>
<div class=" m-4" style="border: 1px solid;">
    <div class="p-3 mb-2 col bg-dark text-white text-center">New Lunch</div>
    <div
        class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 mx-2 text-center text-danger fw-bold">
        <?php
        $FAQsquery = "SELECT `id`,`product_name`,LEFT(product_name,20)as trunkName, `category_id`, `actual_Price`, `sell_Price`,`primary_image`, `remarks` FROM `products` order by `id` desc";
        $conn = dbConnecting();
        $req = mysqli_query($conn, $FAQsquery) or die(mysqli_error($conn));
        if (mysqli_num_rows($req) > 0) {
            for ($i = 1; $i < 15; $i++) {
                while ($data = mysqli_fetch_assoc($req)) { ?>
        <div class="col text-center mt-3 p-2">
            <a class="new_launch" style="text-decoration:none; color: red;" data-id="<?php echo $data['id']; ?>"
                data-product_name="<?php echo $data['product_name']; ?>">
                <div class="card" style="background: #e6e6e6;" title="<?php echo $data['product_name']; ?>">
                    <div class="col-12"><img src="data:image/jpeg;base64,<?php echo $data['primary_image'] ?>" alt=""
                            class="w-75" onerror="this.onerror=null; this.src='../../product-icon.png';"></div>
                    <div class="col-10"><span>
                            <?php echo $data['trunkName']; ?>
                        </span></div>
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
<script>
    // $(document).ready(function () {
    //script in footer
    // });
</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="show_new_launch">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info text-white" id="activeNewLaunch">Active</button>
                <!-- <button type="button" class="btn btn-danger text-white" id="deactiveNewLaunch">Deactive</button> -->
            </div>
        </div>
    </div>
</div>



<?php include "footer.php" ?>