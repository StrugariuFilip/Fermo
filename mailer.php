<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '/home/fermddgw/public_html/Fermo/PHPMailer-master/src/Exception.php';
require '/home/fermddgw/public_html/Fermo/PHPMailer-master/src/PHPMailer.php';
require '/home/fermddgw/public_html/Fermo/PHPMailer-master/src/SMTP.php';

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "server39.web-hosting.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
$mail->Username = "NO-REPLY@fermo.shop";
$mail->Password = "";


$mail->isHTML(true);
return $mail;

?>

