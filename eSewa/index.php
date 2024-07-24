<?php 
include 'main/setting.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>ePay</title>
</head>
<body>
    <div class="col-2 m-auto mt-5 bg-warning text-center p-5" style="width=500px;height=500px;">
        <!-- <form action="<?php echo $form_submit_url; ?>" method="POST"> -->
            <input value="<?php echo $counting; ?>" name="pid" id="pid" type="hidden"> <!-- value="ee2c3ca1-696b-4cc5-a6be-2c40d929d453" -->
            <input class="btn btn-primary" value="Pay Rs.100" type="submit" id="esewaPay">
        <!-- </form> -->
    </div>
<!-- script section  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#esewaPay').on('click', function () {
            var pid = $("input[name='pid']").val();
            alert("fine working"+pid);
            var path="https://uat.esewa.com.np/epay/main";
            var params= {
                amt: 100,
                psc: 0,
                pdc: 0,
                txAmt: 0,
                tAmt: 100,
                pid: pid,
                scd: "EPAYTEST",
                su: "https://ultimanepal.com/eSewa/main/success.php",
                fu: "https://ultimanepal.com/eSewa/main/failed.php"
            }
            console.log(path);
            post(path, params);
        });

function post(path, params) {
    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", path);

    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);
        form.appendChild(hiddenField);
    }

    document.body.appendChild(form);
    form.submit();
} 
 
});
</script>
</body>
</html>