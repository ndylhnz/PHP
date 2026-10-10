<?php
session_start();
$errors = [];
$success = "";
$values = ["full_name" => "", "email" => "", "username" => ""];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $values["full_name"] = trim($_POST["full_name"] ?? "");
    $values["email"] = trim($_POST["email"] ?? "");
    $values["username"] = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirmPassword = $_POST["confirm_password"] ?? "";

    if ($values["full_name"] === "") {
        $errors["full_name"] = "Full name is required.";
    } elseif (!preg_match("/^[\\p{L}][\\p{L} .'-]{1,79}$/u", $values["full_name"])) {
        $errors["full_name"] = "Use 2–80 letters, spaces, apostrophes, periods, or hyphens for your name.";
    }
    if ($values["email"] === "") {
        $errors["email"] = "Email address is required.";
    } elseif (strlen($values["email"]) > 254 || !filter_var($values["email"], FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Enter a valid email address (maximum 254 characters).";
    }
    if ($values["username"] === "") {
        $errors["username"] = "Username is required.";
    } elseif (!preg_match('/^[A-Za-z0-9]{3,20}$/', $values["username"])) {
        $errors["username"] = "Username must be 3–20 characters and contain only letters and numbers.";
    }
    if ($password === "") {
        $errors["password"] = "Password is required.";
    } elseif (!preg_match('/^[A-Za-z0-9@$!%*?&._-]{5,32}$/', $password)) {
        $errors["password"] = "Password must be 5–32 characters and use only supported characters.";
    }
    if ($confirmPassword === "") {
        $errors["confirm_password"] = "Please confirm your password.";
    } elseif ($confirmPassword !== $password) {
        $errors["confirm_password"] = "Passwords do not match.";
    }
    if (!$errors) {
        $success = "Registration form validated successfully. This demo does not save accounts because no database is configured.";
        $values = ["full_name" => "", "email" => "", "username" => ""];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wuthering Waves registration page with jQuery Validation">
    <title>Register | Wuthering Waves</title>
    <link rel="stylesheet" href="css1/activity1.css">
</head>
<body class="auth-page register-page">
    <main class="auth-shell">
        <section class="auth-visual" aria-label="Welcome panel">
            <div class="visual-overlay"></div>
            <div class="visual-copy">
                <p class="eyebrow">CREATE YOUR ACCOUNT</p>
                <h1>Start something new.</h1>
                <p>Register your account and join the IT314 student portal.</p>
            </div>
        </section>

        <section class="auth-panel">
            <div class="auth-card register-card">
                <div class="brand">
                    <div class="brand-mark" aria-hidden="true">I</div>
                    <div>
                        <strong>IT314</strong>
                        <span>Student Portal</span>
                    </div>
                </div>

                <header class="form-header">
                    <p class="eyebrow">NEW ACCOUNT</p>
                    <h2>Create account</h2>
                    <p>Fill in the information below to get started.</p>
                </header>

                <form id="registerForm" method="post" action="register.php" novalidate>
                    <div class="form-group">
                        <label for="register-name">Full name</label>
                        <input
                            type="text"
                            id="register-name"
                            name="full_name"
                            maxlength="80"
                            placeholder="Juan Dela Cruz"
                            autocomplete="name"
                            required
                         value="<?php echo htmlspecialchars($values["full_name"], ENT_QUOTES, 'UTF-8'); ?>
                        <?php if (isset($errors["full_name"])): ?><span class="form-error"><?php echo htmlspecialchars($errors["full_name"], ENT_QUOTES, "UTF-8"); ?></span><?php endif; ?>">
                    </div>

                    <div class="form-group">
                        <label for="register-email">Email address</label>
                        <input
                            type="email"
                            id="register-email"
                            name="email"
                            maxlength="254"
                            placeholder="you@example.com"
                            autocomplete="email"
                            required
                         value="<?php echo htmlspecialchars($values["email"], ENT_QUOTES, 'UTF-8'); ?>
                        <?php if (isset($errors["email"])): ?><span class="form-error"><?php echo htmlspecialchars($errors["email"], ENT_QUOTES, "UTF-8"); ?></span><?php endif; ?>">
                    </div>

                    <div class="form-group">
                        <label for="register-username">Username</label>
                        <input
                            type="text"
                            id="register-username"
                            name="username"
                            minlength="3"
                            maxlength="20"
                            placeholder="Choose a username"
                            autocomplete="username"
                            required
                         value="<?php echo htmlspecialchars($values["username"], ENT_QUOTES, 'UTF-8'); ?>
                        <?php if (isset($errors["username"])): ?><span class="form-error"><?php echo htmlspecialchars($errors["username"], ENT_QUOTES, "UTF-8"); ?></span><?php endif; ?>">
                    </div>

                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <input
                            type="password"
                            id="register-password"
                            name="password"
                            minlength="5"
                            maxlength="32"
                            placeholder="Create a password"
                            autocomplete="new-password"
                            required
                        >
                        <?php if (isset($errors["password"])): ?><span class="form-error"><?php echo htmlspecialchars($errors["password"], ENT_QUOTES, "UTF-8"); ?></span><?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="confirm-password">Confirm password</label>
                        <input
                            type="password"
                            id="confirm-password"
                            name="confirm_password"
                            minlength="5"
                            maxlength="32"
                            placeholder="Repeat your password"
                            autocomplete="new-password"
                            required
                        >
                        <?php if (isset($errors["confirm_password"])): ?><span class="form-error"><?php echo htmlspecialchars($errors["confirm_password"], ENT_QUOTES, "UTF-8"); ?></span><?php endif; ?>
                    </div>

                    <div id="registerStatus" class="status-message<?php echo $success !== "" ? " success-message" : ""; ?>" role="status" aria-live="polite"><?php
if ($success !== "") echo htmlspecialchars($success, ENT_QUOTES, "UTF-8");
?></div>

                    <button type="submit" class="primary-button">Register</button>
                </form>

                <p class="switch-text">
                    Already have an account?
                    <a href="login.php">Login here</a>
                </p>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/register.js"></script>
</body>
</html>
