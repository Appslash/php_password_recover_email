<?php
session_start();
include 'functions.php';
$response['response']='FALSE';
if($_POST["codeInput"]===(string)$_SESSION["OTP"])
{
    $response['codevalid']='TRUE';

}
else
{
    $response['codevalid']='FALSE';
}

echo json_encode($response);
?>