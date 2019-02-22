<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
    header ('location: index.php');
    exit;
}

if (isset($_POST["submit"]) && $_POST["submit"] === "OK" && isset($_POST["name"]) && isset($_POST["passwd"]) && isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["role"]) && ($_POST["role"] === "admin" || $_POST["role"] === "user") && isset($_POST["address"]) && isset($_POST["phone"])) {
    add_user($_POST["name"], hash('sha256', $_POST["passwd"]), $_POST["first_name"], $_POST["last_name"], $_POST["role"], $_POST["address"], $_POST["phone"]);
}
else {
    header ('location: manage_user_addpage.php');
    exit;
}
header ('location: manage_users.php');
