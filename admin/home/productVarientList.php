<?php  include "header.php" ?>
<style>
    table.dataTable tbody td {
  padding: 0px 10px;
}
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }
</style>
<div class="col-12">
    <div class="col-12">
        <div class="col-12 d-flex">
            <?php
                $p_ID = $_GET['id'];
                $query="SELECT  pv.`id` as pvIDH,p.`id` AS pid, `product_name`,`primary_image` FROM `productvariant` pv
                RIGHT JOIN products p on p.id= pv.product_id WHERE p.id=$p_ID limit 1";
                $conn = dbConnecting();
                $req = mysqli_query($conn,$query) or die(mysqli_error($conn));
                if(mysqli_num_rows($req)>0){
                while($data = mysqli_fetch_assoc($req)){ ?>
            <div class="p-1 mb-2 me-2 bg-dark text-white text-center" style="width:auto">PRODUCT VARIENT :&nbsp;
                <?php echo $data['product_name']; ?>
            </div>
            <!-- add verient button -->
            <!-- add verient button -->
            <!-- added by bikesh  -->
            <input type="hidden" name="data-products-id" id="productGetID" value="<?php echo $data['pid']; ?>">
            <img src="<?php echo $data['primary_image'] ?>" alt="" id="productVarientImage" hidden>
            <!-- added by bikesh  -->
            <button type="button" class="btn ms-3 btn-outline-secondary mb-2 productCls" data-bs-target="#exampleModalToggle"
            href="#exampleModalToggle" data-products-id="<?php echo $data['pid']; ?>" data-products-name="<?php echo $data['product_name']; ?>"
             data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add Verient</button>
            <!-- add verient button -->
            <!-- add verient button -->
                <?php 
                }
            }
        ?>
        </div>
    </div>
    <!-- datatable start -->
    <!-- datatable start -->
    <table id="table_id" class="display" style="font-size:1rim;">
        <thead>
            <tr>
                <th>S.N</th>
                <th>Product Name</th>
                <th class="col-1">Product Image</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Add Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $pid = $_GET['id'];
        $showQRY ="select pv.`id`as pvIDS,p.`id` as productID,pi.id AS pvImageID,`stock_in`,`stock_out`,`defective`, `returned`, `available`, `total`,pi.`img_path`,`img`,`product_name`,clr.`id` as clriD,`color_name` from products p inner join productvariant pv on pv.product_id=p.id 
                   left outer join productvariant_image pi on p.id=pi.product_varient_id
                   LEFT OUTER JOIN colors clr ON clr.id = pv.color_id
                   where p.id=$pid order by pv.id";
        $conn = dbConnecting();
        $req = mysqli_query($conn,$showQRY) or die(mysqli_error($conn));
        if(mysqli_num_rows($req)>0){
        $i=1;
        while($data=mysqli_fetch_assoc($req)){?>
            <tr>
            <input type="hidden" value="<?php echo $data['pvIDS'] ?>" id="pVerientGetID">
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <?php echo $data['product_name']; ?>
                </td>
                <td class="text-center"><img src="data:image/jpeg;base64,<?php echo $data['img']; ?>" style="width:100%;height:50px;" onerror="this.onerror=null; this.src='../../product-icon.png';">
                </td>
                <td>
                    <?php echo $data['color_name']; ?>
                </td>
                <td>
                    <?php echo $data['available']; ?>
                </td>
                <td>
                <?php if($data['img']!=""){
                    ?>
                    <a disabled class="text-secondary"  id="addImageBtn">
                    <i class="bi bi-plus-circle-fill"></i></a>
                    <?php
                }else{?>
                        <a class="text-primary addFeatureImage" id="addImageBtn" data-bs-target="#exampleModalToggle4"
                            href="#exampleModalToggle4" data-bs-toggle="modal" data-pv-id="<?php echo $data['pvIDS'] ?>"
                            data-Vcolor-name="<?php echo strtolower($data['color_name']); ?>" data-vproduct-Name="<?php echo $data['product_name'] ?>">
                            <i class="bi bi-plus-circle-fill"></i></a>
              <?php  }   
                ?> 
                </td>
                <td><a class="updateClassP" 
                data-updateproducts-id="<?php echo $data['productID']; ?>" 
                data-updateproducts-name="<?php echo $data['product_name']; ?>" 
                data-color-id="<?php echo $data['clriD']; ?>" 
                data-products-color_name="<?php $clrName=strtolower($data['color_name']); echo $clrName; ?>"
                data-products-stock_in="<?php echo $data['stock_in']; ?>" 
                data-products-stock_out="<?php echo $data['stock_out']; ?>" 
                data-products-defective="<?php echo $data['defective']; ?>" 
                data-products-returned="<?php echo $data['returned']; ?>" 
                data-products-VID="<?php echo $data['pvIDS']; ?>" 
                data-products-VImageID="<?php echo $data['pvImageID']; ?>" 
                data-products-imagePath="<?php echo $data['img_path']; ?>" 
                data-products-img="<?php echo $data['img']; ?>" 
                data-bs-target="#exampleModalToggle1" href="#exampleModalToggle1" data-bs-toggle="modal">
                <i class="bi bi-check2-circle"></i></a>
                
                    <a type="submit" name="deleteProductVarient" class="text-danger ms-2 text-center delete_item" data-del_item_name="product_variant" data-del_item_id="<?php echo $data['pvIDS']; ?>">
                        <i class="bi bi-trash-fill"></i></a>
                </td>
            </tr>
            <?php
        $i++;
        }
        }
        ?>
        </tbody>
    </table>
    
    <script> 
        $(document).ready(function(){
            $("#addImageBtn").attr("disabled","disabled");
    // alert(".delete_item part function hit_server is now in footer.php");
        });
    </script>
    <!-- datatable end -->
    <!-- datatable end -->
</div>
</div>

<!-- add product varient -->
<!-- add product varient -->
<script>
    $(".productCls").click(function () {
        var pID = $(this).attr("data-products-id");
        var PName = $(this).attr("data-products-name");
        $("#productID").attr("value", pID.trim());
        $("#PName").attr("value", PName.trim());
    });
</script>
<div class="modal ms-5 ps-5" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle"
    tabindex="-1">
    <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
        <div class="modal-content ms-5">
            <div class="p-3 mb-2 bg-dark text-white text-center">Add Product Varient</div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="container col-11">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2 p-3 mb-2"
                        style="border:1px solid gray">
                        <div class="col p-3">
                            <span class="input-group-text">Product Color : &nbsp;
                                <select class="form-select clear_Form_data" id="color_name" name="color_name">
                                    <?php 
                                $ChoseColorQRY = "SELECT * FROM `colors` WHERE `color_name` NOT IN(SELECT colors.color_name FROM colors INNER JOIN `productvariant` on productvariant.color_id=colors.id
WHERE `product_id`=".$_GET['id'].")";
                                $conn = dbConnecting();
                                $req = mysqli_query($conn,$ChoseColorQRY) or die(mysqli_error($conn));
                                if(mysqli_num_rows($req)>0){
                                while($data=mysqli_fetch_assoc($req)){?>
                                    <option  value="<?php echo $data['id'] ?>">
                                        <?php echo $data['color_name'] ?>
                                    </option>
                                    <?php
                                }
                                }
                                ?>
                                </select>
                            </span>
                        </div>

                    <input type="hidden" class="form-control" id="productID" name="productID">
                    <div class="col p-3">
                        <span class="input-group-text">Stock IN : &nbsp;
                        <input type="text" class="form-control clear_Form_data" name="stock_in" id="stock_in"></span>
                    </div>
                    <div class="col p-3">
                        <span class="input-group-text">Defective : &nbsp;
                        <input type="text" class="form-control clear_Form_data" name="defective" id="defective" value="0"></span>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-danger" name="pVarientSubmit" id="pVarientSubmit">Submit</button>
                        <button type="button" class="btn btn-secondary close_called" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
    // $("#pVarientSubmit").click(function () {
    //     // alert("I am clicked");
    //     var productID = $("#productID").val();
    //     var color_name = $("#color_name").val();
    //     var stock_in = $("#stock_in").val();
    //     var defective = $("#defective").val();
    //     if (productID=="" || color_name == "" || stock_in == "" ){
    //         alert("Input field are empty. Please fill the form properly");
    //         return false;
    //     }
    //     else {
    //         $.ajax({
    //             url: "library/database.php",
    //             method: "POST",
    //             data: { color_name: color_name, productID: productID,stock_in: stock_in, defective: defective},
    //             success: function (data) {
    //                 var da = JSON.parse(data);
    //                 if(da.status_code==200){
    //                 alert("Success");
    //                 location.reload();
    //                 }else{
    //                     alert("Error");
    //                 }
    //             }
    //         });
    //     }
    // });
    </script>
<!-- add product  varient -->
<!-- add product  varient --> 

<!-- add product image varient -->
<!-- add product image varient -->
<script>
$(".addFeatureImage").click(function(){
    var pvIDaayo = $(this).attr("data-pv-id");
    var pvcoloraayo = $(this).attr("data-Vcolor-name").toLowerCase();
    var pvProductNameaayo = $(this).attr("data-vproduct-Name");
    $("#pverientID").attr("value", pvIDaayo.trim());
    $("#pverientclrName").attr("value", pvcoloraayo.trim());
    $("#pverientProductName").attr("value", pvProductNameaayo.trim());
})
</script>
<div class="modal ms-5 ps-5" id="exampleModalToggle4" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle4" tabindex="-1">
    <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
        <div class="modal-content ms-5">
            <div class="p-3 mb-2 bg-dark text-white text-center">Add Product Varient</div>
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="container col-11">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2 p-3 mb-2"
                        style="border:1px solid gray">
                    <div class="col p-3">
                        <input type="hidden" id="pverientID" name="pverientID">
                        <input type="hidden" id="pverientclrName" name="pverientclrName">
                        <input type="hidden" id="pverientProductName" name="pverientProductName">
                        <input type="hidden" id="PName" name="PName">
                        <h1 class="fs-5 fw-bold">Feature Images :</h1>
                        <span class="input-group-text"> &nbsp;
                        <input type="file" class="form-control" onchange="feature_image()" accept="image/png, image/jpeg" name="fimg" id="fimg"></span>
                        <p class="m-3 text-danger fs-5">Note : Photo must be transperent and 400*400 pixel image</p>
                    </div>
                    <div class="col p-3">
                        <h1 class="fs-5 fw-bold">Display Images :</h1>
                        <span class="input-group-text"> &nbsp;
                        <input type="file" class="form-control" onchange="display_image()" accept="image/png, image/jpeg" name="dimg" id="dimg" multiple></span>
                        <p class="m-3 text-danger fs-5">Note : Select atmost 8 photos and Photo must 400*400 pixel image.</p>
                    </div>
                    <div class="col-12 text-center">
                        <button type="button" class="btn btn-danger" name="pVarientImageSubmit" id="pVarientImageSubmit">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<script>

// Product varient list 
// Product varient list 
function pVariantSubmit() {
    var getProductApi = $("#get_product_api").val();
    // alert(getProductApi);
    $.ajax({
        url: getProductApi,
        method: 'GET',
        success: function(response) {
            var products = response.data; 
            for (var i = 0; i < products.length; i++) {
                var product = products[i];
                
                var PCode = product.PCode;
                var StockQty = product.StockQty;

                $.ajax({
                    url: "library/api_product_veriant.php",
                    method: "POST",
                    data: {
                        PCode: PCode,
                        StockQty: StockQty
                    },
                    success: function(data) {
                        try {
                           
                            var da = JSON.parse(data);
                            console.log('Product stock added successfully:', da.StockQty);
                        } catch (error) {
                            console.log('Received non-JSON data:', data);
                        }
                    },
                    error: function(error) {
                        console.error('Error adding product stock:', error);
                    }
                });
                //   alert("Data sent in POST request: PCode - " + PCode + ", StockQty - " + StockQty);
            }
        },
        error: function(error) {
            // Handle errors for product retrieval
            console.error('Error fetching product list:', error);
        }
    });
}

pVariantSubmit();
// Product varient list 
// Product varient list 



 // add product varient image
 // add product varient image
    function pVarientImageSubmit() {
      var getProductApi = $("#get_product_api").val();
$.ajax({
    url: getProductApi,
    method: 'GET',
    success: function(response) {
        // Data retrieval successful
        var products = response.data; // Assuming 'data' contains an array of products

        // Process each product
        for (var i = 0; i < products.length; i++) {
            var product = products[i]; 

            // Extract product details
            var PCode = product.PCode;
            var PImage = product.PImage;
         
            // Make a POST request to add the product to the database
            $.ajax({
                url: "library/api_product_varient_image.php",
                method: "POST",
                data: {
                    // Pass product details as POST parameters
                    PCode: PCode,
                    PImage: PImage
                },
                success: function(data) {
                    try {
            // Try to parse the data as JSON
            var da = JSON.parse(data);
            console.log('Product Varient Image added successfully:', da.PDesc);
            // Further actions if needed after parsing JSON
        } catch (error) {
            // Handle non-JSON data
            console.log('Received non-JSON data:', data);
            // Further actions for non-JSON data
        }
                },
                error: function(error) {
                    // Handle errors for individual product addition
                    console.error('Error adding product varient image:', error);
                }
            });
        }
    },
    error: function(error) {
        // Handle errors for product retrieval
        console.error('Error fetching product list:', error);
    }
});
}

pVarientImageSubmit(); 
// add product varient image
// add product varient image


    // $("#pVarientImageSubmit").click(function(){
    // // alert("i am click");
    // var pverientID = $("#pverientID").val();
    // var pverientPname = $("#pverientProductName").val();
    // // alert(pverientID);
    // // alert(pverientPname);
    // var fimg = $("#fimg").val().replace(/C:\\fakepath\\/i, '');
    // var dimg = $("#dimg").val().replace(/C:\\fakepath\\/i, '');
    // if(fimg==""|| dimg==""|| pverientID==""|| pverientPname==""){
    // alert("Form field are empty. Please fill the form properly");
    // return false;
    // }
    // else{
    //     // alert(pverientID);
    //     // alert(fimg);

    //     $.ajax({
    //         url: "library/database.php",
    //         method: "POST",
    //         data: {fimg: fimg,pverientID:pverientID,dimg:dimg,pverientPname:pverientPname},
    //         success: function (data) {
    //             var da = JSON.parse(data);
    //                 if(da.status_code==200){
    //                 alert("Success");
    //                 location.reload();
    //                 }else{
    //                     alert("Error");
    //                 }
    //         }
    //     });
    // }
    // })
// add product varient image
// add product varient image
</script>
<script>
    async function feature_image() {
        let formData = new FormData();
        formData.append("folderid",$("#pverientProductName").val());
        formData.append("file", fimg.files[0]);
        await fetch('library/feature_image.php', {
            method: "POST",
            body: formData
        });
    }
</script>
<script>
     async function display_image() {
        let formData = new FormData();
        formData.append("folderDisplayid", $("#pverientclrName").val());
         formData.append("folderVerientid", $("#pverientID").val());
        formData.append("folderDisplayName", $("#pverientProductName").val());
       
    for(var i=0;i<dimg.files.length;i++){
      formData.append("file", dimg.files[i]);
    await fetch('library/displayImage.php', {
        method: "POST",
        body: formData
    });
   }
   }
   </script>
<!-- add product image varient -->
<!-- add product image varient --> 

<!-- update product varient -->
<!-- update product varient -->
<script>
function getRemainingColors(product,identifier,hasValue){
    var data_is=hasValue;
    $.ajax({
                url: 'library/httpRequest.php',
                type: 'POST',
                data: {not_used_color_of:product },
                datatype: 'json',
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    // console.log(da);
                    if(da.status_code==200){
                        
                    // console.log(data_is);
                    data_is = data_is+da.htm;
                    // console.log(data_is);
                    $(identifier).empty();
                    $(identifier).append(data_is);
                    }
                    // show_response(da);
                    // jQuery.each(da.images, function (i,img){
                        // console.log(img);
                    // });
                    data='';
                },
                error: function (jqXHR, textStatus, errorThrown) { alert("Please Refresh.");location.reload(); }
            });
}
    $(".updateClassP").click(function () {
    var product_id = $(this).attr("data-updateproducts-id");
    var clrID = $(this).attr("data-color-id");
    var clrName = $(this).attr("data-products-color_name");
    var stockIn = $(this).attr("data-products-stock_in");
    var stockOut = $(this).attr("data-products-stock_out");
    var defeCtive = $(this).attr("data-products-defective");
    var retUrned = $(this).attr("data-products-returned");
    var ImgPatH = $(this).attr("data-products-imagePath");
    var ImaGe = $(this).attr("data-products-img");
    if(stockIn.length<1){
        stockIn='0';
    }
    if(stockOut.length<1){
        stockOut='0';
    }
    if(defeCtive.length<1){
        defeCtive='0';
    }
    if(retUrned.length<1){
        retUrned='0';
    }
    var available_stock=parseInt(stockIn)-parseInt(stockOut)-parseInt(defeCtive)+parseInt(retUrned);
    $("#updateRemaining").val(available_stock);
    $("#updateRemaining").attr("data-available_stock",available_stock);
    $("#previous_stock").text(stockIn);
    $("#sold_stock").text(stockOut);
    $("#updateStock_out").attr('previous_sales',stockOut);
    $("#defective_stock").text(defeCtive);
    $("#returned_stock").text(retUrned);
    $("#updateProductID").val( $(this).attr("data-updateproducts-id").trim()); 
    $("#updateProductName").val($(this).attr("data-updateproducts-name").trim());
    $("#updateclrName").val($(this).attr("data-products-color_name").trim());
    $("#updatePvImageID").val($(this).attr("data-products-VImageID").trim()); 
    $("#updatePverientID").val($(this).attr("data-products-VID").trim()); 
    // $("#Updatecolor_name").empty();
    var optn='<option value="'+clrID.trim()+'">'+clrName+'</option>';
    getRemainingColors(product_id,"#Updatecolor_name",optn);
    $("#Updatecolor_name").val(clrID.trim());
    $("#Updatecolor_name").attr('data-previous_color_id',clrID.trim()); 
    // show image
    // show image
    $("#viewPVFeatureImg").attr("src", "../../" + ImgPatH.trim() + ImaGe);
    $("#hidFeatureImage").val(ImaGe.trim());
    // show image
    // show image
    var path = "../../" + ImgPatH.trim()+clrName+"/";
    // show image
        // show image disp_images_from_folder
        $("#viewPVDisplayImg").empty();
        $.ajax({
                url: 'library/httpRequest.php',
                type: 'POST',
                data: {disp_images_from_folder:path },
                datatype: 'json',
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                    var da = JSON.parse(data);
                    if(da.status_code==200){
                    jQuery.each(da.images, function (i,img){
                        // console.log(img);
        $("#viewPVDisplayImg").append('<div><button type="button" class="del_this p-1 m-1" title="Delete" data-imgName="'+img.trim()+'" data-path="../../'+ImgPatH.trim()+clrName+"/"+'" ><img src="../../'+ImgPatH.trim()+clrName+"/"+img.trim()+'" alt="aba"></button></div>');
                    });
                    }else{
                        alert("Error");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) { alert("Server Error! Please Refresh.");location.reload(); }
            });
        $("#exampleModalToggle1").show();
    });
    </script>
<div class="modal ms-5 ps-5" id="exampleModalToggle1" data-bs-backdrop="static">
  <div  class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Update Product Varient</div>
         <form action="#" method="post" enctype="multipart/form-data">
                <div class="container col-11">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xxl-2 p-3 mb-2"
                        style="border:1px solid gray">
                        <div class="col p-3">
                            <input type="hidden" class="form-control" id="updateProductID" name="updateProductID">
                            <input type="hidden" class="form-control" id="updateProductName" name="updateProductName">
                            <input type="hidden" class="form-control" id="updateclrName" name="updateclrName">
                            <span class="input-group-text">Product Color : &nbsp;
                                <select class="form-select" id="Updatecolor_name" name="Updatecolor_name">
                                <?php 
                                $ChoseColorQRY = "SELECT * FROM `colors` WHERE `color_name` NOT IN(SELECT colors.color_name FROM colors INNER JOIN `productvariant` on productvariant.color_id=colors.id
WHERE `product_id`=".$_GET['id'].")";
                                $conn = dbConnecting();
                                $req = mysqli_query($conn,$ChoseColorQRY) or die(mysqli_error($conn));
                                if(mysqli_num_rows($req)>0){
                                while($data=mysqli_fetch_assoc($req)){
                                ?>
                                <option  value="<?php echo $data['id'] ?>">
                                    <?php echo $data['color_name'] ?>
                                </option>
                                <?php
                                }
                                }
                                ?>
                                </select>
                            </span>
                        </div>

                    <div class="col p-3">
                        <span class="input-group-text">Add Stock : &nbsp;
                        <span style="position:absolute;top: -.3rem;left: 1.6rem;">Total Stock : <strong id="previous_stock"></strong> units.</span>
                        <input type="text" class="form-control clear_Form_data numbers_only changed_add_stock detect_change " name="updateStock_in" id="updateStock_in"></span>
                    </div>
                    <div class="col p-3">
                        <span class="input-group-text">Add Sold Units : &nbsp;
                        <span style="position:absolute;top: -.3rem;left: 1.6rem;">Sold Unit : <strong id="sold_stock"></strong> units.</span>
                            <input type="text" class="form-control clear_Form_data numbers_only changed_add_stock_out detect_change check_max" name="updateStock_out" id="updateStock_out"></span>
                    </div>
                    <div class="col p-3">
                        <span class="input-group-text">Add Defective : &nbsp;
                        <span style="position:absolute;top: -.3rem;left: 1.6rem;">Defective Unit : <strong id="defective_stock"></strong> units.</span>
                        <input type="text" class="form-control clear_Form_data numbers_only changed_add_stock_defected detect_change check_max" name="updateDefective" id="updateDefective"></span>
                    </div>
                    <div class="col p-3">
                        <span class="input-group-text">Add Returned : &nbsp;
                        <span style="position:absolute;top: -.3rem;left: 1.6rem;">Returned unit : <strong id="returned_stock"></strong> units.</span>
                        <input type="text" class="form-control clear_Form_data numbers_only changed_add_stock_returned detect_change check_max_return" name="updateReturned" id="updateReturned"></span>
                    </div>
                    <div class="col p-3">
                        <span class="input-group-text">Stock Avalable for sale : &nbsp;
                        <input type="text" readonly class="form-control clear_Form_data numbers_only" name="updateRemaining" id="updateRemaining"></span>
                    </div>
                    <div class="col-12 mb-3">
                      <label for="update_review" class="form-label">Update Review</label>
                      <textarea class="form-control" id="update_review" rows="3"></textarea>
                    </div>
                        <input type="hidden" class="form-control" name="updateTotal" id="updateTotal"></span>
                    <hr class="w-100 pe-1">
                    <div class="col p-3">
                        <input type="hidden" id="updatePverientID" name="updatePverientID">
                        <input type="hidden" id="updatePvImageID" name="updatePvImageID">
                        <input type="hidden" id="hidFeatureImage" name="hidFeatureImage">  
                        <h1 class="fs-5 fw-bold">Feature Images :</h1>
                        <span class="input-group-text"> &nbsp;
                        <input type="file" class="form-control" onchange="Updatef_image()" accept="image/png, image/jpeg" name="updatefimg" id="updatefimg"></span>
                        <div class="col-12 text-center">
                            <img id="viewPVFeatureImg" name="viewPVFeatureImg" class="w-50">
                        </div>
                        <p class="m-3 text-danger fs-5">Note : Photo must be transperent and 400*400 pixel image</p>

                    </div>
                    <div class="col p-3">
                        <h1 class="fs-5 fw-bold">Display Images :</h1>
                        <span class="input-group-text"> &nbsp;
                        <input type="file" class="form-control" onchange="Updated_image()" accept="image/png, image/jpeg" name="updatedimg" id="updatedimg" multiple></span>
                        <div id="viewPVDisplayImg" class="d-flex" style="flex-wrap: wrap;">display images</div>
                                <br>
                        <span class="m-3 text-danger fs-5">Note : Select atmost 8 photos and Photo must be 400*400 pixel image</span>
                    </div>
                    <div class="col-12">
                        <button type="button" class="btn btn-danger" name="UpdatepVarientSubmit" id="UpdatepVarientSubmit">Submit</button>
                        <button type="button" class="btn btn-secondary close_called" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
  </div>
</div>
<script>
function change_detector(){
    var count=0;
    $(".detect_change").each(function () {
        var data=$(this).val();
       if(data.length>=1 && parseInt(data) != 0){
           count++;
       }
    });
    var old_color_name = $("#Updatecolor_name").attr('data-previous_color_id'); 
    var Updatecolor_name = $("#Updatecolor_name").val(); 
    if(old_color_name!=Updatecolor_name){
        count++;
    }
    if(count>0){
        return 1;
    }else{
        return 0;
    }
}
function control_stock_calculation(hasValue){
    hasValue = parseInt(hasValue);
    var max_val = $("#updateRemaining").val();
    max_val=parseInt(max_val);
    if(hasValue<max_val){
        return hasValue;
    }else if(hasValue>max_val){
        return 0;
    }
}
$(".check_max").on('keyup',function(){
    var hasValue = $(this).val();
    var calc_val = control_stock_calculation(hasValue);
    if(calc_val==0){
        alert('maximum Value exceed');
    }
    $(this).val(calc_val);
});
$(".check_max_return").on('keyup',function(){
    var hasValue = parseInt($(this).val());
    if(hasValue<1){
        hasValue=0;
    }
    var changeVal=$("#updateStock_out").val();
    if(changeVal.length<1 || parseInt(changeVal)<1){
        changeVal='0';
    }
    changeVal=parseInt(changeVal);
    var old_sales = parseInt($("#updateStock_out").attr('previous_sales'));
    if(old_sales<1){
        changeVal=0;
    }
    // alert(old_sales);
    var max_val = changeVal+old_sales;// alert('Total max '+max_val);
    if(hasValue>max_val){
    alert('maximum Value exceed');
    $(this).val(0);
    }else{
    $(this).val(hasValue);
    }
});
    $("#UpdatepVarientSubmit").click(function(){
    // alert("I am clicked");
    var Updatecolor_name = $("#Updatecolor_name").val(); 
    var updateProductID = $("#updateProductID").val();
    var updateProductName = $("#updateProductName").val();
    var updateStock_in = $("#updateStock_in").val();
    var updateStock_out = $("#updateStock_out").val();
    var updateDefective = $("#updateDefective").val();
    var updateReturned = $("#updateReturned").val();
    var updatePverientID = $("#updatePverientID").val();
    var updatePvImageID = $("#updatePvImageID").val();
    var updatefimg = $("#updatefimg").val().replace(/C:\\fakepath\\/i, '');
    var updatedimg = $("#updatedimg").val().replace(/C:\\fakepath\\/i, '');
    var remarks = $('#update_review').val();
    var has_change = change_detector();
    // alert(has_change);
    if(updatefimg==""){
    updatefimg = $("#hidFeatureImage").val();
    }
    if(updateProductID==""|| updateProductName==""|| has_change==0|| updatePverientID==""||updatePvImageID==""){
    alert("Please Fill The Form Properly");
    return false;
    }
    else{
    $.ajax({
        url:"library/database.php",
        method:"POST",
        data:{ Updatecolor_name: Updatecolor_name, updateProductID:updateProductID,updateProductName:updateProductName,updateStock_in:updateStock_in,updateStock_out:updateStock_out,updateDefective:updateDefective,updateReturned:updateReturned,updatePverientID:updatePverientID,updatePvImageID:updatePvImageID, updatefimg: updatefimg,updatedimg: updatedimg,remarks:remarks },
        success:function(data){
            console.log(data);
            var da = JSON.parse(data);
            if(da.status_code==200){
                alert("Success");
                location.reload();
            }else{
                alert('errore');
            }
        }
    })
    }
    });
</script>
<script>
    async function Updatef_image() {
        let formData = new FormData();
        formData.append("Updatefolderid",$("#updateProductName").val());
        formData.append("file", updatefimg.files[0]);
        await fetch('library/Updatefeature_image.php', {
            method: "POST",
            body: formData
        });
    }
</script>
<script>
     async function Updated_image() {
        let formData = new FormData();
        formData.append("folderDisplayId", $("#updateclrName").val());
        formData.append("folderVerientId", $("#updateProductName").val());
       
    for(var i=0;i<updatedimg.files.length;i++){
      formData.append("file", updatedimg.files[i]);
    await fetch('library/UPdatedisplayImage.php', {
        method: "POST",
        body: formData
    });
   }
   }
</script>
<!-- update product varient -->
<!-- update product varient -->

 <?php include "footer.php"; ?>          