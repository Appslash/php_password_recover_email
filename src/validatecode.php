<?php

session_start();
if(!(isset($_SESSION["email"])&&isset($_SESSION["email"])))
{
    session_unset();
    session_destroy();
    $response['responseCode']='FAIL';
$response['codevalid'] = 'TRUE';
}
else {
    include 'functions.php';
    $response['responseCode'] = 'OK';
    if ($_POST["codeInput"] === (string)$_SESSION["OTP"]) {
        $response['codevalid'] = 'TRUE';
        $xml = simplexml_load_file("../password_recovery_email_credentials/password_reset_credentials.xml");
        $table = (string)$xml->credential_table;
        $update_timestamp_field = (string)$xml->update_timestamp_field;
        $email_password_field = (string)$xml->email_password_field;
        $emailRef = (string)$xml->email_field;
        $servername = (string)$xml->dbserver;
        $username = (string)$xml->dbuser;
        $password = (string)$xml->dbpassword;
        $dbname = (string)$xml->db;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            $response['responseCode'] = 'DATABASE_ERROR';
        }
//    $sql="UPDATE ".$table." set ".$email_password_field." = '".$_POST["passwordInput"]."'";
        $dt = new DateTime('now', new DateTimezone((string)$xml->timeZone));
        $stamp=date_format($dt, 'Y-m-d H:i:s');
        $sql = "UPDATE " . $table . " SET " . $email_password_field . " =? ,".$update_timestamp_field."=?  where " . $emailRef . "=?";
        $stmt = $conn->stmt_init();
        if (!$stmt->prepare($sql)) {
            $response['response'] = 'DATABASE_ERROR';
        } else {
            $stmt->bind_param("sss", $_POST["passwordInput"],$stamp, $_SESSION["email"]);
            $stmt->execute();
            if ($stmt->affected_rows === 0) {
                $response['responseCode'] = 'DATABASE_ERROR';
            } else {
                $response['responseCode'] = 'SUCCESS';
            }
            session_unset();
            session_destroy();
        }

        $stmt->close();
        $conn->close();
    } else {
        $response['codevalid'] = 'FALSE';
    }
}
echo json_encode($response);
?>