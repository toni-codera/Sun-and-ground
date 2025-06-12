<?php
require_once 'includes/signup_view.inc.php';
require_once 'includes/config_session.inc.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Земя и слънце</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="styles/registration.css" />
    <link rel="stylesheet" href="styles/main.css" />
    <link rel="stylesheet" href="styles/login.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <aside class="js-login-form"></aside>
    <header></header>
    <nav></nav>
    <section class="register-section">
        <div class="register-text">
            <h2>Регистрация</h2>
        </div>
        <hr />
        <div class="form-container">
            <form action="includes/login.inc.php" method="post" class="register-form">
                <!--<div class="row">
                    <div class="informer">
                        <span>Име</span>
                    </div>
                    <div class="box">
                        <input name="firstname" type="text" class="register-name" />
                    </div>
                </div>
                <div class="row">
                    <div class="informer">
                        <span>Фамилия</span>
                    </div>
                    <div class="box">
                        <input name="lastname" type="text" class="register-family-name" />
                    </div>
                </div>
                <div class="row">
                    <div class="informer">
                        <span>Имейл</span>
                    </div>
                    <div class="box">
                        <input name="email" type="email" class="register-email" />
                    </div>
                </div>
                <div class="row">
                    <div class="informer">
                        <span>Парола</span>
                    </div>
                    <div class="box">
                        <input name="pwd" type="password" class="register-password" />
                    </div>
                </div>
                <div class="row">
                    <div class="informer">
                        <span>Повторете паролата</span>
                    </div>
                    <div class="box">
                        <input name="pwd_repeat" type="password" class="register-password" />
                    </div>
                </div>
                <div class="row">
                    <div class="informer">
                        <span>Град</span>
                    </div>
                    <div class="box">
                        <input name="city" type="text" class="register-town" />
                    </div>
                </div>
                <div class="row">
                    <div class="informer">
                        <span>Адрес</span>
                    </div>
                    <div class="box">
                        <input name="home_address" type="text" class="register-address" />
                    </div>
                </div>
                <div class="row">
                    <div class="informer">
                        <span>Телефон</span>
                    </div>
                    <div class="box">
                        <input name="phone" type="tel" class="register-phone-number" />
                    </div>
                </div>-->
                <?php
                signup_inputs();
                ?>
                <div class="terms-container"></div>
                <div class="buttons-box">
                    <div class="reset-button-box">
                        <input type="reset" value="Изчисти" class="reset-button" />
                    </div>
                    <div class="reg-button-box">
                        <input type="submit" value="Регистрация" class="register-form-button" />
                    </div>
                </div>
            </form>
            <?php
            check_signup_errors();
            ?>
        </div>
    </section>
    <footer></footer>
    <script src="scripts/loadBookends.js"></script>
</body>

</html>