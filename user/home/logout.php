<?php
session_start();
// echo $_SESSION["adminemail"];
if (isset($_SESSION["email"])) {
    unset($_SESSION["email"]);
    // die();
?>
<script>
    window.location.href = 'http://kantipurfeed.com/';
</script>
<?php
}
?>