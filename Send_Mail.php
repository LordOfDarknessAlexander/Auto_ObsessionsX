<?php
function Send_Mail($to,$subject,$body)
{
require 'class.phpmailer.php';
$from       = "asanchez@auto-obsessions.me";
$mail       = new PHPMailer();
$mail->IsSMTP(true);            // use SMTP
$mail->IsHTML(true);
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "tls://smtp.851entertainment.com/Auto_ObsessionsX"; // SMTP host
$mail->Port       =  465;                    // set the SMTP port
$mail->Username   = "SMTP_Username";  // SMTP  username
$mail->Password   = "SMTP_Password";  // SMTP password
$mail->SetFrom($from, 'From Name');
$mail->AddReplyTo($from,'From Name');
$mail->Subject    = $subject;
$mail->MsgHTML($body);
$address = $to;
$mail->AddAddress($address, $to);
$mail->Send(); 
}
?>