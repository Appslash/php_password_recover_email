function onPageLoad()
{
document.getElementById("popupMessage").style.display="none";
document.getElementById("emailInputError").style.display="none";
document.getElementById("captchaInputError").style.display="none";

}

function validateInput(p1, p2) 
{

    document.getElementById("buttonIcon").classList.add('w3-spin');
    document.getElementById("buttonIcon").classList.replace('fa-check','fa-spinner');
    
}