<?php
session_start();
require_once('database.php');
$user=get_user_details($_SESSION['login']);

add_order($user['id'], $_SESSION['bag']);
unset($_SESSION['bag']);
header ('location: index.php');
?>
