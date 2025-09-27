<?php
session_start();

// for header redirection
ob_start();

// function to check if user is logged in (redirect if not)
function check_login()
{
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login/login.php");
        exit();
    }
}

// helper: returns true/false
function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

// function to get user ID
function get_user_id()
{
    return $_SESSION['user_id'] ?? null;
}

// function to get user role (admin, customer, etc)
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
