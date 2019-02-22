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
if (!isset($_POST['old_password']) || !isset($_POST['new_password']) || !isset($_POST['password_confirmation']))
{
	header ('location: account.php?error=input');
	exit;
}

// If old password invalide
if ($_SESSION['passwd'] != $_POST['old_password'])
{
	header ('location: account.php?error=old_password');
	exit;
}

// If new password invalide
if ($_POST['new_password'] != $_POST['password_confirmation'])
{
	header ('location: account.php?error=new_password');
	exit;
}

//Modify password
$user = isset($_SESSION['login']) ? get_user_details($_SESSION['login']) : NULL;
$new_password_hashed = hash('sha256', $_POST['new_password']);
update_user_password($user['id'], $new_password_hashed);
$_SESSION['passwd'] = $_POST['new_password'];
header ('location: account.php?success=new_password');

?>
