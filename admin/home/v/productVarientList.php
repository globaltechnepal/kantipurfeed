<?php  include "../header.php"?>
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
                $p_ID = (isset($_POST['id']) ? $_POST['id'] : null);
                // $p_ID = $_GET['id'];
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
            </tr>
        </thead>
        <tbody>
            <?php
            $pid = (isset($_POST['id']) ? $_POST['id'] : null);
        // $pid = $_GET['id'];
        // echo "<script>alert($pid);</script>";
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
function getRemainingColors(product,identifier,hasValue){
    var data_is=hasValue;
    $.ajax({
                url: '../../library/httpRequest.php',
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
    </script>
 <?php include "../footer.php"; ?>          