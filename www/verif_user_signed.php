<?php
session_start();
require_once('database.php');

if ($_POST['submit'] != "valider le panier")
{
	header ('location: index.php');
	exit;
}
if ($_POST['nb_item'] === '0')
{
	header ('location: shopping_bag.php?error=empty');
	exit;
}

if (isset($_SESSION['login']) && isset($_SESSION['passwd']))
{
	header ('location: order_recap.php');
	exit;
}
else
{
	header ('location: sign_up.php?login=needed');
}

?>
