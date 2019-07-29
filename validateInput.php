<?php
session_start();
if($_POST["captchaInput"]===$_SESSION["captcha_code"])
    {
        echo 'Passed';
    }
    else {
        echo 'captcha fail';
    }

?>