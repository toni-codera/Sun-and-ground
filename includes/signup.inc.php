<?php
//check if we got here legitimately
//by signing up using the form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $pwd = $_POST["pwd"];
    $pwd_repeat = $_POST["pwd_repeat"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $home_address = $_POST["home_address"];
    $phone = $_POST["phone"];

    try {
        require_once 'dbh.inc.php';
        require_once 'signup_model.inc.php';
        //require_once 'signup_view.inc.php';
        require_once 'signup_contr.inc.php';

        $errors = [];
        if (is_input_empty($firstname, $lastname, $pwd, $pwd_repeat, $email, $city, $home_address, $phone)) {
            $errors["empty_input"] = "Попълнете всички полета!";
        }
        if (is_firstname_invalid($firstname)) {
            $errors["firstname_invalid"] = "Неприемливо първо име!";
        }
        if (is_lastname_invalid($lastname)) {
            $errors["lastname_invalid"] = "Неприемливо фамилно име!";
        }
        if (is_password_weak($pwd)) {
            $errors["weak_password"] = "Слаба парола!";
        }
        if (is_password_mismatch($pwd, $pwd_repeat)) {
            $errors["password_mismatch"] = "Паролите не съвпадат!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Неправилен имейл!";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_registered"] = "Имейла вече е използван!";
        }
        if (is_city_invalid($city)) {
            $errors["invalid_city"] = "Невалиден град!";
        }
        if (is_home_address_invalid($home_address)) {
            $errors["invalid_home_address"] = "Невалиден адрес!";
        }
        if (is_phone_invalid($phone)) {
            $errors["invalid_phone"] = "Невалиден телефонен номер!";
        }

        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "firstname" => $firstname,
                "lastname" => $lastname,
                "email" => $email,
                "city" => $city,
                "home_address" => $home_address,
                "phone" => $phone
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../registration.php");
            die();
        }


        create_user($pdo, $firstname, $lastname, $pwd, $email, $city, $home_address, $phone);

        header("Location: ../index.php?signup=success");
        $pdo = null;
        $stmt = null;
    } catch (PDOException $e) {
        die("Query failed! " . $e->getMessage());
    }
} else {
    header("Location: ../registration.php");
    die();
}
