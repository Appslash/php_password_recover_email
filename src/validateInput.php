<?php
session_start();
$response['response']='OK';

if($_POST["captchaInput"]===$_SESSION["captcha_code"])
    {
        $response['captchavalid']='TRUE';

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
           
            

        } else {
            $response['response']='NOT_FOUND';
        }
        $conn->close();




    }
    else
    {
        $response['captchavalid']='FALSE';
    }
echo json_encode($response);
?>