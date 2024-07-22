<?php
session_start();
// echo $_SESSION["adminemail"];
if (isset($_SESSION["vendor_email"])) {
    unset($_SESSION["vendor_email"]);
    // die();
?>
<script>
    window.location.href = 'http://kantipurfeed.com/';
</script>
<?php
}
?>