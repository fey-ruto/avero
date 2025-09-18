// Settings/core.php
<?php
session_start();


//for header redirection
ob_start();

//funtion to check for login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login/login.php");
    exit;
}


//function to get user ID
function get_user_id()
{
    return $_SESSION['user_id'] ?? null;
}

//function to check for role (admin, customer, etc)
function get_user_role()
{
    return $_SESSION['user_role'] ?? null;
}

function is_admin()
{
    return (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1);
}

function is_customer()
{
    return (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 2);
}

?>