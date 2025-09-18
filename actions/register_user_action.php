<?php

header('Content-Type: application/json');

session_start();

$response = array();

// TODO: Check if the user is already logged in and redirect to the dashboard
if (isset($_SESSION['user_id'])) {
    $response['status'] = 'error';
    $response['message'] = 'You are already logged in';
    echo json_encode($response);
    exit();
}

require_once '../controllers/user_controller.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$country = trim($_POST['country'] ?? '');
$city     = trim($_POST['city'] ?? '');
$phone_number = $_POST['phone_number'];
$role     = intval($_POST['role'] ?? 2);

$user_id = register_user_ctr($name, $email, $password, $country, $city, $phone_number, $role);

if ($user_id) {
    $response['status'] = 'success';
    $response['message'] = 'Registered successfully';
    $response['user_id'] = $user_id;

} else {
    $response['status'] = 'error';
    $response['message'] = $result
}

echo json_encode($response);