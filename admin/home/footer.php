<!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Deli Nepal</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true"> 
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/datatables-demo.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="../js/demo/datatables-demo.js"></script>


<!-- datatable --> 
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
      //click on load
      $("#sidebarToggle").click();
    //   show result from ajax 
    function show_response(response) {
            var hasmessage='empty';
            switch (response.status_code) {
                case '200':
                    hasmessage=response.message;
                    setTimeout(function(){
                       window.location.reload();
                    }, 5000);
                    break;
                case '1415':
                    hasmessage=response.message;
                    break;
                case response.status_code:
                    hasmessage=response.message;
                    // location.reload();
                    break;
                default:
                    alert("cannot catch response");
                    break;
            }
        $("#myNotifyElem").text(hasmessage);
        $("#myNotifyElem").show();
        setTimeout(function() { $("#myNotifyElem").hide(); }, 1500);
        }
         //   show result from ajax 
      
    var printCounter = 0;
 
    // Append a caption to the table before the DataTables initialisation
    // $('#table_id').append('<caption style="caption-side: bottom">All your Detail\'s appear here.</caption>');
 
    $('#table_id').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy',
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Sirius Cybernetics Corp.'
            },
            {
                extend: 'pdf',
                messageBottom: null
            },
            {
                extend: 'print',
                messageTop: function () {
                    printCounter++;
 
                    if ( printCounter === 1 ) {
                        return 'This is the first time you have printed this document.';
                    }
                    else {
                        return 'You have printed this document '+printCounter+' times';
                    }
                },
                messageBottom: null
            }
        ]
    } );
    //add new product

// This api code written by bikesh
// This api code written by bikesh

function categoryGroup() {
var getProductApi = $("#get_product_api").val();
// alert(getProductApi);
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
            var GroupName = product.GroupName;
            var PImage = product.PImage;
            
            // Make a POST request to add the product to the database
            $.ajax({
                url: "../library/database.php",
                method: "POST",
                data: {
                    // Pass product details as POST parameters
                    GroupName: GroupName,
                    PImage: PImage
                },
                success: function(data) {
                    try {
            // Try to parse the data as JSON
            var da = JSON.parse(data);
            console.log('Catagory added successfully:', da.PDesc);
            // Further actions if needed after parsing JSON
        } catch (error) {
            // Handle non-JSON data
            console.log('Received non-JSON data:', data);
            // Further actions for non-JSON data
        }
                },
                error: function(error) {
                    // Handle errors for individual product addition
                    console.error('Error adding catagory:', error);
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

categoryGroup(); 



//start add product into database code through api
//start add product into database code through api
function addProductToDatabase() {
    // Get the API endpoint URL from an input field with id "get_product_api"
    var getProductApi = $("#get_product_api").val();

    // Make AJAX request to fetch product data
    $.ajax({
        url: getProductApi,
        method: 'GET',
        success: function(response) {
            // Data retrieval successful
            var products = response.data;

            // Process each product
            for (var i = 0; i < products.length; i++) {
                var product = products[i];
                
                // Extract product details
                var PCode = product.PCode;
                var PDesc = product.PDesc;
                var GroupName = product.GroupName;
                var PShortName = product.PShortName;
                var BuyRate = product.BuyRate;
                var SalesRate = product.SalesRate;
                var PImage = product.PImage;

                // Make a POST request to add the product to the database
                $.ajax({
                    url: "../library/database.php",
                    method: "POST",
                    data: {
                        // Pass product details as POST parameters
                        PCode: PCode,
                        PDesc: PDesc,
                        GroupName: GroupName,
                        PShortName: PShortName,
                        BuyRate: BuyRate,
                        SalesRate: SalesRate,
                        PImage: PImage
                    },
                    success: function(data) {
                        // Parsing the response data
                        try {
                            var da = JSON.parse(data);
                            console.log('Product added successfully:', da.PDesc);
                            // Further actions if needed after parsing JSON
                        } catch (error) {
                            // Handle non-JSON data
                            console.log('Received non-JSON data:', data);
                            // Further actions for non-JSON data
                        }
                    },
                    error: function(error) {
                        // Handle errors for individual product addition
                        console.error('Error adding product:', error);
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

// Call the function to start adding products to the database
addProductToDatabase();
//end add product into database code through api
//end add product into database code through api

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
                    url: "../library/api_product_veriant.php",
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
                url: "../library/api_product_varient_image.php",
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


$('.numbers_only').on('keypress',function(e){
    // if(e.which == 13) {
    //     alert('You pressed enter!');
    // }else{
    //     alert('you pressed'+e.which);
    // }
    if(e.which>=48 && e.which<=57){
        return true;
    }else{
        return false;
    }
});

function calc_update_form(){
    var add_stock = $('#updateStock_in').val();
    var add_stock_out = $('#updateStock_out').val();
    var add_defective_stock = $('#updateDefective').val();
    var add_returned_stock = $('#updateReturned').val();
    if(add_stock.length<1){
        add_stock='0';
    }
    if(add_stock_out.length<1){
        add_stock_out='0';
    }
    if(add_defective_stock.length<1){
        add_defective_stock='0';
    }
    if(add_returned_stock.length<1){
        add_returned_stock='0';
    }
    // alert("Stock Added : "+add_stock);
    // alert("Stock OUT Added : "+add_stock_out);
    // alert("Stock defective : "+add_defective_stock);
    // alert("Stock Returned : "+add_returned_stock);
    var available_stock = $("#updateRemaining").attr('data-available_stock');
    if(available_stock.length<1){
        available_stock='0';
    }
    var disp_value = parseInt(available_stock)+parseInt(add_stock)-parseInt(add_stock_out)-parseInt(add_defective_stock)+parseInt(add_returned_stock);
    $("#updateRemaining").val(disp_value);
}
$('#updateStock_in').on('focusout',function(){
    calc_update_form();
});
$('#updateStock_out').on('focusout',function(){
    calc_update_form();
});
$('#updateDefective').on('focusout',function(){
    calc_update_form();
});
$('#updateReturned').on('focusout',function(){
    calc_update_form();
});

$(".close_called").on('click',function(){
    var data='';
    $('.clear_Form_data').val(data);
});

    // submit new color is here from page colorpeaker.php
        $('#submitColor').on("click", function () {
            var colorName = $("#clrName").val();
            var colorCode = $("#clrCode").val();
            if (colorName == "" || colorCode == "") {
                alert('Please fill the form Properly');
            }
            else {
                $.ajax({
                    url: '../library/database.php',
                    type: 'POST',
                    data: { colorName: colorName, colorCode: colorCode },
                    datatype: "JSON",
                    success: function (data) {
                        console.log(data);
                        var da = JSON.parse(data);
                        show_response(da);
                    }
                });
            }
        });

// This code is written by bikesh
// This code is written by bikesh

// ADD Order API Integration Code
// ADD Order API Integration Code
 $('.submitBtn').click(function () {
            var api_name = $('#api_name').val();
            var api_value = $('#api_value').val();
            var api_id = $('#txtid').val();
            // alert(api_id);
            if (api_name == "" || api_value == "") {
                alert("Please Fill The Field");
                return false;
            }
            else {
                $.ajax({
                    url: "../library/database.php",
                    method: "POST",
                    data: { api_name: api_name, api_value: api_value, api_id: api_id},
                    datatype: "JSON",
                    success: function (data) {
                        // alert("Category added successfully");
                        console.log(data);
                        var da = JSON.parse(data);
                        show_response(da);
                        // location.reload();
                    }
                });
            }
        });
// ADD Order API Integration Code
// ADD Order API Integration Code

        
    // new  launch script
    // new  launch script
        $(".new_launch").click(function () {
            var id = $(this).attr("data-id");
            $("#showId").val(id);
            var product_name = $(this).attr("data-product_name");
            $("#ProductName").val(product_name);
            if (id == "") {
                alert("Please fill the form properly.");
            } else {
                $.ajax({
                    type: "POST",
                    url: "../library/database.php",
                    data: { get_data_from_server: id },
                    success: function (_data) {
                        console.log(_data);
                        var da = JSON.parse(_data);
                        var pCat = '';
                        var pName = '';
                        var pPrice = '';
                        var description = '';
                        var imges = [];
                        jQuery.each(da.products, function (i, da) {
                            console.log(da.product_name);
                            console.log(da.sell_Price);
                            pCat = da.category_name;
                            pName = da.product_name;
                            pPrice = da.sell_Price; 
                            description = da.discriptions;
                            imges[i] = da.primary_image;
                            alert(imges[i]);
                        });
                        if (description == null) {
                            description = '*Note: Please Add Description to display.';
                        }
                        var html = '';
                        html += '<div class="row">';
                        html += '<input value="' + id + '" type = "hidden" id = "showId"><div class="col input-group mb-3"><span class="input-group-text">Category:</span>';
                        html += '<input type="text" value="' + pCat + '" class="form-control" id="catName" readonly>';
                        html += '</div><div class="col input-group mb-3" ><span class="input-group-text">Price: </span>';
                        html += '<input type="text" value="' + pPrice + '" class="form-control" id="productPrice" readonly></div>';
                        html += '<div class="col-6 input-group mb-3"><span class="input-group-text"> Product Name:</span><input type="text" value="' + pName + '" class="form-control" id="ProductName" readonly></div>';
                        html += '<div class="col-12 d-flex"><div class="col-11 form-floating mb-2"><span class="input-group-text text-center" id="basic-addon1">Product Discription'
                        html += '<textarea class="form-control ms-2" id="productDisc" style="height: 100px; width: 100%;" ; maxlength="600"> ' + description + '</textarea></span ></div >'
                        html += '<div class="col-2"><a id="discSubmit" class="btn bg-success text-white">Save <i class="bi bi-save-fill"></i></a></div></div >'
                        html += '<div class="col-12 d-flex">';
                        var count = imges.length;
                        for (var k = 1; k < count; k++) {
                            var base64Img = imges[k];
                            html += '<img src="data:image/png;base64,' + base64Img + '" id="productImg" style="width:200px">';
                            console.log(imges[k]);
                        }
                        html += '</div > ';

                        $("#show_new_launch").empty();
                        $("#show_new_launch").append(html);
                        _data = '';
                    }
                });
            }
            $("#exampleModal").modal('show');
        });
        //discription subbmit
        //discription subbmit
        $(document).on('click', '#discSubmit', function () {
            var productDisc = $("#productDisc").val();
            var showId = $("#showId").val();
            // alert(showId);
            if (productDisc == "" || showId == "") {
                alert("Please fill the form properly.");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "../library/database.php",
                    data: { productDisc: productDisc, showId: showId },
                    success: function (data) {
                        console.log(data);
                        var da = JSON.parse(data);
                        show_response(da);
                        // location.reload();
                    }
                });
            }
        });

        // active and deactive new launch
        // active and deactive new launch
        $(document).on('click', '#activeNewLaunch', function () {
            var displayProuctid = $("#showId").val();
            var activeNewLaunch = "Active";
            var productDisc = $("#productDisc").val();
            if (activeNewLaunch == "" || productDisc == "") {
                alert("Please fill the form properly.");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "../library/database.php",
                    data: { activeNewLaunch: activeNewLaunch, displayProuctid: displayProuctid },
                    success: function () {
                        alert("Product Launch Successfully");
                    }
                });
            }
        });

        $(document).on('click', '#deactiveNewLaunch', function () {
            var displayProuctid = $("#showId").val();
            var deactiveNewLaunch = "Deactive";
            var productDisc = $("#productDisc").val();
            if (deactiveNewLaunch == "" || productDisc == "") {
                alert("Please fill the form properly.");
            }
            else {
                $.ajax({
                    type: "POST",
                    url: "../library/database.php",
                    data: { deactiveNewLaunch: deactiveNewLaunch, displayProuctid: displayProuctid },
                    success: function () {
                        alert("Product Deactivate Successfully");
                    }
                });
            }
        });
        // active and deactive new launch
        // active and deactive new launch
        
        // new  launch script
        // new  launch script
        

        $(document).on('click', '.delete_item', function () {
                $(this).parent("td").parent("tr").addClass("delete_only_this_item");
            if(confirm("Do you want to delete?")){
                var id = $(this).attr("data-del_item_id");
            // alert('dle clicked id:' + id);
            var hasName = $(this).attr("data-del_item_name");
            var name = "delete_" + hasName;
            // alert(name);
            hit_delete_server(name, id);
            }else{
                $(this).parent("td").parent("tr").removeClass("delete_only_this_item");
            }
        });

            function hit_delete_server(name,id){
                // alert(name+':'+id);
                 $.ajax({
                    url: '../library/deleteControl.php',
                    type: 'POST',
                    data: {delete_command:name,id:id},
                    datatype: 'json',
                    success: function (data) { 
                        console.log(data);
                        var da = JSON.parse(data);
                        show_delete_response(da);
                     },
                    error: function (jqXHR, textStatus, errorThrown) { alert("fail"); console.log(errorThrown); }
                });
            }
            
        function show_delete_response(response) {
            var hasmessage='empty';
            switch (response.status_code) {
                case '200':
                    hasmessage='success';
                    // $("#myNotifyElem").text("success.");
                    $(".delete_only_this_item").fadeOut("normal", function() {
                        $(this).remove();
                    });
                    // $(".delete_only_this_item").remove();
                    // alert(response.message);
                    // location.reload();
                    break;
                // case '1415':
                //     $("#myNotifyElem").text("Cannot delete used in other places too.");
                //     $("#myNotifyElem").show();
                //     setTimeout(function() { $("#myNotifyElem").hide(); }, 5000);
                //     break;
                case response.status_code:
                    // alert(response.status_code);
                    hasmessage = response.message;
                    // $("#myNotifyElem").text(response.message);
                    // $("#myNotifyElem").show();
                    // alert(response.message);
                    // location.reload();
                    break;

                default:
                    alert("cannot catch response");
                    break;
            }
        $(".delete_only_this_item").removeClass("delete_only_this_item");
        $("#myNotifyElem").text(hasmessage);
        $("#myNotifyElem").show();
        setTimeout(function() { $("#myNotifyElem").hide(); }, 1000);
        }
            
                $(document).on('click', '.toggle_payment', function() { 
            //  alert("toggle_payment");
            var ref_code=$(this).attr("data-ref_code");
            if($(this).prop("checked")==true){
                $.ajax({
                url: '../library/toggle_controler.php',
                type: 'POST',
                data: { toggle_payment: 1, ref_code: ref_code },
                datatype: 'json',
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                },
                // error: function (jqXHR, textStatus, errorThrown) { errorFunction(); }
            });
            $(this).next(".lbl_payment").text("PAID");
            }else{
                $.ajax({
                url: '../library/toggle_controler.php',
                type: 'POST',
                data: { toggle_payment: 0, ref_code: ref_code },
                datatype: 'json',
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                },
                // error: function (jqXHR, textStatus, errorThrown) { errorFunction(); }
            });
            $(this).next(".lbl_payment").text("PENDING");
            }
        });
        // $(document).on('click', '.toggle_delivery', function(){ 
        //     //  alert("toggle_delivery"); 
        //     var ref_code=$(this).attr("data-ref_code");
        //     if($(this).prop("checked")==true){
        //         $.ajax({
        //         url: 'library/toggle_controler.php',
        //         type: 'POST',
        //         data: { toggle_delivery: 1, ref_code: ref_code },
        //         datatype: 'json',
        //         success: function (data) {
        //             // console.log(data);
        //             var da = JSON.parse(data);
        //             // show_response(da);
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) { errorFunction(); }
        //     });
        //     $(this).next(".lbl_delivery").text("DELIVERED");
        //     }else{
        //         $.ajax({
        //         url: 'library/toggle_controler.php',
        //         type: 'POST',
        //         data: { toggle_delivery: 0, ref_code: ref_code },
        //         datatype: 'json',
        //         success: function (data) {
        //             // console.log(data);
        //             var da = JSON.parse(data);
        //             // show_response(da);
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) { errorFunction(); }
        //     });
        //     $(this).next(".lbl_delivery").text("PENDING");
        //     }
        // });
        
        //for deleteing display image one at a time
        $(document).on('click', '.del_this', function(){
            if(confirm("Are you sure you want to delete")){
                // $(this).remove();
            $(this).addClass("delete_this_img_item");
            var path=$(this).attr('data-path');
            var fileName=$(this).attr('data-imgName');
            // alert (path+fileName);
            $.ajax({
                url: '../library/httpRequest.php',
                type: 'POST',
                data: { del_display_img: path,file:fileName },
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                    // alert(da.message);
                    if(da.message=="success"){
                        $(".delete_this_img_item").remove();
                    }else{
                        $(".delete_this_img_item").removeClass('delete_this_img_item');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) { alert("error"); }
            });
            }else{
                // alert ("delete cancled");
            }
        });

} );


</script>
   <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
    });
</script>

    <!-- select 2 -->
    <!-- select 2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- select 2 -->
    <!-- select 2 -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.js"></script>
<!-- datatable -->
<!-- datatable -->

<!-- bootstrap cdn -->
<!-- bootstrap cdn -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- bootstrap cdn -->
<!-- bootstrap cdn -->
</body>
</html>