<?php

declare(strict_types=1);

function is_input_empty(string $firstname, string $lastname, string $pwd, string $pwd_repeat, string $email, string $city, string $home_address, string $phone)
{
    if (empty($firstname) || empty($lastname) || empty($pwd) || empty($pwd_repeat) || empty($email) || empty($city) || empty($home_address) || empty($phone)) {
        return true;
    } else {
        return false;
    }
}

function is_firstname_invalid(string $firstname)
{
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}' ]{2,50}$/u", $firstname)) {
        return true;
    } else {
        return false;
    }
}

function is_lastname_invalid(string $lastname)
{
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}' ]{2,50}$/u", $lastname)) {
        return true;
    } else {
        return false;
    }
}

function is_password_weak(string $pwd)
{
    if (
        strlen($pwd) < 8 ||
        !preg_match('/[A-Z]/', $pwd) ||
        !preg_match('/[a-z]/', $pwd) ||
        !preg_match('/[0-9]/', $pwd) ||
        !preg_match('/[^A-Za-z0-9]/', $pwd)
    ) {
        return true;
    }
    return false;
}

function is_password_mismatch(string $pwd, string $pwd_repeat)
{
    if ($pwd !== $pwd_repeat) {
        return true;
    }
    return false;
}

function is_email_invalid(string $email)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}

function is_email_registered(object $pdo, string $email)
{
    if (get_email($pdo, $email)) {
        return true;
    } else {
        return false;
    }
}

function is_city_invalid(string $city)
{
    if (!preg_match("/^[a-zA-Z\p{Cyrillic}' ]{2,50}$/u", $city)) {
        return true;
    }
    return false;
}

function is_home_address_invalid(string $home_address)
{
    if (strlen($home_address) < 5) {
        return true;
    }
    return false;
}

function is_phone_invalid(string $phone)
{
    if (!preg_match("/^[\d\s\-\+]{7,15}$/", $phone)) {
        return true;
    }
    return false;
}

function create_user(
    object $pdo,
    string $firstname,
    string $lastname,
    string $pwd,
    string $email,
    string $city,
    string $home_address,
    string $phone
) {
    set_user($pdo, $firstname, $lastname, $pwd, $email, $city, $home_address, $phone);
}
