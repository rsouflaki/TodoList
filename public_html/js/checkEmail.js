function checkEmail()
{
    var email = document.forms[0].elements["email"].value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {   
            var response = "Cannot confirm availability of username";
            if (xmlhttp.responseText == 0) {
                response = "Username is not available";
            } else if (xmlhttp.responseText == 1){
                response = "Username is available";
            }
            document.getElementById("emailCheck").innerHTML = response;
        }
    }
    xmlhttp.open("POST", "checkEmail.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("email=" + email);
    xmlhttp.send();
}