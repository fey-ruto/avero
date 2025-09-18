<?php

require_once '../classes/user_class.php';


function register_user_ctr($name, $email, $password, $country, $city, $phone_number, $role)
{

    $user = new User();
    if (!$name || !$email || !$password || !$country || !$city || !$phone_number) {
        return "Please fill in all fields."; 

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return "Invalid email format."; 
    }

    if (!preg_match('/^[0-9+\- ]{7,20}$/', $phone_number)) {
        return "Invalid phone number."; 
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $user_id = $user->createUser($name, $email, $hashed_password, $phone_number, $role, $country, $city);

    if ($user_id) {
        return $user_id;
    }
    return "Failed to register. Email may already exist or data invalid.";

}

function get_user_by_email_ctr($email)
{
    $user = new User();
    return $user->getUserByEmail($email);
}
function login_user_ctr($email, $password)
{
    $user = new User();
    $found_user = $user->getUserByEmail($email);

    if ($found_user && password_verify($password, $found_user['customer_pass'])) {
        return $found_user; 
    }

    return false; 
}