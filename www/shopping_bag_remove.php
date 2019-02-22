<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['bag']))
{
	header ("location: shopping_bag.php");
	exit;
}
if (isset($_GET['id']) && $_GET['remove'] === "x")
{
	foreach($_SESSION['bag'] as $key => $article)
	{
		if ($article[0]['id'] == $_GET['id'])
		{
			unset($_SESSION['bag'][$key]);
			header ("location: shopping_bag.php");
			exit;
		}
	}
}
header ("location: index.php");
?>
