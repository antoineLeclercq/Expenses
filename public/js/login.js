document.getElementById("login-btn").addEventListener("click", function validateForm() {
    if ( getElementsByTagName("password")[0] === "" || getElementsByTagName("email")[0] === "" ) {
        alert("You must enter your email and password");
    }
});