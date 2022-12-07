$(document).ready(function () {
    document.getElementById("heart").onclick = function () {
        document.querySelector(".fa-gratipay").style.color = "#E74C3C";
    };
});

let password = document.getElementById("password")
    , confirm_password = document.getElementById("confirm_password");

function validatePassword(){
    if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;