<?php
echo "Mail sending";
require_once '../../mail/contactform/vendor/autoload.php';
require_once '../../mail/contactform/functions.php';
require_once '../../mail/contactform/config.php';
$mail = new \PHPMailer\PHPMailer\PHPMailer(true);
$mail->isSMTP();
$mail->SMTPDebug = CONTACTFORM_PHPMAILER_DEBUG_LEVEL;// 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = CONTACTFORM_SMTP_HOSTNAME;// use $mail->Host = gethostbyname('smtp.gmail.com'); // if your network does not support SMTP over IPv6
$mail->Port = CONTACTFORM_SMTP_PORT;// TLS only
$mail->SMTPSecure = CONTACTFORM_SMTP_ENCRYPTION;// ssl is deprecated
$mail->SMTPAuth = true;
$mail->Username = CONTACTFORM_SMTP_USERNAME;// email
$mail->Password = CONTACTFORM_SMTP_PASSWORD;// Applicaton password
// Recipients
$mail->setFrom(CONTACTFORM_FROM_ADDRESS, CONTACTFORM_FROM_NAME);
$mail->addAddress("krishnendugopi8592@gmail.com", "Krish"); // to email and name
// Content
$mail->Subject = "activation";
$mail->msgHTML("fghgfeygfyewgyuwgrywrytr"); //$mail->msgHTML(file_get_contents('contents.html'), __DIR__); //Read an HTML message body from an external file, convert referenced images to embedded,
$mail->AltBody = 'HTML messaging not supported'; // If html emails is not supported by the receiver, show this body
if (!$mail->send()) {
  $response['status'] = "error4";
  $_SESSION['error'] = "Email can't Send";
}
?>