<?php
session_start();
$print = 'empty';
if(isset($_SESSION['session_name'])){
if($_SESSION['session_name']!=''){
    $print = $_SESSION['session_name'];
}
else if($_SESSION['session_name']==''){
    $print = 'empty';
}
}
echo $print;
?>
<form action="#" method="post">
    <input type="text" name="session_name" value="new session">
    <input type="submit" name="set_session" value="set_session">
    <input type="submit" name="unset_session" value="unset_session">
</form>
<?php
if(isset($_POST['set_session'])){
    $session_name = $_POST['session_name'];
    $_SESSION['session_name']=$session_name;
    header("location:testsession.php");
}
if(isset($_POST['unset_session'])){
    unset($_SESSION['session_name']);
    header("location:testsession.php");
}

?>