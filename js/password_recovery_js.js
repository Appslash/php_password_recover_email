function onPageLoad()
{
document.getElementById("popupMessage").style.display="none";
document.getElementById("emailInputError").style.display="none";
document.getElementById("captchaInputError").style.display="none";

}

function validateInput() 
{
    document.getElementById("buttonIcon").classList.add('w3-spin');
    document.getElementById("buttonIcon").classList.replace('fa-check','fa-spinner');

    $emailInput=document.getElementById("emailInput").value;
    if(ValidateEmail($emailInput))
    {
        //VALIDATION ON SERVER
        $captchaInput=document.getElementById("captchaInput").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            }
        };
        xhttp.open("POST", "validateInput.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("captchaInput="+$captchaInput);


        
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