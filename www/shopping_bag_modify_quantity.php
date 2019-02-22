<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['bag']))
{
	header ("location: shopping_bag.php");
	exit;
}
//QUANTITY IS NUMBER ???
if (isset($_GET['id']) && isset($_GET['quantity']) && $_GET['submit'] === "modify")
{
	foreach($_SESSION['bag'] as $key => $article)
	{
		if ($article[0]['id'] == $_GET['id'])
		{
			if ($_GET['quantity'] == 0)
			{
				unset($_SESSION['bag'][$key]);
				header ("location: shopping_bag.php");
				exit;
			}
			else
			{
				$_SESSION['bag'][$key][1] = $_GET['quantity'];
				header ("location: shopping_bag.php");
				exit;
			}
		}
	}
}
header ("location: index.php");
?>
