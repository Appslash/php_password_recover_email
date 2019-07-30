<?php
session_start();
$response['response']='OK';
if($_POST["captchaInput"]===$_SESSION["captcha_code"])
    {
        $response['captchavalid']='TRUE';

    }
    else
    {
        $response['captchavalid']='FALSE';
    }
echo json_encode($response);
?>