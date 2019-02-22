<?php
session_start();
require_once('database.php');


// check if input are correct
if (!check_user_exists($_POST['login']) && valid_parameter($_POST['submit'], $_POST['login'], $_POST['passwd'], $_POST['passwd_confirmation']
	,$_POST['first_name'], $_POST['last_name'], $_POST['adress'], $_POST['phone_number']))
{
	$passwd_hashed = hash("sha256", $_POST['passwd']);
	add_user($_POST['login'], $passwd_hashed, $_POST['first_name'], $_POST['last_name']
			,"user", $_POST['adress'], $_POST['phone_number']);

	header ('location: sign_in.php');
}
else
{
	header ('location: sign_up.php?error=Error');
}

function valid_parameter($submit, $login, $passwd, $passwd_confirmation, $first_name, $last_name, $adress, $phone_number)
{
if (empty($submit) || $submit !== "OK")
	return (false);
if (empty($login) || strlen($login) > 255 || (htmlspecialchars($login) != $login))
	return (false);
if (empty($passwd) || strlen($passwd) > 12 || (htmlspecialchars($passwd) != $passwd))
	return (false);
if (empty($passwd_confirmation))
	return (false);
if (empty($first_name) || strlen($first_name) > 20 || (htmlspecialchars($first_name) != $first_name))
	return (false);
if (empty($last_name) || strlen($last_name) > 20 || (htmlspecialchars($last_name) != $last_name))
	return (false);
if (empty($adress) || strlen($adress) > 255 || (htmlspecialchars($adress) != $adress))
	return (false);
if (empty($phone_number) || strlen($phone_number) > 20 || (htmlspecialchars($phone_number) != $phone_number))
	return (false);
if ($passwd != $passwd_confirmation)
	return (false);
return (true);
}

?>
