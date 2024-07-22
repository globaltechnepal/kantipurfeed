<?php
include "header.php";
?>
<div class="p-3 mb-2 col bg-dark text-white text-center">Choose Color </div>
<form action="#" method="POST" enctype="multipart/form-data">
    <div class="row p-3 m-2" style="border:1px solid">
        <div class="col-md-auto text-center">
            <span class="input-group-text" id="basic-addon1">Color Name : &nbsp;
                <input type="text" class="form-control" id="clrName" name="clrName">
            </span>
        </div>
        <div class="col text-center">
            <span class="input-group-text" id="basic-addon1">Color Code : &nbsp;
                <input type="color" class="form-control" id="clrCode" name="clrCode">
            </span>
        </div>
        <div class="text-center mt-3">
            <input class="btn btn-danger" type="button" value="Submit" id="submitColor">
        </div>
    </div>
</form>
<script>
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
                success: function () {
                    alert("Color added successfully");
                }
            });
        }
    });

</script>
<?php
include "footer.php";
?>