<?php

session_start();

if (isset($_SESSION["adminemail"])) {
    unset($_SESSION["adminemail"]);

?>

<script>
    window.location.href = 'http://kantipurfeed.com/admin/';
</script>

<?php } ?>
