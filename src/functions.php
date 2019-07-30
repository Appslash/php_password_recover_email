<?php
function EmailSend($to,$subject,$message)
{
    require_once('PHPMailer-master/PHPMailerAutoload.php');
    $xml=simplexml_load_file("../password_recovery_email_credentials/password_reset_credentials.xml") or die("Error: Cannot create object");
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(FALSE);
    $mail->Username = $xml->Username;
    $mail->Password = $xml->Password;
    $mail->SetFrom($xml->From);
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($to);
    return (!$mail->Send());
}
?>


