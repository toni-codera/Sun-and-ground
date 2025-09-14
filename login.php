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
    <link rel="icon" type="image/png" href="images/logos/sun-and-ground.png">
    <title>Земя и слънце</title>
</head>
<body>
    <?php require_once 'bookends/header.php'; ?>
    <?php require_once 'bookends/nav.php'; ?>
    <main>
        <form action="includes/login.inc.php" method="post">
            <div>
                <div class="welcome-container">
                    <h1 class="welcome">Добре дошли</h1>
                </div>
                <div class="login-feedback">
                <?php check_login_errors(); ?>
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
    <?php require_once 'bookends/footer.php'; ?>
    <script src="/Sun_and_ground/scripts/navigate.js"></script>
</body>
</html>