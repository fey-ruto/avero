<?php
require_once dirname(__FILE__) . '/../db/db_connection.php';
session_start();

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $country  = $_POST['country'];
    $city     = $_POST['city'];
    $phone    = $_POST['phone_number'];
    $role     = $_POST['role']; // 1 = Admin, 2 = Customer

    $hashed_pass = password_hash($password, PASSWORD_DEFAULT);

    $db = new db_connection();

    // check if email already exists
    $check_sql = "SELECT * FROM customer WHERE customer_email = '$email' LIMIT 1";
    $existing = $db->db_fetch_one($check_sql);

    if ($existing) {
        $message = "Email already registered.";
    } else {
        $sql = "INSERT INTO customer (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, user_role) 
                VALUES ('$name', '$email', '$hashed_pass', '$country', '$city', '$phone', '$role')";

        if ($db->db_write_query($sql)) {
            $message = "Registration successful. Please <a href='login.php'>login</a>.";
        } else {
            $message = "Registration failed. Try again.";
        }
    }
}
?>
