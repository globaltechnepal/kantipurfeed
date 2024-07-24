<?php include "../header.php" ?>
<style>
    table.dataTable tbody td {
  padding: 1px 34px !important;
    }
  .dt-button{
height: 33px !important;
font-size: 10px !important;
padding: 7px !important;
    }

</style>
<div class="col-12">
  <div class="col-12 d-flex">
    <div class="p-1 mb-2 bg-dark text-white text-center text-uppercase">
      <div>Vendor List</div>
    </div>
    <!--<button type="button" class="btn btn-outline-secondary col-1 ms-3 mb-2" data-bs-target="#exampleModalToggle"-->
    <!--  href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button>-->
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr style="font-size:13px;">
        <th>S.N.</th>
        <th>Type</th>
        <th>Username</th>
        <th class="col-1">Email</th>
        <th>Contact</th>
        <th>Address</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT  `active_state`,`user_type`,`discountPercent`,`vendor_company_name`, `vendor_email`, `vendor_pass`, `vendor_contact`, `vendor_pan`, `vendor_vat`, `vendor_address`, `create_date`, `deactivate_date`, `remarks` FROM `vendor_users` ORDER BY `id` DESC;";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
              $i = 1;
              while ($data = mysqli_fetch_assoc($req)) { 
              ?>
              <tr>
                    <td style="font-size:1rem;"><?php echo $i; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["user_type"]; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["vendor_company_name"]; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["vendor_email"]; ?></td >
                    <td style="font-size:1rem;"><?php echo $data["vendor_contact"]; ?></td >
                    <td style="font-size:1rem;"><?php echo $data["vendor_address"]; ?></td >
                    <td class="row" style="font-size:1rem;">
                        <a class="disCount" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-disCount="<?php echo $data["discountPercent"]; ?>" data-vendorEmail="<?php echo $data["vendor_email"]; ?>"><i class="bi bi-pen"></i></a>
                        <div class="form-check form-switch"><input <?php if($data['active_state']){echo "checked";} ?> class="form-check-input toggle_active" style="border-color: transparent;" data-email="<?php echo $data["vendor_email"]; ?>" id="toggleCheck" type="checkbox" role="switch">
                                    <label class="form-check-label lbl_active">
                                      <?php if($data['active_state']){echo "Active";}else{echo "InActive";} ?>
                                    </label>
                        </div>
                       
                    </td>

                  </tr>
                  <?php
                $i++;
              }
            }
            ?>
    </tbody>
  </table>
  <!-- datatable end -->
  <!-- datatable end -->
</div>
</div>

<script>
  $(".disCount").click(function () {// button class where button clicked
    var vendorEmail = $(this).attr("data-vendorEmail"); //attribute from button data-category
    $("#vEml").attr("value", vendorEmail.trim());
    var disCount = $(this).attr("data-disCount");
     $("#vendorDiscount").attr("value", disCount.trim());
  });
</script>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Client Type</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" class="form-control" id="vEml">
           <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">Client Type</span>
                <select class="form-select" aria-label="Default select example" id="clientType">
                  <option class="selectOption">Select</option>
                  <option value="Wholesaler">Wholesaler</option>
                  <option value="Retailer">Retailer</option>
                  <option value="Dealer">Dealer</option>
                </select>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">Discount</span>
              <input type="text" class="form-control" id="vendorDiscount">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitDisc">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- add new category -->
<!-- add new product  -->
<div class="modal ms-5 ps-5" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Vendor Form</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="row p-2">
            <!-- <div class="col input-group mb-3">-->
            <!--    <span class="input-group-text col-12" id="basic-addon1">Type :&nbsp;-->
            <!--    <select class="form-select" aria-label="Default select example" id="clientType">-->
            <!--      <option class="selectOption">Select</option>-->
            <!--      <option value="Wholesaler">Wholesaler</option>-->
            <!--      <option value="Retailer">Retailer</option>-->
            <!--      <option value="Dealer">Dealer</option>-->
            <!--    </select>-->
            <!--    </span>-->
            <!--</div>-->
        </div>
        <div class="row p-2">
             <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Company Name :&nbsp;
                <input type="text" class="form-control w-100" id="company_name" name="company_name"></span>
            </div>
            <div class="col input-group mb-3">
              <span class="input-group-text col-12" id="basic-addon1">Email :&nbsp;
              <input type="email" class="form-control" id="venEmail" name="venEmail"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,3}$"></span>
            </div>
        </div>
        <div class="row p-2">
             <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Password :&nbsp;
                <input type="password" class="form-control w-100" id="Password" name="Password" minlength="5"></span>
            </div>
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Contact :&nbsp;
                <input type="text" class="form-control w-100" id="contact" name="contact" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="10" minlength="10"></span>
            </div>
        </div>
        <div class="row p-2">
            <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">PAN No :&nbsp;
                <input type="text" class="form-control w-100" id="panno" name="panno" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="9" minlength="9"></span>
            </div>
             <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">VAT No :&nbsp;
                <input type="text" class="form-control w-100" id="Vatno" name="Vatno" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15" minlength="15"></span>
            </div>
        </div>
        <hr>
        <div class="row p-2">
            <div class="col input-group mb-3">
              <span class="input-group-text col-12" id="basic-addon1">Province :&nbsp;
              <select class="form-select" aria-label="Default select example" id="province">
              <option value="">SELECT</option>
               <?php
                $query = "SELECT DISTINCT `province` FROM `address`;";
                $conn = dbConnecting();
                $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                if (mysqli_num_rows($req) > 0) {
                while ($data = mysqli_fetch_assoc($req)) {
                $province = strToUpper($data["province"]); ?>
                <option value="<?Php echo $province; ?>">
                    <?Php echo $province; ?>
                </option>
                <?php
                    }
                } ?>
            </select></span>
            </div> 
             <div class="col input-group mb-3">
              <span class="input-group-text col-12" id="basic-addon1">District :&nbsp;
              <select class="form-select" aria-label="Default select example" id="district">
              <option value="">SELECT</option>
            </select></span>
            </div> 
        </div>
        <div class="row p-2">
            <div class="col input-group mb-3">
              <span class="input-group-text col-12" id="basic-addon1">Municipality :&nbsp;
              <select class="form-select" aria-label="Default select example" id="municipality">
              <option value="">SELECT</option>
            </select></span>
            </div> 
             <div class="col input-group mb-3">
               <span class="input-group-text col-12" id="basic-addon1">Tole :&nbsp;
                <input type="text" class="form-control w-100" id="tole" name="tole"></span>
            </div> 
        </div>
         <button type="button" class="btn btn-primary ms-3 mb-3" id="Submitbtn" name="Submitbtn">Submit</button>
          <button type="button" class="btn btn-secondary mb-3" id="closeBtn" data-bs-dismiss="modal">Close</button>
      </form>
    </div>
  </div>
</div>
<!-- add new category -->
<!-- add new product  -->


<script>
$(document).ready(function(){
    
    $("#submitDisc").click(function(){
        var clientType = $("#clientType").val();
        var vendorEml = $("#vEml").val();
        var vendorDiscount = $("#vendorDiscount").val();
        // alert(vendorEml);  alert(vendorDiscount);
        if(vendorEml==""||vendorDiscount==""){
            alert("Fill the form properly");
        }
        else{
                $.ajax({
                type: 'POST',
                url: 'library/vendorControl.php',
                data: {insert_vendor_discount_percent:vendorEml,vendorDiscount:vendorDiscount,clientType:clientType},
                success: function (data) {
                    console.log(data);
                   var da = JSON.parse(data);
                    if(da.status_code==200){
                        // alert("New vendor added successfully");
                        location.reload();
                    }else{
                        alert("Unable to add discount(%)");
                    }
                }
            }); 
        }
    });
    
    $("#clientType").click(function(){
     $(".selectOption").hide();  
    });
    
    // $('#toggleCheck').click(function(){
    //     alert("click");
    // });
    
    
        $("#panno").focusout(function(){
            var len = $(this).val().length;
            if(len>0){
              $("#Vatno").attr('disabled','disabled');    
            }
            else{
                 $("#Vatno").removeAttr('disabled'); 
            }
        });
        
        $("#Vatno").focusout(function(){
            var len = $(this).val().length;
            if(len>0){
              $("#panno").attr('disabled','disabled');    
            }
            else{
                 $("#panno").removeAttr('disabled'); 
            }
        });
        $("#Submitbtn").click(function(){
           var clientType  = $("#clientType").val();
           var  company_name = $("#company_name").val();
            var  venEmail = $("#venEmail").val();
             var  Password = $("#Password").val();
              var  Vatno = $("#Vatno").val();
               var  panno = $("#panno").val();
                var  contact = $("#contact").val();
                 var  province = $("#province").val();
                 var  district = $("#district").val();
                 var  municipality = $("#municipality").val();
                 var  tole = $("#tole").val();
                 var userinput = $("#venEmail").val();
                 var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        
                 if(company_name==""||venEmail==""||Password==""||contact==""||district==""||municipality==""||tole==""){
                     alert("Please fill the form properly");
                 }
                 else if(!pattern.test(userinput))
                    {
                      alert('Not a valid e-mail address');
                    }
                 else if(Vatno=='' && panno ==''){
                     alert("Please enter pan or vat no.");
                 }
                 else{
                $.ajax({
                type: 'POST',
                url: 'library/vendorControl.php',
                data: { register_vendor_user: company_name,venEmail:venEmail,Password:Password,Vatno:Vatno,panno:panno,contact:contact,province:province,district:district,municipality:municipality,tole:tole,clientType:clientType },
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    if(da.status_code==200){
                        alert("New vendor added successfully");
                        location.reload();
                    }else{
                        alert("Unable to add vendor");
                    }
                }
            }); 
                 }
            
        });

          $("#province").change(function () {
            var province = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'library/database.php',
                data: { give_district_from_server: province },
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    if (da.status_code == '200') {
                        $("#district").empty();
                        $("#district").append('<option value="">Choose..</option>');
                        jQuery.each(da.address, function (i, district) {
                            var dis = district.district;
                            dis = dis.toUpperCase();
                            $("#district").append('<option value="' + dis + '" >' + dis + '</option>');
                        });
                    }
                    else {
                        $("#district").empty();
                        $("#district").append('<option value="">Choose..</option>');
                    }
                }
            });
        });
        
        $("#district").change(function () {
            var district = $(this).val();
            $.ajax({
                type: 'POST',
                url: 'library/database.php',
                data: { give_municipality_from_server: district },
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    if (da.status_code == '200') {
                        $("#municipality").empty();
                        $("#municipality").append('<option value="">Choose..</option>');
                        jQuery.each(da.address, function (i, municipality) {
                            var muni = municipality.municipality;
                            muni = muni.toUpperCase();
                            $("#municipality").append('<option value="' + muni + '" >' + muni + '</option>');
                        });
                    }
                    else {
                        $("#municipality").empty();
                        $("#municipality").append('<option value="">Choose..</option>');
                    }
                }
            });
        });
        
        
            $(document).on('click', '.toggle_active', function() { 
            //  alert("toggle_active");
             $(this).addClass('clicked');
            var user_email=$(this).attr("data-email");
            if($(this).prop("checked")==true){
                // alert('checked');
                // alert(user_email);
                if(confirm("Are you sure you want to active vendor ?")){
                $.ajax({
                url: 'library/admin_control.php',
                type: 'POST',
                data: { toggle_active_vendor: 1, user_email: user_email },
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                }
            });
            }
            $('.clicked').next(".lbl_active").text("Active");
            $('.clicked').removeClass('clicked');
            }else{
                // alert('uncheck');
                if(confirm("Are you sure you want to inactive vendor ?")){
                $.ajax({
                url: 'library/admin_control.php',
                type: 'POST',
                data: { toggle_active_vendor: 0,user_email: user_email },
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                },
            });
           }
            $('.clicked').next(".lbl_active").text("InActive");
            $('.clicked').removeClass('clicked');
            }
        });
});

</script>



<?php include "../footer.php"; ?>