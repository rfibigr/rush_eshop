<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
    header ('location: index.php');
    exit;
}

if (!empty($_GET["user"]) && isset($_POST["submit"]) && $_POST["submit"] === "OK" && isset($_POST["name"]) && isset($_POST["first_name"]) && isset($_POST["last_name"]) && isset($_POST["role"]) && ($_POST["role"] === "admin" || $_POST["role"] === "user") && isset($_POST["address"]) && isset($_POST["phone"])) {
    update_user_data($_GET["user"], $_POST["name"], $_POST["first_name"], $_POST["last_name"], $_POST["role"], $_POST["address"], $_POST["phone"]);
    if (!empty($_POST["passwd"])) {
        update_user_password($_GET["user"], hash('sha256', $_POST["passwd"]));
    }
}
else {
    header ('location: manage_user_editpage.php?category=' . $_GET["user"]);
    exit;
}
header ('location: manage_users.php');
