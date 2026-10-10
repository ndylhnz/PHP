<?php
session_start();
$error = "";
$username = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = $_POST["password"] ?? "";
    $usernamePattern = '/^[A-Za-z0-9]{3,20}$/';
    $passwordPattern = '/^[A-Za-z0-9@$!%*?&._-]{5,32}$/';
    if ($username === "" || $password === "") {
        $error = "Username and password are required.";
    } elseif (!preg_match($usernamePattern, $username)) {
        $error = "Username must be 3–20 characters and contain only letters and numbers.";
    } elseif (!preg_match($passwordPattern, $password)) {
        $error = "Password must be 5–32 characters and use only supported characters.";
    } elseif ($username === "admin" && $password === "12345") {
        session_regenerate_id(true);
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Wuthering Waves login page with jQuery Validation">
    <title>Login | Wuthering Waves</title>
    <link rel="stylesheet" href="css1/activity1.css">
</head>
<body class="auth-page login-page">
    <main class="auth-shell">
        <section class="auth-visual" aria-label="Welcome panel">
            <div class="visual-overlay"></div>
            <div class="visual-copy">
                <p class="eyebrow">WELCOME BACK</p>
                <h1>Continue your journey.</h1>
                <p>Sign in to access your account and continue where you left off.</p>
            </div>
        </section>

        <section class="auth-panel">
            <div class="auth-card">
                <div class="brand">
                    <div class="brand-mark" aria-hidden="true">I</div>
                    <div>
                        <strong>IT314</strong>
                        <span>Student Portal</span>
                    </div>
                </div>

                <header class="form-header">
                    <p class="eyebrow">ACCOUNT ACCESS</p>
                    <h2>Welcome back</h2>
                    <p>Enter your details below to sign in.</p>
                </header>

                <form id="loginForm" method="post" action="login.php" novalidate>
                    <div class="form-group">
                        <label for="login-username">Username</label>
                        <input
                            type="text"
                            id="login-username"
                            name="username"
                            value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>"
                            minlength="3"
                            maxlength="20"
                            required
                            placeholder="Enter your username"
                            autocomplete="username"
                        >
                    </div>

                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input
                            type="password"
                            id="login-password"
                            name="password"
                            minlength="5"
                            maxlength="32"
                            required
                            placeholder="Enter your password"
                            autocomplete="current-password"
                        >
                    </div>

                    <div id="loginStatus" class="status-message<?php echo $error !== "" ? " form-error" : ""; ?>" role="alert" aria-live="polite"><?php
if ($error !== "") echo htmlspecialchars($error, ENT_QUOTES, "UTF-8");
?></div>

                    <label class="check-row">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>

                    <button type="submit" class="primary-button">Login</button>
                </form>

                <p class="switch-text">
                    Don't have an account?
                    <a href="register.php">Create an account</a>
                </p>
            </div>
        </section>
    </main>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="js/login.js"></script>
</body>
</html>
