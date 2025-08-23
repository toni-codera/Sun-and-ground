<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/loginPage.css">
    <link rel="stylesheet" href="styles/main.css">
    <title>Земя и слънце</title>
</head>
<body>
    <header></header>
    <nav></nav>
    <main>
        <form action="includes/login.inc.php" method="post">
            <div>
                <div class="welcome-container">
                    <h1 class="welcome">Добре дошли</h1>
                </div>
                <div class="text-container">
                    <span class="text"
                    >Влезте в акаунта си за бързо и сигурно пазаруване</span
                    >
                </div>
                <div class="email-container">
                    <input name="email" type="text" class="email" placeholder="Имейл" />
                </div>
                <div class="password-container">
                    <input name="pwd" type="password" class="password" placeholder="Парола" />
                </div>
                <div class="additional-functions">
                        <div class="remember-container">
                        <input type="checkbox" class="remember-checkbox" />
                        <span class="remember-text">Запомни ме</span>
                        </div>
                        <div class="forgotten-password-container">
                        <a>
                            <span class="forgotten-password-text">Забравена парола</span>
                        </a>
                        </div>
                </div>
                <div class="login-container">
                    <button type="submit" class="login">Влез</button>
                </div>
            </div>
            <div>
                <div class="account-text-container">
                    <h1 class="account-text">Още нямате акаунт?</h1>
                </div>
                <div class="register-text-container">
                    <span class="register-button">Регистрирай се сега! </span>
                </div>
                <div class="register-container">
                    <a class="register" href="registration.php">Регистрация</a>
                </div>
            </div>
            <div class="login-feedback"></div>
        </form>
    </main>
    <footer></footer>
    <script src="scripts/loadBookends.js"></script>
</body>
</html>