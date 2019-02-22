<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
    header ('location: index.php');
    exit;
}

if (isset($_POST["submit"]) && $_POST["submit"] === "OK" && isset($_POST["name"]) && isset($_POST["price"]) && isset($_POST["img"])) {
    add_item($_POST["name"], $_POST["price"], $_POST["img"], $_POST["categories"]);
}
else {
    header ('location: manage_item_addpage.php');
    exit;
}
header ('location: manage_items.php');
