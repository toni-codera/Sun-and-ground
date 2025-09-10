<?php
//check if the user got here legitimately
//by filling the login form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];

    try {
        require_once 'dbh.inc.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        //ERROR HANDLERS
        $errors = [];
        //if the inputs are empty
        if (is_input_empty($email, $pwd)) {
            $errors["empty_input"] = "Fill in all fields";
        }

        $result = get_user($pdo, $email);
        //if the email is wrong/unexisting
        if (is_email_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login information!";
        }

        //if the email is correct but the password is wrong
        if (
            !is_email_wrong($result) &&
            is_password_wrong($pwd, $result["pwd"])
        ) {
            $errors["login_incorrect"] = "Incorrect password!";
        }


        //grabs our session config file
        require_once 'config_session.inc.php';

        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("Location: ../login.php");
            die();
        }
        //generate new session id
        //we can append the user's id with the session id
        //this is useful to show specific info for the logged in user
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["email"] = htmlspecialchars($result["email"]);
        $_SESSION["firstname"] = htmlspecialchars($result["firstname"]);
        $_SESSION["lastname"] = htmlspecialchars($result["lastname"]);
        $_SESSION["city"] = htmlspecialchars($result["city"]);
        $_SESSION["home_address"] = htmlspecialchars($result["home_address"]);
        $_SESSION["phone"] = htmlspecialchars($result["phone"]);
        $_SESSION["is_admin"] = $result["is_admin"];

        //reset the timer for when we have to regenerate the session id
        $_SESSION["last_regeneration"] = time();

        header("Location: ../index.php?login=success");
        $pdo = null;
        $statement = null;
        die();
    } catch (PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }
} else //if the user got in illegitimately
{
    header("Location: ../index.php");
    die();
}
