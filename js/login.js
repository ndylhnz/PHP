document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("loginForm");
    if (!form) return;

    const username = document.getElementById("login-username");
    const password = document.getElementById("login-password");
    const status = document.getElementById("loginStatus");
    const button = form.querySelector('button[type="submit"]');
    const usernamePattern = /^[A-Za-z0-9]{3,20}$/;
    const passwordPattern = /^[A-Za-z0-9@$!%*?&._-]{5,32}$/;
    const correctUsername = "admin";
    const correctPassword = "12345";

    // In-memory only: reloading login.php resets the count, as requested.
    let failedAttempts = 0;
    let timer = null;
    let remaining = 0;

    function showFieldError(input, message) {
        let error = input.parentElement.querySelector(".client-field-error");
        if (!error) {
            error = document.createElement("span");
            error.className = "form-error client-field-error";
            input.insertAdjacentElement("afterend", error);
        }
        error.textContent = message;
        input.classList.toggle("error", Boolean(message));
        input.setAttribute("aria-invalid", message ? "true" : "false");
    }

    function validateUsername() {
        let msg = "";
        if (!username.value.trim()) msg = "Username is required.";
        else if (!usernamePattern.test(username.value.trim())) msg = "Username must be 3–20 letters or numbers.";
        showFieldError(username, msg);
        return !msg;
    }

    function validatePassword() {
        let msg = "";
        if (!password.value) msg = "Password is required.";
        else if (!passwordPattern.test(password.value)) msg = "Password must be 5–32 characters using letters, numbers, or @$!%*?&._-.";
        showFieldError(password, msg);
        return !msg;
    }

    function statusMessage(message, isError) {
        status.textContent = message;
        status.className = "status-message" + (message ? (isError ? " form-error" : " success-message") : "");
    }

    username.addEventListener("input", function () {
        validateUsername();
        statusMessage("", false);
    });
    password.addEventListener("input", function () {
        validatePassword();
        statusMessage("", false);
    });

    function beginLockout() {
        remaining = 30;
        button.disabled = true;
        username.disabled = true;
        password.disabled = true;
        button.textContent = "Locked (" + remaining + "s)";
        statusMessage("Too many incorrect login attempts. Please wait " + remaining + " seconds.", true);

        timer = window.setInterval(function () {
            remaining--;
            if (remaining <= 0) {
                window.clearInterval(timer);
                timer = null;
                failedAttempts = 0;
                button.disabled = false;
                username.disabled = false;
                password.disabled = false;
                button.textContent = "Login";
                statusMessage("", false);
                validateUsername();
                validatePassword();
            } else {
                button.textContent = "Locked (" + remaining + "s)";
                statusMessage("Too many incorrect login attempts. Please wait " + remaining + " seconds.", true);
            }
        }, 1000);
    }

    form.addEventListener("submit", function (event) {
        const usernameOkay = validateUsername();
        const passwordOkay = validatePassword();

        // Validation errors do not count as failed login attempts.
        if (!usernameOkay || !passwordOkay) {
            event.preventDefault();
            statusMessage("Please correct the highlighted fields.", true);
            return;
        }

        // Count only correctly formatted but incorrect static credentials.
        if (username.value.trim() !== correctUsername || password.value !== correctPassword) {
            event.preventDefault();
            failedAttempts++;
            if (failedAttempts >= 3) {
                beginLockout();
            } else {
                const left = 3 - failedAttempts;
                statusMessage("Invalid username or password. " + left + " attempt" + (left === 1 ? "" : "s") + " remaining.", true);
            }
        }
        // Correct credentials are submitted to login.php for server-side validation.
    });
});
