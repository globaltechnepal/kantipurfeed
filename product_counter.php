<?php 
// include 'header.php';
?>
  <div class="d-inline-flex">
  <div class="v-counter">
  <input type="button" class="minusBtn" value="-" />
  <input type="text" size="25" value="1" id="order_count" readonly class="count fs-5" style="color:red" />
  <input type="button" class="plusBtn" value="+" />
  </div>
  <div class="pt-3 fw-bold">Units</div>
  </div>
  <script>
    $(document).ready(function(){
      $(".minusBtn").click(function(){
        var val = $(this).next("#order_count").val();
        val = parseInt(val);
        if(val<=1){
          val=1;
        $(this).next("#order_count").val(val);
          alert("Minimum order quantity is 1");
        }else{
          val=val-1;
        $(this).next("#order_count").val(val);
        }
        $("#pv_id_selected_quantity").val(val);
      });
      $(".plusBtn").click(function(){
        var val = $(this).prev("#order_count").val();
        val = parseInt(val);
        if(val>=20){
          val=20;
        $(this).next("#order_count").val(val);
          alert("Maximum order quantity is 20");
        }else{
          val=val+1;
        $(this).prev("#order_count").val(val);
        }
        $("#pv_id_selected_quantity").val(val);
      });
    });
  </script>



<?php 
// include 'footer.php';
?>