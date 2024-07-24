<?php

session_start();

if (isset($_SESSION["adminemail"])) {
    unset($_SESSION["adminemail"]);

?>

<script>
    window.location.href = 'http://localhost:8080/kantipurfeed/admin/';
</script>

<?php } ?>
