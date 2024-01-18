

function showPassword() {
    var password = document.querySelector("#password");
    if (password.type === "password") {
      password.type = "text";
    } else {
      password.type = "password";
    }
};