<?php
function EmailSend($to,$subject,$message)
{
    $xml=simplexml_load_file("../password_recovery_email_credentials/password_reset_credentials.xml") or die("Error: Cannot create object");
    if($xml->SMTPToUse==="HOST")
    {
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=iso-8859-1\n";
     mail($to,$subject,$message,$headers);
    }
    else
    {
    require_once('PHPMailer-master/PHPMailerAutoload.php');
    $mail = new PHPMailer(); // create a new object
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(TRUE);

    $mail->Username = $xml->emailid;
    $mail->Password = $xml->emailpassword;
    $mail->SetFrom($xml->emailid,"Password Reset Assistant");
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AddAddress($to);
    return (!$mail->Send());
    }
}
?>


