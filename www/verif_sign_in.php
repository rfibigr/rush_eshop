<?php
session_start();

require_once('database.php');

// check if user is already login
if (isset($_SESSION['login']) && isset($_SESSION['passwd']))
{
	header ('location: index.php');
	exit;
}

// check if input are correct
if ($_POST['submit'] !== "OK" && !isset($_POST['login']) && !isset($_POST['passwd']))
{
	header ('location: sign_in.php');
	exit;
}

$passwd_hashed = hash("sha256", $_POST['passwd']);
// check if login and passwd are correct
if (check_user_credentials($_POST['login'], $passwd_hashed))
{
	// put firstname
	$_SESSION['login'] = $_POST['login'];
	$_SESSION['passwd'] = $_POST['passwd'];
	header ('location: index.php');
}
else
{
	header ('location: sign_in.php');
}

?>
