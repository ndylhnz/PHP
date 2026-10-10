document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registerForm");
    if (!form) return;

    const fields = {
        full_name: document.getElementById("register-name"),
        email: document.getElementById("register-email"),
        username: document.getElementById("register-username"),
        password: document.getElementById("register-password"),
        confirm_password: document.getElementById("confirm-password")
    };
    const namePattern = /^[\p{L}][\p{L} .'-]{1,79}$/u;
    const usernamePattern = /^[A-Za-z0-9]{3,20}$/;
    const passwordPattern = /^[A-Za-z0-9@$!%*?&._-]{5,32}$/;

    function fieldError(input, message) {
        let error = input.parentElement.querySelector(".client-field-error");
        if (!error) {
            error = document.createElement("span");
            error.className = "form-error client-field-error";
            input.insertAdjacentElement("afterend", error);
        }
        error.textContent = message;
        input.classList.toggle("error", Boolean(message));
        input.setAttribute("aria-invalid", message ? "true" : "false");
        return !message;
    }

    function check(name) {
        const input = fields[name];
        const value = input.value;
        let message = "";
        if (name === "full_name") {
            if (!value.trim()) message = "Full name is required.";
            else if (!namePattern.test(value.trim())) message = "Use 2–80 letters, spaces, apostrophes, periods, or hyphens.";
        } else if (name === "email") {
            if (!value.trim()) message = "Email address is required.";
            else if (value.length > 254 || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) message = "Enter a valid email address (maximum 254 characters).";
        } else if (name === "username") {
            if (!value.trim()) message = "Username is required.";
            else if (!usernamePattern.test(value.trim())) message = "Username must be 3–20 letters or numbers.";
        } else if (name === "password") {
            if (!value) message = "Password is required.";
            else if (!passwordPattern.test(value)) message = "Password must be 5–32 characters using letters, numbers, or @$!%*?&._-.";
        } else if (name === "confirm_password") {
            if (!value) message = "Please confirm your password.";
            else if (value !== fields.password.value) message = "Passwords do not match.";
        }
        return fieldError(input, message);
    }

    Object.keys(fields).forEach(function (name) {
        fields[name].addEventListener("input", function () {
            check(name);
            if (name === "password" && fields.confirm_password.value) check("confirm_password");
        });
        fields[name].addEventListener("blur", function () { check(name); });
    });

    form.addEventListener("submit", function (event) {
        let valid = true;
        Object.keys(fields).forEach(function (name) {
            if (!check(name)) valid = false;
        });
        if (!valid) {
            event.preventDefault();
            const status = document.getElementById("registerStatus");
            status.textContent = "Please correct the highlighted fields.";
            status.className = "status-message form-error";
        }
        // If valid, let register.php perform the authoritative PHP validation.
    });
});
