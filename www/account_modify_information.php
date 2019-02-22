<?php
session_start();
require_once('database.php');
$user = get_user_details($_SESSION['login']);

// If user is not connected
if (!isset($_SESSION['login']) || !isset($_SESSION['passwd']))
{
	header ('location: index.php');
	exit;
}
if (!(valid_parameter($_POST['submit'], $user['name'] ,$_POST['first_name'], $_POST['last_name'], $_POST['address'], $_POST['phone_number'])))
{
	header ('location: account.php?error=input');
	exit;
}

print_r($user);
update_user_data($user['id'], $user['name'], $_POST['first_name'], $_POST['last_name'], $user['role'], $_POST['address'], $_POST['phone_number']);
header ('location: account.php?success=new_password');

function valid_parameter($submit, $login, $first_name, $last_name, $address, $phone_number)
{
if (empty($submit) || $submit !== "OK")
	return (false);
if (empty($login) || strlen($login) > 255 || (htmlspecialchars($login) != $login))
	return (false);
if (empty($first_name) || strlen($first_name) > 20 || (htmlspecialchars($first_name) != $first_name))
	return (false);
if (empty($last_name) || strlen($last_name) > 20 || (htmlspecialchars($last_name) != $last_name))
	return (false);
if (empty($address) || strlen($address) > 255 || (htmlspecialchars($address) != $address))
	return (false);
if (empty($phone_number) || strlen($phone_number) > 20 || (htmlspecialchars($phone_number) != $phone_number))
	return (false);
return (true);
}
?>
