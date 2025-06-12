<?php

declare(strict_types=1);

function get_firstname(object $pdo, string $firstname)
{
    $query = "SELECT firstname FROM users WHERE firstname = :firstname;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_lastname(object $pdo, string $lastname)
{
    $query = "SELECT lastname FROM users WHERE lastname = :lastname;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email)
{
    $query = "SELECT email FROM users WHERE email = :email;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":email", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_city(object $pdo, string $city)
{
    $query = "SELECT city FROM users WHERE city = :city;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":city", $city);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_home_address(object $pdo, string $home_address)
{
    $query = "SELECT home_address FROM users WHERE home_address = :home_address;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":home_address", $home_address);
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
    $query = "INSERT INTO users(:firstname, :lastname, :pwd, :email, :city, :home_address, :phone);";
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
