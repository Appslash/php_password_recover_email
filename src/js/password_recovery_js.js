function onPageLoad()
{
document.getElementById("emailInputError").style.display="none";
document.getElementById("captchaInputError").style.display="none";

}

function validateInput() 
{
    onPageLoad();
    var emailInput=document.getElementById("emailInput").value;
    if(ValidateEmail(emailInput))
    {
        //VALIDATION ON SERVER
        var captchaInput=document.getElementById("captchaInput").value;
        if(captchaInput) {
            document.getElementById("buttonIcon").classList.add('w3-spin');
            document.getElementById("buttonIcon").classList.replace('fa-check','fa-spinner');

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var serverResponse = this.responseText;

                    var obj = JSON.parse(serverResponse);
                    if(obj.captchavalid=="TRUE")
                        {
                            if(obj.response!="NOT_FOUND")
                            {
                                document.getElementById("popupMessage").innerHTML="Password reset code sent to "+emailInput;
                                document.getElementById("firstForm").style.display="none";
                                document.getElementById("secondForm").style.display="block";
                                document.getElementById("buttonIcon").classList.remove('w3-spin');
                                document.getElementById("buttonIcon").classList.replace('fa-spinner','fa-check');
                            }
                            else
                            {
                                document.getElementById('captchaImage').src='captcha/captcha_code.php';
                                document.getElementById("emailInputError").innerHTML="Unregistered Email";
                                document.getElementById("emailInputError").style.display="block";
                                document.getElementById("buttonIcon").classList.remove('w3-spin');
                                document.getElementById("buttonIcon").classList.replace('fa-spinner','fa-check');
                            }
                        }
                    else
                        {
                            document.getElementById("captchaInputError").innerHTML="Invalid captcha";
                            document.getElementById("captchaInputError").style.display="block";
                            document.getElementById("buttonIcon").classList.remove('w3-spin');
                            document.getElementById("buttonIcon").classList.replace('fa-spinner','fa-check');
                        }
                }
            };
            xhttp.open("POST", "validateInput.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("captchaInput=" +captchaInput+"&emailInput="+emailInput);
        }
        else
        {
            document.getElementById("captchaInputError").innerHTML="This cannot be empty";
            document.getElementById("captchaInputError").style.display="block";
        }

        
    }
    else
    {
        document.getElementById("emailInputError").innerHTML="Not a valid Email";
        document.getElementById("emailInputError").style.display="block";
    }
}

function validateInput2()
{

    var codeInput=document.getElementById("codeInput").value;
    var newPassword=document.getElementById("newPasswordInput").value;
    var confirmPassword=document.getElementById("confirmPasswordInput").value;
    if(!newPassword)
    {
        document.getElementById("confirmPasswordInputError").innerHTML="Password field cannot be empty";
        document.getElementById("confirmPasswordInputError").style.display="block";
    }
else {
        if (newPassword == confirmPassword) {
            document.getElementById("buttonIcon2").classList.add('w3-spin');
            document.getElementById("buttonIcon2").classList.replace('fa-arrow-right', 'fa-spinner');
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var serverResponse = this.responseText;
                    var obj = JSON.parse(serverResponse);
                    if (obj.codevalid == "TRUE") {
                        alert(serverResponse);
                        document.getElementById("buttonIcon2").classList.remove('w3-spin');
                        document.getElementById("buttonIcon2").classList.replace('fa-spinner', 'fa-arrow-right');
                    } else {
                        document.getElementById("codeInputError").innerHTML = "Invalid Code";
                        document.getElementById("codeInputError").style.display = "block";
                        document.getElementById("buttonIcon2").classList.remove('w3-spin');
                        document.getElementById("buttonIcon2").classList.replace('fa-spinner', 'fa-arrow-right');
                    }
                }
            };
            xhttp.open("POST", "validatecode.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("codeInput="+codeInput+"&passwordInput="+newPassword);


        } else {
            document.getElementById("confirmPasswordInputError").innerHTML="Passwords don't match";
            document.getElementById("confirmPasswordInputError").style.display = "block";
            document.getElementById("buttonIcon2").classList.remove('w3-spin');
            document.getElementById("buttonIcon2").classList.replace('fa-spinner', 'fa-right-arrow');
        }
    }
}

function ValidateEmail(mail)
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    
    return (false)
}

