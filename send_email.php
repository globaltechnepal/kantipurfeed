<?php
$to = 'anandaaryal54@gmail.com';
$subject = 'Test Email';
$message = 'This is a test email sent using the mail() function in PHP.';
$headers = 'From: ananda.globaltech@gmail.com' . "\r\n" .
           'Reply-To: sender@example.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully';
} else {
    echo 'Email not sent';
}
?>