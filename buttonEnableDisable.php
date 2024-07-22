<?php include "header.php" ?>
    <form action="#" method="post">
        <input type="checkbox" id="check_id">
        <button type="button" id="btnClick">Click</button>
    </form>

<script>
$(document).ready(function(){
$("#btnClick").attr("disabled","disabled");
$("#check_id").click(function(){
    if($("#check_id").prop('checked')==false){
        $("#btnClick").attr("disabled","disabled");
    }
    else{
        $("#btnClick").removeAttr("disabled");
    }
});
})
</script>

<!-- <script>
   $(document).ready(function(){
    $('#btnClick').attr("disabled", "disabled");
    $("#check_id").click(function(){
        if ($("#check_id").prop('checked') == false) {
            $('#btnClick').attr("disabled", "disabled");
        }
        else if ($("#check_id").prop('checked') == true) {
            $("#btnClick").removeAttr("disabled");
        }
    });
    // });
    $('#btnClick').click(function () {
           alert("I am happy. button in enable");
       });
   });
</script> -->
<?php include "footer.php" ?>
