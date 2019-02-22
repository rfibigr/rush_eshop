<?php
session_start();
require_once('database.php');

// If user is not connected
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']) || $_POST['submit'] !== "OK")
{
	header ('location: index.php');
	exit;
}

// If input are empty
if (!isset($_POST['passwd']))
{
	header ('location: account.php?error=delete_input');
	exit;
}

// if password is invalid
if ($_SESSION['passwd'] !== $_POST['passwd'])
{
	header ('location: account.php?error=delete_password');
	exit;
}

//Delete account
$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
delete_user($user['id']);
header ('location: sign_out.php');

?>
