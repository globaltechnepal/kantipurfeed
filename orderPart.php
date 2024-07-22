<?php
// include 'header.php'; 
$displaying_product_id = "";
if(isset($_GET['Product'])){
 $displaying_product_id = $_GET["Product"];
//  echo "Display product ID: " . $displaying_product_id . ""; 
}
$query = "SELECT p.product_name,p.`product_code`,p.`specification`,p.actual_Price,p.sell_Price,c.category_name,clr.color_name,pv_img.img_path,pv_img.img,pv.id as pv_id from products p
                  inner join category c on p.category_id=c.category_id
                  inner join productvariant pv on pv.product_id=p.id
                  inner join productvariant_image pv_img on p.id=pv_img.product_varient_id
                  inner JOIN colors clr on pv.color_id=clr.id where p.id=$displaying_product_id;";
$data = run_query($query);
$product_name = '';
$product_code = '';
$product_specification = '';
$product_actual_price = '';
$product_sell_price = '';
$category_name = '';
$image_api = '';
$color = [];
$i = 1;
foreach ($data as $val) {
    $color[$i] = $val['color_name'];
    $i++;
}
$paths = [];
$i = 1;
foreach ($data as $val) {
    $paths[$i] = $val['img_path'] . strtolower($val['color_name']) . '/';
    $i++;
}

$pv_id = [];
$i = 1;
foreach ($data as $val) {
    $pv_id[$i] = $val['pv_id'];
    $i++;
}

if ($data != 0) {
    echo '<div class="text-white">';
    foreach ($data as $val) {
        $product_code=$val['product_code'];
        $product_specification =$val['specification'];
        $product_name = $val['product_name'];
        $category_name = $val['category_name'];
        $product_actual_price = $val['actual_Price'];
        $product_sell_price = $val['sell_Price'];
        $image_api = $val['img'];
        // echo "<script>alert($product_sell_price);</script>";
    
    }
    echo '</div>';
}
// $images = images_in_folder($paths[1]);
// $total = count($images);

$image_api = $val['img'];
// for only progress bar 
$query_progress = "SELECT `stock_in`, `stock_out` FROM `productvariant` WHERE product_id=$displaying_product_id;";
$progress_data = run_query($query_progress);
$total_stock_in = 0;
$total_stock_out = 0;
foreach ($progress_data as $values) {
    $total_stock_in = $total_stock_in + $values['stock_in'];
    $total_stock_out = $total_stock_out + $values['stock_out'];
}
$progress_bar_value = ($total_stock_out / $total_stock_in) * 100;
$sales_percentage = availableStock($displaying_product_id);
$progress_bar_value =$sales_percentage;

?>
<div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xxl-2 lh-1 bg-white">
    <!-- first half  -->
    <div class="col ">
        <div class="row row-cols-3 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xxl-6 lh-1">
            <!-- product dispaly part -->
            <div class="col-4 product_image_display_part" id="product_image_display_part" style="overflow:scroll;">
                <!-- image lists  -->
                
                <!-- for ($li = 0; $li < $total; $li++) { -->
                
                <button class="mb-2" style="border: 1px solid #e1e1e1; border-radius: 10px;">
                    <img class="w-75 feature_img" src="data:image/png;base64,<?php echo $image_api; ?>" onerror="this.onerror=null; this.src='No-Image-Placeholder.png';">
                </button>

                <!-- } -->
                
                <!-- image lists  -->
            </div>
            <div class="col-8" style="overflow:hidden;max-height:60vh;">
                <!-- image display pannel  -->
                <img src="data:image/png;base64,<?php echo $image_api; ?>" onerror="this.onerror=null; this.src='No-Image-Placeholder.png';" class="w-100" id="display">
                <!-- image display pannel  -->
            </div>
            <!-- product dispaly part -->
        </div>
    </div>
    <!-- first half  -->
    <!-- second half  -->
    <div class="col">
        <div class=" pt-3 pb-1">
            <!-- progress bar  -->
            <div class="progress">
                <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated fw-bold text-dark rounded"
                    role="progressbar" style="width: <?php echo $progress_bar_value; ?>%" aria-valuenow="55"
                    aria-valuemin="0" aria-valuemax="100"><div style="position:absolute;">Sold <?php echo $progress_bar_value; ?>%</div>
                </div>
            </div>
            <!-- progress bar  -->
            <!-- Product Details -->
            <div class="h3">
                <?php echo $product_name; ?>
            </div>
            <div class="product-type text-uppercase">
                <?php echo $category_name; ?>
            </div>
            <!-- Product Details -->
            <div class="">
                <?php echo "Product Code : ".$product_code; ?>
            </div>
            <div class="">
                <?php echo "Specification : ".$product_specification; ?>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xxl-2 lh-1 ">
            <div class="col">
                <!-- reviews part  -->
                <div class="fw-bold col-12 px-0 py-3 fs-5">
                    <small class="text-danger" id="review_stars">
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>
                    </small>
                    <span id="average_rating_top"></span> | <span id="total_review_top"></span> Reviews
                    <small><i class="bi bi-patch-check-fill text-success"></i></small>
                </div>
                <!-- reviews part  -->
                <!-- product variety part -->
                <hr class="m-0">
                <div class="d-flex justify-content-between align-items-baseline product-form__option-info">
                    <div class="p-2">
                        <span class="text-capitalize product-form__option-name"></span>
                        <span id="option-template--14357041315938__main--4460669370466-1-value"
                            class="product-form__option-value pt-3 pb-3">
                            <a style="text-decoration: none; color: black; font-weight: bold;" data-bs-toggle="collapse"
                                href="#multiCollapseExample1" role="button" aria-expanded="false"
                                aria-controls="multiCollapseExample1">Color : <span id="d_color_name">
                                    <?php echo $color[1]; ?>
                                </span> </span>
                    </div>
                    <img class="varnt-drop h-100"> <i class="bi bi-caret-down-fill"></i></a>
                </div>
                <div class="collapse multi-collapse show" id="multiCollapseExample1">
                    <div class="d-flex flex-wrap" id="varient_images">
                        <?php
                        foreach ($data as $val) {
                        ?>
                        <button class="col-4 btn product_varient" type="button"
                            data-pv_id="<?php echo $val['pv_id']; ?>" data-color="<?php echo strtolower($val['color_name']); ?>"
                            data-folder_path="<?php echo $val['img_path'] .strtolower($val['color_name']). '/'; ?>">
                            <img class="w-100" src="data:image/png;base64,<?php echo $val['img']; ?>" onerror="this.onerror=null; this.src='No-Image-Placeholder.png';">
                        </button>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <hr>
                <!-- product variety part -->
            </div>
            <div class="col">
                <!-- product price and order part  -->
                <div class="card col-auto p-2 m-1" style="background:#efefef;font-size:15px;">
                    <!-- row 1 PRICE-->
                    <div class="d-flex flex mt-2">
                        <div class="pe-1 col-6 " style="color:#616161"><del>₹
                                <?php echo $product_actual_price; ?>
                            </del>
                            <br>
                            <div class="custom-saved-price"
                                style="letter-spacing: -0.045em;  color: #00C68C;  font-weight: 600; font-size: 14px; line-height: 20px;">
                                You Save: ₹
                                <?php echo $product_actual_price - $product_sell_price; ?> (
                                <?php $percent = 100 - (($product_sell_price / $product_actual_price) * 100);
                                echo round($percent, 2); ?>%)
                            </div>
                        </div>
                        <div class="fw-bold col-6" style="color:red">
                            ₹
                            <?php echo $product_sell_price; ?> <i class="bi bi-lightning-charge-fill"
                                style="color:#fbc50b"></i>
                            <br>
                            <div class="inclusive fw-normal" style="color:#616161">Inclusive of all taxes</div>
                        </div>
                    </div>
                    <!-- row 1 -->
                    <!-- row 2 STOCK-->
                    <div class="d-flex  justify-content-between mt-2 py-2" style="background: #DCDCDC;">
                        <div class="fw-normal m-auto rounded"><strong
                                style="color: rgb(2, 136, 96); visibility: visible;">Available In Stock
                                <!-- 105<small> units</small> -->
                            </strong></div>
                    </div>
                    <!-- row 2 -->
                    <!-- row 3 COUNTER-->
                    <div class="col-12 m-auto text-center">
                        <?php
                        include "product_counter.php";
                        ?>
                    </div>
                    <!-- row 3 -->
                    <!-- row 4 ADD TO CART-->
                    <div class="col-12 mt-2">
                        <input type="hidden" value="<?php echo $pv_id[1]; ?>" id="pv_id_selected">
                        <input type="hidden" value="1" id="pv_id_selected_quantity">
                        <button type="button" class="btn col-12 fw-bold" style="background:red; color:white;"
                            id="addToCartBtn">ADD TO CART</button>
                    </div>
                </div>
                <!-- product price and order part  -->
            </div>
        </div>
    </div>
    <!-- second half  -->
</div>


<!-- script start here  -->
<!-- top part start -->
<script>
    $(document).ready(function () {
        $('.product_varient').click(function () {
            var path = $(this).attr("data-folder_path");
            var color = $(this).attr("data-color");
            var pvb_id = $(this).attr("data-pv_id");
            $("#pv_id_selected").val(pvb_id);
            $("#d_color_name").text(color);
            // alert(path);
            $.ajax({
                url: 'assets/library/orderpart_control.php',
                type: 'POST',
                data: { get_images_from_folder: path },
                datatype: 'JSON',
                success: function (data) {
                    // console.log(data);
                    var d = JSON.parse(data);
                    // console.log(d);
                    // console.log(d.status_code);
                    var len = d.data.length;
                    // console.log(len);
                    $("#product_image_display_part").empty();
                    for (var i = 0; i < len; i++) {
                        if (i == 0) {
                            $("#display").attr("src", d.path + d.data[i]);
                        }
                        var html = '';
                        html += '<button class="mb-2" style="border: 1px solid #e1e1e1; border-radius: 10px;">';
                        html += '<img class="w-75 feature_img" src="' + d.path + d.data[i] + '">';
                        html += '</button>';
                        $("#product_image_display_part").append(html);
                    }
                }
            });
        });
        // $('#varient_images').empty();
    });
</script>
<!-- top part end -->
<script>

    $(function () {
        $("#load_images_from_folder").click(function () {
            alert(load_images_from_folder);
            var path = $(this).attr("data-folder_path");
            alert(path);
            $.ajax({
                url: 'assets/library/orderpart_control.php',
                type: 'POST',
                data: { get_images_from_folder: path },
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
                    var d = JSON.parse(data);
                    console.log(d);
                    console.log(d.status_code);
                    var len = d.data.length;
                    console.log(len);
                    for (var i = 1; i < len; i++) {
                        $("#display-box").append('<div class="col"><img class="w-100" src="' + d.path + d.data[i] + '"></div>');
                    }
                }
            });

        });
        $(document).on("click", ".feature_img", function () {
            //for dynamic track primary image name and secondary imagename along with paths
            var imgName2 = $(this).attr('src');
            $("#display").attr("src", imgName2);
        });
        $(document).on("click", "#addToCartBtn", function () {
            // alert("clicked");
            var selected_pv_id = $("#pv_id_selected").val();
            var quantity = $("#pv_id_selected_quantity").val();
            var cart_id = $("#cart_id").attr("data-cart_id");
            // alert("ID is : " + selected_pv_id + " please proceed.");
            $.ajax({
                url: 'assets/library/productCartControl.php',
                type: 'POST',
                data: { addToCart: cart_id, pv_id: selected_pv_id, quantity: quantity },
                datatype: 'JSON',
                success: function (data) {
                    console.log(data);
                    var d = JSON.parse(data);
                    console.log(d);
                    if (d.status_code == "200") {
                        // alert("DONE");
                        //   $("#closeColorSelect").click();
                        $("#lnkCart").click();
                    }
                    else if (d.status_code != "200") {
                        alert("NOT DONE");
                    }
                },
                error: function (er) {
                    console.log(er);
                }
            });
        });
    });
</script>
<!-- script start here  -->

<?php
// include 'footer.php'; 
?>