<?php
$to = "anandaaryal54@gmail.com";
$subject ="try garako";
$message ="to test mail aayo ki nae";
$from = "globalananda21@gmail.com";
$header = "From: $from";
mail($to, $submit, $message,$header);
echo "Mail Send";
?>