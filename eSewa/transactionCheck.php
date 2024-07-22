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
<div class="p-3">
    <form id="myForm" action="https://uat.esewa.com.np/epay/transrec" method="post">
    <input value="100" name="amt" id="amt" class="m-1"><br>
    <input value="EPAYTEST" name="scd" id="" class="m-1"><br>
    <input value="16" name="pid" id="pid" class="m-1"><br>
    <input value="0004U4M" name="rid"  id="refId" class="m-1"><br>
    <input value="Submit" type="button" id="submitBtn" class="m-1">
    </form>
</div>




<?php
function validate(){
   $url = "https://uat.esewa.com.np/epay/transrec";
$data =[
    'amt'=> 100,
    'rid'=> '0005464',
    'pid'=>'23',
    'scd'=> 'EPAYTEST'
];

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    echo "The Response is :".$response;
    curl_close($curl);
    }
    validate();

?>















  
<!-- script section  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    // $(document).ready(function(){
    //   $("#submitBtn").click(function(){
           
    //       var frms=  $("#myForm");
        
    //         $.post("https://uat.esewa.com.np/epay/transrec", $.param($(frms).serializeArray()), function(data) {
    //     alert('okk');
    //         });
        
        //   alert('clicked');
        //   var amt = $("#amt").val();
        //   var scd = $("#scd").val();
        //   var pid = $("#pid").val();
        //   var refId = $("#refId").val();
        //   $.ajax({
        //     url: "https://uat.esewa.com.np/epay/transrec",
        //     method: "POST",
        //     data: { amt:amt,scd:scd,pid:pid,refId:refId},
        //     success: function (data) {
        //         console.log(data);
        //         alert("Done");
        //         location.reload();
        //     }
        //   });
    //   });
    // });
    
//     var path="https://uat.esewa.com.np/epay/transrec";
// var params= {
//     amt: 100,
//     rid: "000AE01",
//     pid: "ee2c3ca1-696b-4cc5-a6be-2c40d929d453",
//     scd: "EPAYTEST"
// }

// function post(path, params) {
//     var form = document.createElement("form");
//     form.setAttribute("method", "POST");
//     form.setAttribute("action", path);

//     for(var key in params) {
//         var hiddenField = document.createElement("input");
//         hiddenField.setAttribute("type", "hidden");
//         hiddenField.setAttribute("name", key);
//         hiddenField.setAttribute("value", params[key]);
//         form.appendChild(hiddenField);
//     }

//     document.body.appendChild(form);
//   console.log( form.submit());
// }
// var ok=post(path,params);
// console.log(ok);
</script>
</body>
</html>