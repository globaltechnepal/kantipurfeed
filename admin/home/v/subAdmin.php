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
      <div>Sub-Admin List</div>
    </div>
    <button type="button" class="btn btn-outline-secondary col-1 ms-3 mb-2" data-bs-target="#exampleModalToggle"
      href="#exampleModalToggle" data-bs-toggle="modal"><i class="bi bi-person-plus-fill"></i> Add</button>
  </div>
  <!-- datatable start -->
  <!-- datatable start -->
  <table id="table_id" class="display">
    <thead>
      <tr style="font-size:13px;">
        <th>S.N.</th>
        <th>Username</th>
        <th>Email</th>
        <th>Type</th>
        <th>Active</th>
      </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT `id`, `active_state`, `username`, `email`, `admin_pass`, `admin`, `subAdmin`, `remarks` FROM `admin` WHERE `superAdmin`=0";
            $conn = dbConnecting();
            $req = mysqli_query($conn, $query) or die(mysqli_error($conn));
            if (mysqli_num_rows($req) > 0) {
              $i = 1;
              while ($data = mysqli_fetch_assoc($req)) { 
                  $adminType='';
                  if($data['admin']){
                  $adminType='admin';
                  }else if($data['subAdmin']){
                  $adminType='Sub-Admin';
                  }else{
                  $adminType="Type Not Defined";
                  }
              ?>
              <tr>
                    <td style="font-size:1rem;"><?php echo $i; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["username"]; ?></td>
                    <td style="font-size:1rem;"><?php echo $data["email"]; ?></td >
                    <td style="font-size:1rem;"><?php echo $adminType; ?></td >
                    <td class="row" style="font-size:1rem;">
                        <div class="form-check form-switch"><input <?php if($data['active_state']){echo "checked";} ?> class="form-check-input toggle_active" style="border-color: transparent;" data-email="<?php echo $data["email"] ?>" id="toggleCheck" type="checkbox" role="switch">
                                    <label class="form-check-label lbl_active">
                                      <?php if($data['active_state']){echo "Active";}else{echo "In-active";} ?>
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

<!-- add new category -->
<!-- add new product  -->
<div class="modal ms-5 ps-5" id="exampleModalToggle" data-bs-backdrop="static" aria-hidden="true" aria-labelledby="exampleModalToggle"
  tabindex="-1">
  <div class="modal-dialog modal-lg ps-5" style="max-width:1060px;margin-left:75px;">
    <div class="modal-content ms-5">
      <div class="p-3 mb-2 bg-dark text-white text-center">Sub-Admin Form</div>
      <form action="#" method="post" enctype="multipart/form-data">
        <div class="row p-2">
             <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Username :&nbsp;
                <input type="text" class="form-control w-100" id="adm_username" name="adm_username"></span>
            </div>
            <div class="col input-group mb-3">
              <span class="input-group-text col-12" id="basic-addon1">Email :&nbsp;
              <input type="email" class="form-control" id="admEmail" name="admEmail" ></span>
            </div>
        </div>
        <div class="row p-2">
             <div class="col input-group mb-3">
                <span class="input-group-text col-12" id="basic-addon1">Password :&nbsp;
                <input type="password" class="form-control w-100" id="Password" name="Password" minlength="5"></span>
            </div>
            <div class="col input-group mb-3">
              <span class="input-group-text col-12" id="basic-addon1">Admin Type :&nbsp;
              <select class="form-select" aria-label="Default select example" id="adminType">
              <option value="admin">Admin</option>
              <option value="subadmin">Subadmin</option>
            </select></span>
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
        $("#Submitbtn").click(function(){
            var pattern = /^\b[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,3}$/i;
            var pswpattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/i;
            var username = $("#adm_username").val();
             var admEmail = $("#admEmail").val();
              var Password = $("#Password").val();
               var adminType = $("#adminType").val();
            //   alert(username);
               if(username==""||admEmail==""||Password==""||adminType==""){
                   alert("Form field are empty");
               }
               else{
                   if(!pattern.test(admEmail))
                {
                  alert('Not a valid e-mail address');
                  return false;
                }else if(Password.length<5){
                  alert('Minimum password character is 5');
                  return false;
                }else if(!pswpattern.test(Password)){
                   alert('Password format didnot match');
                  return false;
                }
                else{
                  $.ajax({
                    url: 'library/admin_control.php',
                    type: 'POST',
                    data: {insert_data_into_admin:username,admEmail:admEmail,Password:Password,adminType:adminType},
                    datatype: 'json',
                    success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    if(da.status_code ==200){
                    console.log(da.message_2);
                        alert("Admin created successfully");
                        // $("#closeBtn").click();
                        location.reload();
                    }
                    else if(da.status_code !=200){
                      alert("Something going wrong");   
                    }
                        }
                  });
                }
               }
        });
        
        
        $(document).on('click', '.toggle_active', function() { 
            //  alert("toggle_active");
             $(this).addClass('clicked');
            var user_email=$(this).attr("data-email");
            if($(this).prop("checked")==true){
                // alert('checked');
                $.ajax({
                url: 'library/admin_control.php',
                type: 'POST',
                data: { toggle_active: 1, user_email: user_email },
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                },
            });
            $('.clicked').next(".lbl_active").text("Active");
            $('.clicked').removeClass('clicked');
            }else{
                // alert('uncheck');
                $.ajax({
                url: 'library/admin_control.php',
                type: 'POST',
                data: { toggle_active: 0,user_email: user_email },
                datatype: 'json',
                success: function (data) {
                    console.log(data);
                    var da = JSON.parse(data);
                    // show_response(da);
                },
            });
            $('.clicked').next(".lbl_active").text("In-active");
            $('.clicked').removeClass('clicked');
            }
        });
    });
</script>

<?php include "../footer.php"; ?>