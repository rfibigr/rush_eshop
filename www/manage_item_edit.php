<?php
session_start();
require_once('database.php');

$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
    header ('location: index.php');
    exit;
}

if (!empty($_GET["item"]) && isset($_POST["submit"]) && $_POST["submit"] === "OK" && isset($_POST["name"]) && isset($_POST["img"]) && isset($_POST["price"]))
    edit_item($_GET["item"], $_POST["name"], $_POST["price"], $_POST["img"], $_POST["categories"]);
else {
    header ('location: manage_item_editpage.php?item=' . $_GET["item"]);
    exit;
}
header ('location: manage_items.php');
