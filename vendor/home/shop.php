<?php 
include "header.php"; 
    $discountPercent="";
    $select_discount_percent = "SELECT `discountPercent` FROM `vendor_users` WHERE `vendor_email` ='".$_SESSION["vendor_email"]."';";
    $datas = get_Table_Data($select_discount_percent);
    foreach($datas as $data){
     $discountPercent =$data['discountPercent'];   
    }
?>
<div class="topbar pt-3 mb-2"><a class="btn"><i class="bi bi-list p-3" id="colpsCustom"></i></a><span class="fw-bold mt-3">SHOP</span>
</div>
    <?php 
    $lists = [];
    $select_list_Qry = "SELECT vendor_fav_list.`id`, `vendor_email`, `list_name`, `create_date` FROM `vendor_fav_list` WHERE `vendor_email` ='".$_SESSION["vendor_email"]."';";
    $lists = get_Table_Data($select_list_Qry);
    echo'<div class="d-flex" style="width:100%;gap:1rem;">';
    foreach($lists as $list){
     $li_vendor = $list['list_name'];   
    ?>
        <div class="btn-group  favlistname" style="display: flex;width:20%;position:relative;padding:1rem;">
            <a  style="width:70%" class=" favlistBtn btn btn-success" data-fav_id="<?php echo $list['id']; ?>" data-vendor_email="<?php echo $list['vendor_email'] ?>"><?php echo $li_vendor; ?></a>
            <a  class="deletebtn btn btn-danger text-white ms-1"  data-fav_list_id="<?php echo $list['id']; ?>"  style="visibility: collapse;width:30%;"><i class="bi bi-trash"></i></a>
        </div>
    <?php
    }
    echo "</div>";
    ?>
 
<div style="overflow:auto;" class="font_size_in_mobile">
   <table id="table_id" class="display">
        <thead>
            <tr>
                <th class="col-1 removescn">Select All <input type="checkbox" id="check_out_all" style="border: 0.5px solid;border: 1px solid rgba(0,0,0,.25);height: 1em;width: 1em;border-radius: .25em;"></th>
                <th class="col-2">Category</th>
                <th class="col-2">Product Code</th>
                <th class="col-2">Product</th>
                <th class="col-1">Price</th>
                <th class="col-1">Quantity</th>
                <th class="col-1">Discount(<?php echo $discountPercent ?>%)</th>
                <th class="col-1">Total</th>
                <th class="col-1">Image</th>
            </tr>
        </thead>
        <tbody class="vendor_table">
             <?php
            $checkoutQry = "SELECT  products.`id` as productID,`category_name`,`product_code`,`product_name`, `actual_Price`, `sell_Price`,`retailer_price`, `wholesaler_price`, `dealer_price`, `img_path`, `primary_image`, `secondary_image` FROM `products` 
            INNER join category on category.category_id = products.category_id";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $checkoutQry) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
            $i = 1;
            while ($data = mysqli_fetch_assoc($req)) {
            ?>
            <tr class="clsTr">
                <td>
                  <div class="form-check text-center">
                      <input class="form-check-input checkItem" data-productID="<?php echo $data['productID'] ?>" data-vendorEmail="<?php echo $_SESSION["vendor_email"] ?>"  type="checkbox" id="flexCheckDefault">
                    </div>
                </td>
                <td>
                    <?php echo $data["category_name"]; ?>
                </td>
                <td>
                    <?php echo $data["product_code"]; ?>
                </td>
                <td>
                    <?php echo $data["product_name"]; ?>
                </td>
                <td>
                    <?php echo intval($data["sell_Price"]); ?>
                </td>
                <td class="col-1 quantity_input_container">
                    <input type="text" class="form-control quantity"  data-unitPrice="<?php echo $data["sell_Price"];?>"  required>
                </td>
                
                <td></td>
                <td id="total">
                    <input type="text" class="form-control totalInput">
                    </td>
                 <td>
                   <a  data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="<?php echo '../../'.$data['img_path'].$data['primary_image']; ?>"  data-img="<?php echo $data['img_path'].$data['primary_image']; ?>" class="w-100 popupImg"></a>
                </td>
                <!--<td><input type="text" id="abc"></td>-->
            </tr>
            <?php
            }
            }
            ?>
        </tbody>
    </table>
</div>

<!--View Cart...................................................................................................................................................... -->        
        <footer class="text-center" style="position:relative;">
            <div class="card"
                style="background: white;box-shadow: 0px -6px 10px -1px black;">
                <div class="row text-start">
                    <div class="row col row-cols-1 row-cols-sm-1 row-cols-md-1 fsClass">
                        <span class="col fontSize">
                            Order Amount :<span style="float:right;font-weight:500;" >Rs. <span  id="fgh">0</span></span> 
                        </span>
                        
                        <span class="col fontSize">
                            Tax(13%) :<span style="float:right;font-weight:500;">Not Included</span> 
                        </span>
                        <hr>
                        <span class="col fontSize fw-bold">
                            Total  :<span style="float:right">Rs. <span class="grand_total">0</span></span>  
                        </span>
                    </div>
                    <div class="col fsClass">
                        <div class="text-center mb-3"><button type="button" class="btn fw-bold col-8 mt-3"
                                style="background: red;color:white"
                             id="viewDetailBtn">View Details</button>
                        </div>

                    </div>
                </div>
            </div>
        </footer>
<!--View Cart...................................................................................................................................................... -->        

<!--pop up cartout...................................................................................................................................................... -->
<div class="modal fade" id="showData" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="exampleModalLabel">Show Cart Item</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th class="col-2">Select</th>
                    <th class="col-2">Category</th>
                    <th class="col-2">Product Code</th>
                    <th class="col-2">Product</th>
                    <th class="col-1">Price</th>
                    <th class="col-1">Quantity</th>
                    <th class="col-1">Discount(<?php echo $discountPercent ?>%)</th>
                    <th class="col-1">Total</th>
                    <th class="col-1">Image</th>
                    <!--<th class="col-1">Action</th>-->
                </tr>
            </thead>
            <tbody class="vendor_cartout_data">
                
            </tbody>
        </table>
      </div>
      <hr>
      <div class="container">
        <div class="row">
            <div class="row col row-cols-1 row-cols-sm-1 row-cols-md-1 fsClass">
                <span class="col fontSize">
                   Order Amount :<span style="float:right;font-weight:500;" >Rs. <span id="fgh1">0</span></span> 
                </span>
                <span class="col fontSize">
                    Tax(13%) :<span style="float:right;font-weight:500;">Not Included</span> 
                </span>
                <hr>
                <span class="col fontSize fw-bold">
                    Total  :<span style="float:right">Rs. <span class="grand_total1">0</span></span>  
                </span>
            </div>
            <div class="col text-end" style="float:right;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger w-50" id="check_outBtn">Place Order</button>
            </div>
        </div>
      </div>
      <hr>
    </div>
  </div>
</div>

<!--pop up cartout...................................................................................................................................................... -->

<script>
$(document).ready(function(){
    $(".popupImg").click(function(){
        var img = $(this).attr('data-img');
        $(".dispImage").prop('src',"../../"+img);
    });
    $(".deletebtn").click(function(){
        var fav_list_id = $(this).attr('data-fav_list_id');
        var vendor_email ="<?php echo $_SESSION["vendor_email"]; ?>";
        if(confirm("Are you sure you want to delete favorite list ?")){
        $(this).parent().addClass('deleteThis');
        if(fav_list_id==""||vendor_email==""){
            alter("Form field are empty");
        }
        else{
            $.ajax({
            url: "../../assets/library/vendorControl.php",
            method: "POST",
            data: {delete_list:fav_list_id,vendor_email:vendor_email},
            success: function (data) {
                console.log(data);
                var da = JSON.parse(data);
                if(da.status_code==200){
                //   alert("Favourite list Deleted");
                  $(".deleteThis").fadeOut("normal", function() {
                        $(this).remove();
                    });
                }
                else if(da.status_code!=200){
                    $('.deleteThis').removeClass('deleteThis');
                    alert("Unable to delete");
                }
            }
          });
        }
        }
    });
    
    $(".favlistname").hover(function(){
      $(this).children(".deletebtn").css("visibility",'visible');
      }, function(){
      $(this).children(".deletebtn").css("visibility",'collapse');
    });

    $(".favlistBtn").click(function(){
    if($('#check_out_all').prop('checked', true)){
      $('#check_out_all').prop('checked', false);  
    }
    
    var vendorID = $(this).attr("data-fav_id");    
    var vendor_email = $(this).attr("data-vendor_email");
    $.ajax({
        url: "../../assets/library/vendorControl.php",
        method: "POST",
        data: {get_fav_list:vendorID,vendor_email:vendor_email},
        datatype: "JSON",
        success: function (data) {
        // console.log(data);
        var da = JSON.parse(data);
        if(da.status_code==200){
        var html = '';
            var user_type='<?php  echo strtolower(give_user_type($_SESSION['vendor_email']));?>';
            jQuery.each(da.data, function (i, da) {
            var image = da.img_path + da.img;
        html += '<tr>'
        html += '<td>'
        html += '<div class="form-check text-center">'
        html += '<input class="form-check-input checkItem" type="checkbox" id="flexCheckDefault" data-productID="'+da.id+'">'
        html += '</div>'
        html += '</td>'
        html += '<td>'+da.category_name+'</td>'
        html += '<td>'+da.product_code+'</td>'
        html += '<td>'+da.product_name+'</td>'
        html += '<td>'+da.sell_Price+' </td>'
        html += '<td class="col-1 quantity_input_container">'
        html += '<input type="text" class="form-control quantity" data-unitPrice="'+da.sell_Price+'" disabled>'
        html += '</td>'
        html += '<td></td>'
        html += '<td id="total">'
        html += '<input type="text" class="form-control totalInput" readonly>'
        html += '</td>'
        html += '<td><img src="../../'+image+'" class="w-100"></td>'
        html += ' </tr>';
        });
         $(".vendor_table").empty();
         $(".vendor_table").append(html);
        }
        }
    });
    });
    
   $(".favlistBtn").click(function(){
       $(".vendor_table").empty();
   });
   
//  enable and disable
 $(".quantity").attr('disabled','disabled');  
 $(".totalInput").attr('readonly','true');  
 $(document).on("click",".checkItem",function(){
     if(this.checked){
        $(this).parent().parent().parent('tr').children(".quantity_input_container").children('input').removeAttr('disabled');
        $(this).parent().parent().parent('tr').children(".quantity_input_container").children('input').addClass('active_input');
        $(this).parent().parent().parent('tr').children("#total").children('input').removeAttr('disabled');
        $(this).parent().parent().parent('tr').children("#total").children('input').addClass('total_input');
        
          let plus=$(this).parent().parent().parent('tr').children("#total").children('input').val();
        //   alert(plus);
           if(plus=='' || plus=='0'){
              
          }else{
         
              let formula=Number($('.grand_total').text())+Number(plus);
              let formulae=Number($('#fgh').text())+Number(plus);
              $('.grand_total').text(formula);
              $('#fgh').text(formulae);
              
          }
         

            
    }
    else{
        $(this).parent().parent().parent('tr').children(".quantity_input_container").children('input').attr('disabled','disabled');
        $(this).parent().parent().parent('tr').children("#total").children('input').attr('disabled','disabled');
         $(this).parent().parent().parent('tr').children("#total").children('input').removeClass('total_input');
          let minus=$(this).parent().parent().parent('tr').children("#total").children('input').val();
        //   alert(minus);
          if(minus=='' || minus=='0'){
              return minus;
          }else{
              
            //   alert($('#fgh').text());
              let formula=Number($('#fgh').text())-Number(minus);
                let formulae=Number($('.grand_total').text())-Number(minus);
              $('.grand_total').text(formula);
               $('#fgh').text(formulae);
              
          }
        //  $('.grand_total').text($('.grand_total').parseInt(text())-parseInt(minus));
    
    }
 });
 //  enable and disable
 
 
 
 
 //  enable and disable cartOut checkOut
 $(".cartout_quantity1").attr('disabled','disabled');  
 $(".totalInput1").attr('readonly','true');  
 $(document).on("click",".CartOut_checkout",function(){
     if(this.checked){
        $(this).parent().parent().parent('tr').children(".quantity_input_container1").children('input').removeAttr('disabled');
        $(this).parent().parent().parent('tr').children(".quantity_input_container1").children('input').addClass('active_input1');
        // $(this).parent().parent().parent('tr').children("#total1").children('input').removeAttr('readonly');
        $(this).parent().parent().parent('tr').children("#total1").children('input').addClass('total_input1');
        
          let plus=$(this).parent().parent().parent('tr').children("#total1").children('input').val();
        //   alert(plus);
           if(plus=='' || plus=='0'){
              
          }else{
         
              let formula=Number($('.grand_total1').text())+Number(plus);
              let formulae=Number($('#fgh1').text())+Number(plus);
              $('.grand_total1').text(formula);
              $('#fgh1').text(formulae);
              
          }
         

            
    }
    else{
        $(this).parent().parent().parent('tr').children(".quantity_input_container1").children('input').attr('disabled','disabled');
        $(this).parent().parent().parent('tr').children("#total1").children('input').attr('readonly');
         $(this).parent().parent().parent('tr').children("#total1").children('input').removeClass('total_input1');
          let minus=$(this).parent().parent().parent('tr').children("#total1").children('input').val();
        //   alert(minus);
          if(minus=='' || minus=='0'){
              return minus;
          }else{
              
            //   alert($('#fgh1').text());
              let formula=Number($('#fgh1').text())-Number(minus);
                let formulae=Number($('.grand_total1').text())-Number(minus);
              $('.grand_total1').text(formula);
               $('#fgh1').text(formulae);
              
          }
        //  $('.grand_total').text($('.grand_total').parseInt(text())-parseInt(minus));
    
    }
 });
 //  enable and disable
 
 $(document).on("keypress",".quantity", function (e) {
 if(e.which >= 48 && e.which <=57 ){
       return true;

    }else{
      alert("Only Numbers are allowed.");
      return false;   
    }
  });


 $(document).on('keyup',".active_input",function(){
     var qty = $(this).val();
     var unit_price=$(this).attr('data-unitPrice');
     var discount="<?php echo $discountPercent; ?>";
    //  alert(discount);
    var a = Math.trunc(((qty*unit_price)/100)*discount);
    // alert(a);
   var disAmt= $(this).parent().next().text(a);
  var  b = (qty*unit_price) -a;
   $(this).parent().next().next().children('.total_input').val(b);
    
    
   var a=0;
   
  $(".quantity").on("click",function(){
     var valu =  $(".quantity").val();
        if(valu != '')
    {
        a=0;
    }
    else if(valu == '')
    {
    var b = qty*unit_price;
    a+=b
    $("#abc").val(a);
    }
  })
    $("#abc").val(a);
     
 });
 
  $(document).on('keyup','.active_input',function(){
    let sum = 0;
    $('.total_input').each(function() {
        sum += Number($(this).val());
        
    });
  $('.grand_total').text(sum);
  $('#fgh').text(sum);

});

 // cartOut total 
 
  $(document).on('keyup',".active_input1",function(){
     var qty = $(this).val();
     var unit_price=$(this).attr('data-unitPrice1');
     var discount="<?php echo $discountPercent; ?>";
    //  alert(discount);
    var a = Math.trunc(((qty*unit_price)/100)*discount);
    // alert(a);
   var disAmt= $(this).parent().next().text(a);
  var  b = (qty*unit_price) -a;
   $(this).parent().next().next().children('.total_input1').val(b);
    
    
   var a=0;
   
  $(".cartout_quantity1").on("click",function(){
     var valu =  $(".cartout_quantity1").val();
        if(valu != '')
    {
        a=0;
    }
    else if(valu == '')
    {
    var b = qty*unit_price;
    a+=b
    $("#abc").val(a);
    }
  })
    $("#abc").val(a);
     
 });
 
  $(document).on('keyup','.active_input1',function(){
    let sum = 0;
    $('.total_input1').each(function() {
        sum += Number($(this).val());
        
    });
  $('.grand_total1').text(sum);
  $('#fgh1').text(sum);
  

});

// $(document).on('show','#showData',function(){
//     $('#flexCheckDefault').attr("checked",true);
// })
 
 
 

// ................................................................................................try
// for view btn
$("#viewDetailBtn").click(function(){
$('#hiddenEmail').val() 
var vendorEmail = '<?php echo $_SESSION["vendor_email"] ?>';
var discountPercent='<?php echo $discountPercent; ?>';
//  var productID = $('.checkItem').attr('data-productID'); 
 var cartouts=[];
 var quantity=$(".quantity").val();
 var cartout_count=0;
 $(".checkItem").each(function(){
   if($(this).prop("checked")){
    var productID = $(this).attr('data-productID'); 
    var quantity = $(this).parent().parent().parent('tr').children(".quantity_input_container").children('input').val();
   
      if(quantity=='' || Number(quantity)==0){
 
    return false;
      }else{
        var item = productID+'#'+quantity;
        // alert(item);
        cartouts.push(item);
        cartout_count++;
      }
   } 
   
 });
 
      if(vendorEmail==""||cartout_count<1){  
      alert("No product or quantity are selected !!!");
              return false;
  } 
  else{
        if(confirm("Are you sure you want to cart the selected item ?")){
        $.ajax({
        url: "../../assets/library/vendor_checkout.php",
        method: "POST",
        data: {vendor_cartouts:cartouts,vendorEmail:vendorEmail,discountPercent:discountPercent},
        success: function (data) {
            console.log(data);
            var da = JSON.parse(data);
            if(da.status_code==200){
            $('#showData').modal('show');
            $('.cartout_quantity1').removeAttr('disabled');
            sum=0;
            $(".totalInput1").each(function(){
                sum +=Number($(this).val());
            })
             $('.grand_total1').text(sum);
            $('#fgh1').text(sum);

            }
            else if(da.status_code=55){
                alert(message);
            }
            else{
                alert(message);
            }
        }
        
      });

    }
    } 
    
    // to select data  cartout
    // to select data  cartout
    if(vendorEmail==""||cartouts==""){
        // alert('empty');
        return false;
    }
    else{
        $.ajax({
        url: "../../assets/library/vendor_checkout.php",
        method: "POST",
        data: {vendor_cartOut_Item:vendorEmail,cartouts:cartouts},
        success: function (data) {
            // console.log(data);
            var da = JSON.parse(data);
            if(da.status_code==200){
                $(".vendor_cartout_data").empty();
              var html = '';
              jQuery.each(da.data, function (i, da) {
              var image = da.img_path + da.primary_image;
                html += '<tr>'
                html += '<td>'
                html += '<div class="form-check text-center">'
                html += '<input class="form-check-input CartOut_checkout" type="checkbox" id="flexCheckDefault" data-pid="'+da.product_id+'" data-quantity="'+da.quantity+'" checked>'
                html += '</div>'
                html += '</td>'
                html += '<td>'+da.category_name+'</td>'
                html += '<td>'+da.product_code+'</td>'
                html += '<td>'+da.product_name+'</td>'
                html += '<td>'+parseInt(da.sell_Price)+'</td>'
                html += '<td class="col-1 quantity_input_container1">'
                html += '<input type="text" class="form-control cartout_quantity1 active_input1" data-unitPrice1="'+da.sell_Price+'" value="'+da.quantity+'">'
                html += '</td>'
                html += '<td>'+Math.trunc((((da.sell_Price*da.quantity)/100)*da.discount))+'</td>'
                html += '<td id="total1">'
                html += '<input type="text" class="form-control totalInput1 total_input1" value="'+Math.trunc(((da.sell_Price*da.quantity)-(((da.sell_Price*da.quantity)/100)*da.discount)))+'" readonly>'
                html += '</td>'
                html += '<td>'
                html += '<a><img src="../../'+image+'" class="w-100 popupImg"></a>'
                html += '</td>'
                html += '</tr>';
              });
            $(".vendor_cartout_data").empty();
            $(".vendor_cartout_data").append(html);
            }
        }
      });
    }
    // to select data  cartout
   // to select data  cartout
    
});
// for view btn


// for checkout
// $("#viewDetailBtn").on("click" , )

$(document).on('click','#check_outBtn',function(){
 var vendorEmail = '<?php echo $_SESSION["vendor_email"] ?>';
 var discountPercent='<?php echo $discountPercent; ?>';
 var checkouts=[];
 var checkout_count=0;
  $(".CartOut_checkout").each(function(){
      if($(this).prop("checked")){
      var productID = $(this).attr('data-pid');
   
      var quantity = $(this).parent().parent().parent('tr').children(".quantity_input_container1").children('input').val();

      if(Number(quantity)=='' || Number(quantity)==0){
   
      return false;
      }else{
        var item = productID+'#'+quantity;
        checkouts.push(item);
        checkout_count++;
      }
        }
  });
   
  if(vendorEmail==""||checkout_count<1){
      alert("No product or quantity are selected !!!");
      return false;
       
    }else{
  if(confirm("Are you sure you want to place the order ?")){
        $.ajax({
        url: "../../assets/library/vendor_checkout.php",
        method: "POST",
        data: {vendor_checkout:checkouts,vendorEmail:vendorEmail,discountPercent:discountPercent},
        success: function (data) {
            console.log(data);
            var da = JSON.parse(data);
            if(da.status_code==200){
                alert("Order Placed !!!");
                location.reload();
            }
            else if(da.status_code!=220){
                alert(message_2);
            }
            else{
                alert(message);
            }
        }
      });
      }
  }
});

// for checkout

    $('#check_out_all').on('click',function(){
        if(this.checked){
            $('.checkItem').each(function(){
                //  $(this).click();
                this.checked = true;
            //   $('.quantity').prop('disabled',false);
               
                $(this).parent().parent().parent('tr').children(".quantity_input_container").children('input').removeAttr('disabled');
        $(this).parent().parent().parent('tr').children(".quantity_input_container").children('input').addClass('active_input');
        $(this).parent().parent().parent('tr').children("#total").children('input').removeAttr('disabled');
        $(this).parent().parent().parent('tr').children("#total").children('input').addClass('total_input');
        
          let plus=$(this).parent().parent().parent('tr').children("#total").children('input').val();
        //   alert(plus);
           if(plus=='' || plus=='0'){
              
          }else{
         
              let formula=Number($('.grand_total').text())+Number(plus);
              let formulae=Number($('#fgh').text())+Number(plus);
              $('.grand_total').text(formula);
              $('#fgh').text(formulae);
              
          }
               
               
               
               
            });
        }else{
             $('.checkItem').each(function(){
                //  $(this).click();
                this.checked = false;
                // $('.quantity').prop('disabled',true);
                
                 $(this).parent().parent().parent('tr').children(".quantity_input_container").children('input').attr('disabled','disabled');
        $(this).parent().parent().parent('tr').children("#total").children('input').attr('disabled','disabled');
         $(this).parent().parent().parent('tr').children("#total").children('input').removeClass('total_input');
          let minus=$(this).parent().parent().parent('tr').children("#total").children('input').val();
        //   alert(minus);
          if(minus=='' || minus=='0'){
              return minus;
          }else{
              
            //   alert($('#fgh').text());
              let formula=Number($('#fgh').text())-Number(minus);
                let formulae=Number($('.grand_total').text())-Number(minus);
              $('.grand_total').text(formula);
               $('#fgh').text(formulae);
              
          }
                
                
                
                
            });
        }
    });
    
    $('.checkItem').on('click',function(){
        if($('.checkItem:checked').length == $('.checkItem').length){
            $('#check_out_all').prop('checked',true);
        }else{
            $('#check_out_all').prop('checked',false);
        }
        
    
    });
// });




});

// mobile view
if(window.navigator.userAgent.indexOf("Mobile")>-1){
    $(".fontSize").css("font-size","10px");
   }
</script>

<!-- display image Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
          <img class="dispImage w-100">
      </div>
    </div>
  </div>
</div>

<?php
include "footer.php"; 
?>
<script>
        $('#table_id').DataTable({
            scrollY:400,
            dom: 'Bfrtip',
            paging:false,
            ordering: false,
            searching: true,
            buttons: [
            ]
        });
         $("#table_id").children("caption").css("display","none");
         $("#table_id_info").css("display", "none");

</script>


