<?php
$to = "ananda.globaltech@gmail.com";
$subject = "Confirm Order";
$message = "Hehe";
$from = "anandaaryal54@gmail.com";
$headers = "From: $from";

mail($to, $subject, $message, $headers);

echo "Mail sent successfully";
?>