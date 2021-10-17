<?php
function sendMail($to,$subject,$msg)
{
include_once('../mail/PHPMailerAutoload.php');
$mail = new PHPMailer;

		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = 'smtp.gmail.com';  
		$mail->Port = 587;
		$mail->SMTPSecure = "tls";
		$mail->SMTPAutoTLS = True;
		$mail->SMTPAuth = true;
		$mail->Username = "informaticmedia5@gmail.com";
		$mail->Password = "admin1212";
		$mail->setFrom('informaticmedia5@gmail.com', "Informatic Media");
		$mail->addAddress($to);
		$mail->Subject = $subject;
		//$mail->msgHTML(file_get_contents('mail2.php'), dirname(_FILE_));
		$mail->Body = $msg;
		//$mail->addAttachment($folder.'hn-backup-'.date("d-m-Y").'.sql');
		$mail->send();


 }              

?>