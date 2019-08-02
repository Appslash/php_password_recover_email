<?php
session_start();

$response['responsecode']='OK';
include 'functions.php';
if(substr($_POST["captchaInput"],0,6)===$_SESSION["captcha_code"])
    {
        $response['captchavalid']='TRUE';
        /**
         * CHANGE THE PATH BELOW TO REFER TO password_recovery_email_credentials/password_reset_credentials.xml FILE
         */
        $xml=simplexml_load_file("../password_recovery_email_credentials/password_reset_credentials.xml");
        $table=(string)$xml->credential_table;
        $emailRef=(string)$xml->email_field;
        $servername = (string)$xml->dbserver;
        $username = (string)$xml->dbuser;
        $password = (string)$xml->dbpassword;
        $dbname = (string)$xml->db;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            $response['response']='DATABASE_ERROR';
        } 

        $sql = "SELECT ".$emailRef." FROM ".$table." where ".$emailRef."='".$_POST['emailInput']."'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
           $_SESSION["OTP"]=rand(1000,9999);
           $_SESSION["email"]=$_POST['emailInput'];
           EmailSend($_POST['emailInput'],'Password reset code for your '.$xml->organization_account_name,"Hi,<br><br>Password recovery code for your ".$xml->organization_account_name." is <b>".$_SESSION["OTP"]."</b>.<br><br>Regards,<br>Password Recovery Team.");

        } else {
            $response['responsecode']='NOT_FOUND';
        }
        $conn->close();

    }
    else
    {
        $response['captchavalid']='FALSE';
    }
echo json_encode($response);
?>