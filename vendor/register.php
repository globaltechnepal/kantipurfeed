<style>
*{
    overflow-x:hidden;
}
#reggap>div{
    padding:10px;
}
    /* Use a media query to add a breakpoint at 800px: */
@media screen and (max-width: 600px) {
 #registermain{
     display:flex;
flex-direction:column;
gap:20px; }
}
    
    
</style>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- bootstrap icon cdn -->
  <!-- bootstrap icon cdn -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <!-- bootstrap icon cdn -->
  <!-- bootstrap icon cdn -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Vendor Register</title>
    <link rel="icon" type="images/ico" href="../favicon.ico">
  <!--jquery cdn-->
  <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
   <!--jquery session-->
  <script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
</head>
<?php 
 include '../assets/library/library.php';
 ?>
<body style="overflow-x: hidden;">
  <nav class="navbar navbar-expand-lg" style="background:white">
    <div class="container-fluid">
      <a class="navbar-brand" href="../index.php"><img src="assets/images/deli-logo.png" class="w-50"></a>
    </div>
    </div>
  </nav>
  <form action="#" method="post" class="mb-2">
    <div class="row row-cols-1 row-cols-md-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="assets/images/Account/54483-vender-por-redes.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">

          <div class="col-11 text-center mb-3 mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;" >
      
            <div class="col-12 fw-bold text-center p-1">
              <span class="fs-1">Vendor Register</span><br>
              <span>Please enter your valid Details:</span>
            </div>
                <div id="reggap">
            <div class="row" id="registermain">
                <!--<div class="col form-floating   ">-->
                <!--    <select class="form-select" id="selectType" aria-label="Default select example">-->
                <!--      <option class="selectOption">--SELECT--</option>-->
                <!--      <option value="Dealer">Dealer</option>-->
                <!--      <option value="Wholesaler">Wholesaler</option>-->
                <!--      <option value="Retailer">Retailer</option>-->
                <!--    </select>   -->
                <!--</div>-->
            <div class="col form-floating   ">
              <input type="text" class="form-control ps-4" name="companyname" id="companyname" placeholder="Company">
              <label class="ms-4" for="floatingInput">Company</label>
            </div>
            </div>
            <div class=" row " id="registermain">
            <div class="col  form-floating   ">
              <input type="text" class="form-control ps-4" name="pan" id="panno" placeholder="PAN" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
              <label class="ms-4" for="floatingInput">PAN</label>
            </div>
            <div class="col form-floating  ">
              <input type="text" class="form-control ps-4" name="vat" id="Vatno" placeholder="VAT" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');">
              <label class="ms-4" for="floatingInput">VAT</label>
            </div>
            </div>
             <div class=" row   " id="registermain">
            <div class="col form-floating  ">
              <input type="email" class="form-control ps-4" id="vEmail" name="email" placeholder="E-mail">
              <label class="ms-4" for="floatingInput">E-mail</label>
            </div>
            <div class="col form-floating ">
              <input type="text" class="form-control ps-4 onlyNum" id="phone" name="phone" placeholder="Phone" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" >
              <label class="ms-4" for="floatingPassword">Phone</label>
            </div>
            </div>
            <div class=" row" id="registermain">
            <div class="col form-floating ">
              <input type="password" class="form-control ps-4" name="password" id="password" placeholder="Password">
              <label class="ms-4" for="floatingPassword">Password</label>
            </div>
            <div class="col form-floating">
                <select class="form-select" id="province" aria-label="Default select example">
                    <?php
                                        $query = "SELECT DISTINCT `province` FROM `address`;";
                                        $conn = connectDB();
                                        $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
                                        if (mysqli_num_rows($req) > 0) {
                                            while ($data = mysqli_fetch_assoc($req)) {
                                                $province = $data["province"]; ?>
                                        <option value="<?Php echo $province; ?>">
                                            <?Php echo $province; ?>
                                        </option>
                                        <?php
                                            }
                                        } ?>
                </select> 
                <label class="ms-4" for="province">Province</label>
                </div>
            </div>
            <div class=" row  " id="registermain">
            <div class="col form-floating ">
            <select class="form-select" id="district" name="district" aria-label="Default select example">
            </select> 
            <label class="ms-4" for="floatingPassword">District</label>
            </div>
              <div class="col form-floating ">
             <select class="form-select" id="municipality" name="municipality" aria-label="Default select example">
             </select> 
            <label class="ms-4" for="floatingPassword">Municipality</label>
              </div>
            </div>
            <div class="mt-3 " id="registermain">
              <button type="button" class="btn col-4" id="Submitbtn" name="Submitbtn"
                style="background:red; color:white">Request</button>
            </div>
            <div class=" mt-3 pb-3" id="registermain">
              <span class="">Already have account ? <a href="login.php">Login</a></span>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </form>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <!-- Footer -->
  <script>
      $(document).ready(function(){
          $("#Submitbtn").click(function(){
           var  company_name = $("#companyname").val();
            var  venEmail = $("#vEmail").val();
             var  Password = $("#password").val();
              var  Vatno = $("#Vatno").val();
               var  panno = $("#panno").val();
                var  contact = $("#phone").val();
                 var  province = $("#province").val();
                 var  district = $("#district").val();
                 var  municipality = $("#municipality").val();
                 var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        
                 if(company_name==""||venEmail==""||Password==""||contact==""||district==""||municipality==""){
                     alert("Please fill the form properly");
                 }
                 else if(!pattern.test(venEmail))
                    {
                      alert('Not a valid e-mail address');
                    }
                 else if(Vatno=='' && panno ==''){
                     alert("Please enter pan or vat no.");
                 }
                 else{
                $.ajax({
                type: 'POST',
                url: '../../assets/library/productCartControl.php',
                data: { register_vendor_user: company_name,venEmail:venEmail,Password:Password,Vatno:Vatno,panno:panno,contact:contact,province:province,district:district,municipality:municipality},
                success: function (data) {
                    // console.log(data);
                    var da = JSON.parse(data);
                    if(da.status_code==200){
                        alert("Vendor register request send. Please Wait for the conformation. Please Check your email. Thank you !! ");
                        location.reload();
                    }else{
                        alert("Unable to create vendor");
                    }
                }
            }); 
          }
            
        });
          
          
          $("#province").change(function () {
            var province = $(this).val();
            // alert(province);
            $.ajax({
                type: 'POST',
                url: '../../assets/library/productCartControl.php',
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
                url: '../../assets/library/productCartControl.php',
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
        
        
          $("#selectType").click(function(){
             $(".selectOption").hide(); 
          });
          
          $(".onlyNum").filter(function(value) {
            return /^\d*$/.test(value);    // Allow digits only, using a RegExp
          },"Only digits allowed");
          
          //select either vat or pan
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
        
          
        });
  </script>
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
  <!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- bootstrap cdn -->
  <!-- bootstrap cdn -->
  
</body>
</html>