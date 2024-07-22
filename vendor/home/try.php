<?php
include "header.php"; 
?>
<div class="container">
<table class="table table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>First</th>
      <th>Last</th>
      <th>Handle</th>
    </tr>
  </thead>
    <tbody>
<?php 
for($i=0; $i<=5; $i++){
?>
    <tr>
      <td><a href="#" style="text-decoration:none; color:black;"><i class="bi bi-plus-circle toggleBtn">&nbsp;&nbsp;&nbsp; 1</i></a></td>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
    <tr class="childTable">
        <td></td>
        <td colspan="2">
         <table class="table">
              <thead>
                <tr>
                  <th >#</th>
                  <th >First</th>
                  <th >Last</th>
                  <th >Handle</th>
                  <th >Handle</th>
                </tr>
              </thead>
                <tbody>
                    <?php 
                        for($j=1; $j<=2; $j++){
                    ?>
                <tr>
                  <td>1</td>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td>@mdo</td>
                  <td>@mdo</td>
                </tr>
                    <?php 
                        }
                    ?>
              </tbody>
            </table> 
            </td>
      </tr>
    <?php 
}
?>
  </tbody>
</table>
</div>
<script>
$(document).ready(function(){
    $(".childTable").css("display", "none");
    $(".toggleBtn").click(function(){
        // alert('clicked');
      $(this).parent().parent().parent().next('.childTable').toggle(); 
    });
});
</script>
<?php
include "footer.php" 
?>
