<?php
require_once dirname(__FILE__) . '/../db/db_connection.php';
session_start();

$message = "";

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = new db_connection();
    $sql = "SELECT * FROM customer WHERE customer_email = '$email' LIMIT 1";
    $user = $db->db_fetch_one($sql);

    if ($user) {
        // verify hashed password
        if (password_verify($password, $user['customer_pass'])) {
            $_SESSION['user_id'] = $user['customer_id'];
            $_SESSION['user_name'] = $user['customer_name'];
            $_SESSION['user_role'] = $user['user_role'];

            header("Location: ../index.php");
            exit();
        } else {
            $message = "Invalid email or password.";
        }
    } else {
        $message = "No account found with that email.";
    }
}
?>
