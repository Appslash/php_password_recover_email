function onPageLoad()
{
document.getElementById("popupMessage").style.display="none";
document.getElementById("emailInputError").style.display="none";
document.getElementById("captchaInputError").style.display="none";

}

function validateInput() 
{
    onPageLoad();
    document.getElementById("buttonIcon").classList.add('w3-spin');
    document.getElementById("buttonIcon").classList.replace('fa-check','fa-spinner');

    var emailInput=document.getElementById("emailInput").value;
    if(ValidateEmail(emailInput))
    {
        //VALIDATION ON SERVER
        var captchaInput=document.getElementById("captchaInput").value;
        if(captchaInput) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var serverResponse = this.responseText;
                    var obj = JSON.parse(serverResponse);
                    if(obj.captchavalid=="TRUE")
                        {
                            if(obj.response!="NOT_FOUND")
                            {
                                    alert("SEND OTP NOW"+serverResponse);
                            }
                            else
                            {
                            
                                document.getElementById('captchaImage').src='captcha/captcha_code.php';
                                document.getElementById("emailInputError").innerHTML="Unregistered Email";
                                document.getElementById("emailInputError").style.display="block";    
                            }
                        }
                    else
                        {
                            document.getElementById("captchaInputError").innerHTML="Invalid captcha";
                            document.getElementById("captchaInputError").style.display="block";
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

    document.getElementById("buttonIcon").classList.remove('w3-spin');
    document.getElementById("buttonIcon").classList.replace('fa-spinner','fa-check');

}

function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    
    return (false)
}