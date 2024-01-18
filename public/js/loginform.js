var regLink = document.querySelector('#reg-link');
var logLink = document.querySelector('#login-link');
var signLogo = document.querySelector('#sign-logo');
var signSlogan = document.querySelector('#sign-slogan');
var logoSlogan = document.querySelector(".logo-slogan");

regLink.addEventListener('click', function () {
    var regForm = document.querySelector(".register");
    var loginForm = document.querySelector(".login");
    regForm.classList.remove("d-none");
    loginForm.classList.add("d-none");
});

logLink.addEventListener('click', function () {
    var regForm = document.querySelector(".register");
    var loginForm = document.querySelector(".login");
    loginForm.classList.remove("d-none");
    regForm.classList.add("d-none");
});

function showPassword() {
    var password = document.querySelector("#password");
    if (password.type === "password") {
      password.type = "text";
    } else {
      password.type = "password";
    }
};
  