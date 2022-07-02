function validateUsername(e) {
    var username = document.getElementById("username");
    var usernameError = document.getElementById("errorUsername");

    var regex = /[!@#$%^&*(),.?":{} |<>]/g;

    if (regex.test(username.value) || username.value.length <= 6) {
        usernameError.style.color = "red";
        usernameError.innerHTML = "Username not valid.";
        return false;
    }

    usernameError.innerHTML = "Username valid.";
    usernameError.style.color = "green";
    return true;
}

function validatePassword() {
    var password = document.getElementById("password");
    var passwordError = document.getElementById("errorPassword");

    if (password.value.length <= 6) {
        passwordError.style.color = "red";
        passwordError.innerHTML = "Password must be longer than 6 characters.";
        return false;
    }

    passwordError.innerHTML = "Password valid.";
    passwordError.style.color = "green";
    return true;
}

function validateEmail() {
    var email = document.getElementById("email");
    var emailError = document.getElementById("errorEmail");

    if (!email.value.includes("@")) {
        emailError.style.color = "red";
        emailError.innerHTML = "Email not valid.";
        return false;
    }

    emailError.innerHTML = "Email valid.";
    emailError.style.color = "green";
    return true;
}

function validatePasswordConfirm() {
    var password = document.getElementById("password");
    var passwordConfirm = document.getElementById("password_confirm");
    var passwordErrorConfirm = document.getElementById("errorPasswordConfirm");

    if (password.value !== passwordConfirm.value) {
        passwordErrorConfirm.style.color = "red";
        passwordErrorConfirm.innerHTML = "Passwords don't match.";
        return false;
    }

    passwordErrorConfirm.innerHTML = "Passwords match.";
    passwordErrorConfirm.style.color = "green";
    return true;
}

function validateImage() {
    var image = document.getElementById("image").files[0];

    if (image && image.name.length > 0) {
        return true;
    }

    return false;
}

function enableButton(valid) {
    var button = document.getElementById("submit");

    button.disabled = !valid;
}

function validate() {
    var valid =
        validateUsername() &&
        validateEmail() &&
        validatePassword() &&
        validatePasswordConfirm() &&
        validateImage();

    enableButton(valid);
}

function setup() {
    var password = document.getElementById("password");
    var passwordConfirm = document.getElementById("password_confirm");
    var email = document.getElementById("email");
    var username = document.getElementById("username");
    var image = document.getElementById("image");

    username.oninput = validate;
    password.oninput = validate;
    email.oninput = validate;
    passwordConfirm.oninput = validate;
    image.onchange = validate;
}

setup();
