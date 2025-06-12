<?php

declare(strict_types=1);

function get_email(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_phone(object $pdo, string $phone)
{
    $query = "SELECT phone FROM users WHERE phone = :phone";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":phone", $phone);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(
    object $pdo,
    string $firstname,
    string $lastname,
    string $pwd,
    string $email,
    string $city,
    string $home_address,
    string $phone
) {
    $query = "INSERT INTO users(firstname, lastname, pwd, email, city, home_address, phone)
    VALUES(:firstname, :lastname, :pwd, :email, :city, :home_address, :phone);";
    $stmt = $pdo->prepare($query);

    $options = [
        'cost' => 12
    ];

    $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":pwd", $hashed_pwd);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":city", $city);
    $stmt->bindParam(":home_address", $home_address);
    $stmt->bindParam(":phone", $phone);

    $stmt->execute();
}
