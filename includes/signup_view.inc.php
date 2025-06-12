<?php

declare(strict_types=1);

function signup_inputs()
{
    //print the first name
    if (
        isset($_SESSION["signup_data"]["firstname"]) &&
        !isset($_SESSION["errors_signup"]["firstname_invalid"])
    ) {
        echo '<div class="row">
                    <div class="informer">
                        <span>Име</span>
                    </div>
                    <div class="box">
                        <input name="firstname" type="text" class="register-name
                        value=' . $_SESSION["signup_data"]["firstname"] . '" />
                    </div>
                </div>';
    } else {
        echo '<div class="row">
                    <div class="informer">
                        <span>Име</span>
                    </div>
                    <div class="box">
                        <input name="firstname" type="text" class="register-name" />
                    </div>
                </div>';
    }

    //print the last name

    if (
        isset($_SESSION["signup_data"]["lastname"]) &&
        !isset($_SESSION["errors_signup"]["lastname_invalid"])
    ) {
        echo '<div class="row">
                    <div class="informer">
                        <span>Име</span>
                    </div>
                    <div class="box">
                        <input name="lastname" type="text" class="register-name
                        value=' . $_SESSION["signup_data"]["lastname"] . '" />
                    </div>
                </div>';
    } else {
        echo '<div class="row">
                    <div class="informer">
                        <span>Име</span>
                    </div>
                    <div class="box">
                        <input name="lastname" type="text" class="register-name" />
                    </div>
                </div>';
    }


    //print the password and re-password

    echo '
        <div class="row">
            <div class="informer">
                <span>Парола</span>
            </div>
            <div class="box">
                <input name="pwd" type="password" class="register-password" />
            </div>
        </div>';

    echo '
        <div class="row">
            <div class="informer">
                <span>Повторете паролата</span>
            </div>
            <div class="box">
                <input name="pwd_repeat" type="password" class="register-password" />
            </div>
        </div>';


    //print the email
    if (
        isset($_SESSION["signup_data"]["email"]) &&
        !isset($_SESSION["errors_signup"]["invalid_email"]) &&
        !isset($_SESSION["errors_signup"]["email_registered"])
    ) {
        echo '  
            <div class="row">
                <div class="informer">
                    <span>Имейл</span>
                </div>
                <div class="box">
                    <input name="email" type="email" class="register-email
                    value=' . $_SESSION["signup_data"]["email"] . '" />
                </div>
            </div>';
    } else {
        echo '                
            <div class="row">
                <div class="informer">
                    <span>Имейл</span>
                </div>
                <div class="box">
                    <input name="email" type="email" class="register-email" />
                </div>
            </div>';
    }

    //print the city

    if (
        isset($_SESSION["signup_data"]["city"]) &&
        !isset($_SESSION["errors_signup"]["invalid_city"])
    ) {
        echo '
            <div class="row">
                <div class="informer">
                    <span>Град</span>
                </div>
                <div class="box">
                    <input name="city" type="text" class="register-town
                    value=' . $_SESSION["signup_data"]["city"] . '" />
                </div>
            </div>';
    } else {
        echo '
            <div class="row">
                <div class="informer">
                    <span>Град</span>
                </div>
                <div class="box">
                    <input name="city" type="text" class="register-town" />
                </div>
            </div>';
    }

    //print the home address

    if (
        isset($_SESSION["signup_data"]["home_address"]) &&
        !isset($_SESSION["errors_signup"]["invalid_home_address"])
    ) {
        echo '
            <div class="row">
                <div class="informer">
                    <span>Адрес</span>
                </div>
                <div class="box">
                    <input name="home_address" type="text" class="register-address
                    value=' . $_SESSION["signup_data"]["home_address"] . '" />
                </div>
            </div>';
    } else {
        echo '
            <div class="row">
                <div class="informer">
                    <span>Адрес</span>
                </div>
                <div class="box">
                    <input name="home_address" type="text" class="register-address" />
                </div>
            </div>';
    }

    //print the phone

    if (
        isset($_SESSION["signup_data"]["phone"]) &&
        !isset($_SESSION["errors_signup"]["invalid_phone"]) &&
        !isset($_SESSION["errors_signup"]["phone_registered"])
    ) {
        echo '
            <div class="row">
                <div class="informer">
                    <span>Телефон</span>
                </div>
                <div class="box">
                    <input name="phone" type="tel" class="register-phone-number
                    value=' . $_SESSION["signup_data"]["phone"] . '" />
                </div>
            </div>';
    } else {
        echo '
            <div class="row">
                <div class="informer">
                    <span>Телефон</span>
                </div>
                <div class="box">
                    <input name="phone" type="tel" class="register-phone-number" />
                </div>
            </div>';
    }
}

function check_signup_errors()
{
    if (isset($_SESSION["errors_signup"])) {
        $errors = $_SESSION["errors_signup"];

        echo '<br>';

        foreach ($errors as $error) {
            echo '<p>' . $error . '</p>';
        }

        unset($_SESSION["errors_signup"]);
    } else if (isset($_GET["signup"])  && $_GET["signup"] === "success") {
        echo "<br>";
        echo "<p>Signup successful!</p>";
    }
}
