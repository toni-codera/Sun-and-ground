<?php
require_once 'includes/config_session.inc.php';
require_once 'includes/signup_view.inc.php';
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
    <link rel="icon" type="image/png" href="images/logos/sun-and-ground.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <?php require_once 'bookends/header.php'; ?>
    <?php require_once 'bookends/nav.php'; ?>
    <section class="register-section">
        <?php
        check_signup_errors();
        ?>
        <div class="register-text">
            <h2>Регистрация</h2>
        </div>
        <hr />
        <div class="form-container">
            <form action="includes/signup.inc.php" method="post" class="register-form">
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
    <?php require_once '/Sun_and_ground/bookends/footer.php'; ?>
    <script src="/Sun_and_ground/scripts/loadBookends.js"></script>
</body>

</html>