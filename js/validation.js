function validateForm() {
    // Reset error messages
    resetErrors();

    // Get form input values
    var name = document.getElementById("name").value;
    var dob = document.getElementById("dob").value;
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var phone = document.getElementById("phone").value;
    var password = document.getElementById("password").value;
    var passwordConfirm = document.getElementById("password-confirm").value;

    var valid = true;

    // Validate Name
    if (name.trim() === "") {
        setError("name-error", "Name is required");
        valid = false;
    }

    // Validate Date of Birth
    if (dob.trim() === "") {
        setError("dob-error", "Date of Birth is required");
        valid = false;
    }

    // Validate Username
    if (username.trim() === "") {
        setError("username-error", "Username is required");
        valid = false;
    }

    // Validate Email
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!email.match(emailPattern)) {
        setError("email-error", "Invalid email format");
        valid = false;
    }

    // Validate Phone
    if (phone.trim() === "") {
        setError("phone-error", "Phone number is required");
        valid = false;
    }
	
	if (phone.length != 10) {
        setError("phone-error", "Phone must be 10 digits");
        valid = false;
    }

    // Validate Password
    if (password.length < 6) {
        setError("password-error", "Password must be at least 6 characters");
        valid = false;
    }

    // Validate Password Confirmation
    if (password !== passwordConfirm) {
        setError("password-confirm-error", "Passwords do not match");
        valid = false;
    }

    return valid;
}

function setError(id, errorMessage) {
    var element = document.getElementById(id);
    element.textContent = errorMessage;
    element.style.color = "red";
}

function resetErrors() {
    var errorElements = document.getElementsByClassName("error");
    for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].textContent = "";
    }
}
