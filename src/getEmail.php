<!DOCTYPE html>
<html>
<title>Password Recovery | Get Code</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="styles/password_recovery_email_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="js/password_recovery_js.js"></script>
<body class="w3-light-gray"  onload="onPageLoad()">
<div class="w3-container w3-center" id="positivemessageBox" style="display: none;">
    <div class="w3-display-middle">
        <i class="fa w3-padding fa-check w3-text-green w3-animate-zoom" style="font-size: 200px"></i>
        <h4>Password reset successful</h4>
        <p>Password reset was done</p>
        <a href="
        <?php
        session_start();
        session_unset();
        session_destroy();
        $xml = simplexml_load_file("../password_recovery_email_credentials/password_reset_credentials.xml");
        echo (string)$xml->continueLink;
        ?>" class="w3-btn w3-blue w3-round w3-animate-top">Continue <i class="fa fa-arrow-right"></i></a>
    </div>
</div>

<div class="w3-container w3-center" id="negativemessageBox" style="display: none;">
    <div class="w3-display-middle">
        <i class="fa w3-padding fa-shield w3-text-red w3-animate-zoom" style="font-size: 200px"></i>
        <h4>You're caught</h4>
        <p>That was a security bypass you attempted.</p>
        <button onClick="window.location.href=window.location.href" class="w3-btn w3-black w3-round w3-animate-top">
            Try Again <i class="fa fa-refresh w3-spin"></i>
        </button>
    </div>
</div>
<div class="w3-container w3-center" id="formsBox">
    <div class="w3-margin w3-display-topleft w3-text-grey">
        <a onClick="javascript:history.go(-1)"><i class="fa fa-arrow-left "></i> Back</a>
    </div>
    <div class="w3-display-middle">
        <img src="js/keyPic.png" style="width: 90px" class="w3-animate-top"/>
        <h4>Reset Password</h4>

        <div id="secondForm" style="display: none">
        <p class="w3-text-green" id="popupMessage">Please enter OTP sent to xxxxxx@xxxxx</p>
            <br>
        <input id="codeInput" class="w3-input w3-light-gray w3-round w3-center" placeholder="Enter Code Recieved" type="number" autocomplete="off"/>
        <label id="codeInputError" style="display: none;" class="w3-animate-top w3-small w3-text-red w3-left" style="margin-top: 0px">Invalid code</label>
        <br>
        <input id="newPasswordInput" class="w3-input w3-light-gray w3-round w3-center" placeholder="New Password" type="password" autocomplete="off"/>
        <br>
        <input id="confirmPasswordInput" class="w3-input w3-light-gray w3-round w3-center" placeholder="Confirm Password" type="password" autocomplete="off"/>
            <label id="confirmPasswordInputError" style="display: none;" class="w3-animate-top w3-small w3-text-red w3-left" style="margin-top: 0px">Passwords don't match</label>
            <br>
        <button id="actionButton2" onclick="validateInput2()" class="w3-btn w3-margin-top w3-round w3-blue w3-center">Change Password <i id="buttonIcon2" class="fa fa-arrow-right"></i></button>
        </div>

        <br>

        <div id="firstForm">
            <input id="emailInput" class="w3-input w3-light-gray w3-round w3-center" placeholder="Enter account Email" type="email" autocomplete="off"/>
            <label id="emailInputError" class="w3-animate-top w3-small w3-text-red w3-left" style="margin-top: 0px">Unregistered Email</label>
            <br>

            <!-- <input class="w3-input w3-round w3-light-gray w3-center"  placeholder="OTP Recieved"/>
            <br> -->
            
            <img id="captchaImage" src="captcha/captcha_code.php" class="w3-animate-zoom w3-round" style="width: 80px"/>
            <i id="captchaRefresh" class=" w3-margin-left fa fa-refresh" onclick="document.getElementById('captchaImage').src='captcha/captcha_code.php'"></i>
            <input id="captchaInput" name="captcha_code" maxlength="6" class="w3-input w3-round w3-light-gray w3-margin-top w3-center" style="min-width: 30px" placeholder="Captcha Text" type="text" autocomplete="off">
            <label id="captchaInputError" class="w3-animate-top w3-small w3-text-red w3-left" style="margin-top: 0px">Invalid captcha</label>
            <br>
            <button id="actionButton" onclick="validateInput()" class="w3-animate-bottom w3-btn w3-margin-top w3-round w3-green w3-center"><i id="buttonIcon" class="fa fa-check"></i> Validate</button>
        </div>

        
        
    </div>
</div>


</body>
</html>
