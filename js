document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("registerForm").addEventListener("submit", function (event) {
        let errors = [];

        let fullName = document.getElementById("full_name").value.trim();
        let email = document.getElementById("email").value.trim();
        let password = document.getElementById("password").value;
        let confirmPassword = document.getElementById("confirm_password").value;

        // Validation rules
        if (fullName.length < 3) {
            errors.push("Full name must be at least 3 characters.");
        }
        if (!email.includes("@") || !email.includes(".")) {
            errors.push("Enter a valid email address.");
        }
        if (password.length < 6) {
            errors.push("Password must be at least 6 characters.");
        }
        if (password !== confirmPassword) {
            errors.push("Passwords do not match.");
        }

        // Display popup if there are errors
        if (errors.length > 0) {
            event.preventDefault();
            showErrorPopup(errors);
        }
    });
});

// Show error popup
function showErrorPopup(errors) {
    let errorList = document.getElementById("errorList");
    errorList.innerHTML = "";
    errors.forEach(error => {
        let li = document.createElement("li");
        li.textContent = error;
        errorList.appendChild(li);
    });
    document.getElementById("errorPopup").style.display = "block";
}

// Close error popup
function closePopup() {
    document.getElementById("errorPopup").style.display = "none";
}


