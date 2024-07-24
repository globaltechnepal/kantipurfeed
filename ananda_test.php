<?php include "header.php" ?>
    <form action="#" method="post">
        <input type="checkbox" id="check_id">
        <button type="button" id="btnClick" class="btn btn-danger">Click</button>
    </form>

<script>
    $("document").ready(function(){
        $("#btnClick").attr("disabled", "disabled");
        $("#check_id").click(function(){
            if($("#check_id").prop("checked")==false){
                $("#btnClick").attr("disabled","disabled")
            }
            else if($("#check_id").prop("checked")==true){
                $("#btnClick").removeAttr("disabled")
            }
        })
    })
</script>
<div id="secBtn">
<form action="#" method="post">
    <input type="checkbox" id="checkboxID">
    <button type="button" id="clickBtnID" class="btn btn-danger">Click</button>
</form>
</div>
<script>
    $("document").ready(function(){
        $("#clickBtnID").prop("disabled","disabled")
        $("#checkboxID").click(function(){
        if($("#checkboxID").prop("checked")==false) {
            $("#clickBtnID").attr("disabled","disabled");
            alert("Button unchecked");
        } 
        else if($("#checkboxID").prop("checked")==true){
            $("#clickBtnID").removeAttr("disabled");
            alert("Button checked!!!!!!!!! Hurrey")
        }
        })
    })
</script>
<script>
    $("document").ready(function(){
     $("#secBtn").hide(); 
     $("#btnClick").click(function(){
     $("#secBtn").show();  
     })
     $("#check_id").click(function(){
    if($("#check_id").prop("checked") == false) {
     $("#secBtn").hide();  
    }
     })
    })
    
</script>
<?php include "footer.php" ?>
