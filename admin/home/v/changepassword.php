<?php include "../header.php" ?>
<?php 

    if ($SUBMIT=='CHANGE_PASSWORD')  { 
      include("../post/change_password_post.php"); 
    } 

?>


  <form action="#" method="post">
    <div class="row row-cols-1 row-cols-md-2 p-2">
      <div class="col">
        <div class="col-12 text-center">
          <img src="../img/114628-reset-password.gif" class="w-75"><br>
        </div>
      </div>
      <div class="col">
        <div class="col-12 ">

          <div class="col-10 text-center mt-3 m-auto"
            style="padding: 1rem;border-radius: 10px;box-shadow: 0px 0px 10px black;">
              <div class="col-12  text-center p-1"><span class="fs-1 fw-bold">Reset Password</span><br><span>Please enter your new Password :</span></div>
              <div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" name="oldPass" id="oldPass"><label class="ms-4" for="floatingInput">Old-Password</label></div>
              <div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" onkeyup="passcheck();" name="newPass" id="newPass"><label class="ms-4" for="floatingInput">New Password</label></div>
              <div class="container form-floating mb-3 mt-2 w-100"><input type="password" class="form-control ps-4" onkeyup="passcheck();" name="confirmnewPass" id="confirmnewPass"><label class="ms-4" for="floatingInput">Confirm New Password</label></div>

                <h5 id="passcheck"></h5>
                    
                      <button type="button" id="submitButton" class="btn col-4" style="background:red; color:white">Submit</button>
                      <input type="hidden" name="o" value="<?php print $o; ?>">
                      <input type="hidden" name="submit" value="CHANGE_PASSWORD">
                      <input type="hidden" name="id" value="<?php print $_SESSION['adminemail']; ?>">
                
            </div>
          </div>
        </div>
      </div>
    <!--</div>-->
  </form>
  
  
<script type="text/javascript">
function passcheck(){
  if ($('#newPass').val() !== '' && $('#confirmnewPass').val() !== '') {
    if ($('#newPass').val() === $('#confirmnewPass').val()) {
      $('#passcheck').html("Password Matched.");
      $('#submitButton').prop('disabled', false); // Enable the button
    } else {
      $('#passcheck').html("Password didn't match!!!");
      $('#submitButton').prop('disabled', true); // Disable the button
    }
  }
}
</script>
  

<?php include "../footer.php"; ?>