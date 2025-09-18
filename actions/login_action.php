<?php
header('Content-Type: application/json');
session_start();

require_once '../controllers/user_controller.php';

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

$result = login_user_ctr($email, $password);

$response = [];

if ($result) {
    
    $_SESSION['user_id']   = $result['customer_id'];
    $_SESSION['user_name'] = $result['customer_name'];
    $_SESSION['user_role'] = $result['user_role'];

    $response['status']  = 'success';
    $response['message'] = 'Login successful';
} else {
    $response['status']  = 'error';
    $response['message'] = 'Invalid email or password';
}

echo json_encode($response);
