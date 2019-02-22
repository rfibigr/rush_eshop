<?php
session_start();
require_once('database.php');

$category_list = get_categories();
$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $user['role'] !== "admin")
{
    header ('location: index.php');
    exit;
}

if (!empty($_GET["category"]) && !empty($category_list[$_GET["category"]]) && isset($_POST["submit"]) && $_POST["submit"] === "OK" && isset($_POST["name"]) && isset($_POST["img"]))
    edit_category($_GET["category"], $_POST["name"], $_POST["img"]);
else {
    header ('location: manage_category_editpage.php?category=' . $_GET["category"]);
    exit;
}
header ('location: manage_categories.php');
