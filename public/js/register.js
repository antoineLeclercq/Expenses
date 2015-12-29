document.getElementById("sign-up-btn").addEventListener("click", function validateForm() {
    if (document.getElementsByTagName('email')[0] != document.getElementsByTagName('confirm-email')[0]) {
        alert("Email and confirmation email must be the same.");
        return false;
    }
    else if (document.getElementsByTagName('password')[0] != document.getElementsByTagName('confirm-password')[0]) {
        alert("password and confirmation password must be the same.");
        return false;
    }
});