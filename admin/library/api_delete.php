<?php
include('connect_server.php');
$conn = dbConnecting();
$id =$_GET['id'];
$sqlquery = "DELETE FROM `api` WHERE id='$id'";
$result = mysqli_query($conn,$sqlquery);
if(isset($result) != null){
echo"<script>
window.location.href='https://kantipurfeed.com/assets/Dashboard/api_integration.php';
</script>
";
}else{
echo"<script>window.location.href='https://kantipurfeed.com/assets/Dashboard/api_integration.php';</script>"; 
}
?>