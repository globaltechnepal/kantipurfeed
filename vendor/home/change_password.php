<?php include "header.php" ?>
<div class="topbar  pt-3"><a class="btn"><i class="bi bi-list p-3" id="colpsCustom"></i></a><span class="fw-bold mt-3">Change
        Password</span>
</div>
<div class="row m-3 " style="border:1px solid #bbbbbb;background-color: #e5e5e5;">
    <div class="col m-3" style="border:1px solid black; background-color: white;">
        <input type="hidden" id="userEmail" value="<?php echo $_SESSION['vendor_email']; ?>">
        <div class="input-group mb-3 mt-3">
            <span class="input-group-text font_size_in_mobile" id="basic-addon1">Old Password :</span>
            <input type="password" class="form-control" id="oldPass">
        </div>
        <div class="input-group mb-3 mt-3">
            <span class="input-group-text font_size_in_mobile" id="basic-addon1">New Password :</span>
            <input type="password" class="form-control" id="newPass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                minlength="8">
        </div>
        <div class="input-group mb-3 ">
            <span class="input-group-text font_size_in_mobile" id="basic-addon1">Confirm New Password :</span>
            <input type="password" class="form-control" id="confirmPass">
        </div>
        <button type="button" class="btn btn-danger mb-3" id="submitBtn">Submit</button>
    </div>
</div>

<script>
    $("#submitBtn").click(function () {
        var oldPass = $("#oldPass").val();
        var userEmail = $("#userEmail").val();
        var newPass = $("#newPass").val();
        var confirmPass = $("#confirmPass").val();
        if (newPass == "" || confirmPass == "" || userEmail == "") {
            alert("Please fill the form properly.");
        }
        else if (newPass !== confirmPass) {
            alert("Confirm password does't match with new password");
        }
        else {
            $.ajax({
                url: "assets/library/database.php",
                method: "POST",
                data: { vendor_change_password: newPass, userEmail: userEmail,oldPass:oldPass },
                success: function (data) {
                    console.log(data);
                var da = JSON.parse(data);
                 if(da.status_code==200){
                    alert("Password Change successfully.");
                }
                else{
                    alert("Old Password did't match");
                }
                    // location.reload();
                }
            });
        }
    })
</script>
<?php include "footer.php" ?>