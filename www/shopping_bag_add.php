<?php
session_start();
require_once('database.php');

if (!isset($_SESSION['bag']))
	$_SESSION['bag'] = array();
if (isset($_GET['id']) && isset($_GET['quantity']) && $_GET['submit'] === "Add")
{

	foreach($_SESSION['bag'] as $key => $article)
	{
		if ($article[0]['id'] == $_GET['id'])
		{
			$_SESSION['bag'][$key][1] += $_GET['quantity'];
			header ("location: article.php?article=$_GET[id]");
			exit;
		}
	}
	$_SESSION["bag"][] = [get_item_details($_GET["id"]), $_GET["quantity"]];
	header ("location: article.php?article=$_GET[id]");
}
header ("location: index.php");

?>
