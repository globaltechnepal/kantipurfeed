<?php include "header.php"; ?>
<div class="p-2" style="background-color: white;">
    <div class="m-2" style="border: 1px solid #bdb5b5;">
        <div class="row row-cols-1 row-cols-sm-1 row-cols-md-1 row-cols-lg-1 row-cols-xxl-2">
            <div class="input-group  col col-sm-12 row">
                <span class="col ms-3 mt-2 col-sm-12 col-md-8 input-group-text" id="basic-addon1">Delivery Reference ID : 
                    <input type="text" id="deliveryTextFIeld" class="w-100 form-control bg-white"  aria-describedby="basic-addon1"></span>
            </div>
            <div class="col m-3">
                <button type="button" class="btn btn-danger" id="SubButton">Submit</button>
            </div>
        </div>
        <div class="mt-2 ms-3 mb-3">
            <div id="deliveryStatus"></div>
        </div>
    </div>
</div>
<script>

    $(document).ready(function () {
        $("#SubButton").attr("disabled", "disabled");
        $("#deliveryTextFIeld").keyup(function () {
            // alert("changr");
            var texta = $(this).val();
            // alert (texta);
            if (texta.length > 6) {
                $("#SubButton").removeAttr("disabled"); //console.log('27');
            }
            else {
                $("#SubButton").attr("disabled", "disabled"); //console.log('30');
            }
        });
 

        $("#SubButton").click(function(){
            var ref_num=$("#deliveryTextFIeld").val();
            var status='';
            //making server request to check delivery status
            $.ajax({
            url: 'assets/library/delivery_control.php',
            type: 'POST',
            data: {ref_num:ref_num},
            datatype: 'json',
            success: function (data) { 
                var da = JSON.parse(data);
                console.log(da.message);
                var code=da.status_code;
                var color='black';
                status = da.delivery_status;
                if(status == null){
                    status = "cancled";
                }
                if(status=='delivered'){ color = "#24d528";}
                else if(status=='pending'){color = "#607D8B";}
                else{color = "#f70f0f";}
                // alert('ok');

                var html = '';
                html +='<span> Your Delivery Status is : ';
                html +='<span style="color:'+color+';" class="fw-bold text-uppercase">'+status+'</span></span>'
                $("#deliveryStatus").empty();
                $("#deliveryStatus").append(html);
            },
            error: function (jqXHR, textStatus, errorThrown) { 
                alert ('errore');
                errorFunction(); }
            });
        });

    });
</script>
<?php include "footer.php"; ?>