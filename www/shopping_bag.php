<?php
session_start();
require_once('database.php');

$total_price = 0;
if (isset($_SESSION['bag']))
	$total_price = calcul_total_price();

function calcul_total_price()
{
	$total_price = 0;
	foreach($_SESSION['bag'] as $key => $article)
	{
		$total_price += $article[0]['price'] * $article[1];
	}
	return ($total_price);
}
?>

<!doctype html>
<html>
<head>
	<title>Rush00</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="rush00.css">
	<link rel="icon" type="image/png" sizes="96x96" href="./img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="32x32" href="./img/favicon-32x32.png">
	<style type="text/css">

	</style>
</head>
<body>
		<!-- ***HEADER*** -->
	<?php include ("header.php"); ?>


	<h1 align='center'> SHOPPING BAG </h1>
<div class='bag'>
	<div class='bag_left'>
		<table class='bag_table' cellspacing='15'>
		<?php
		if (isset($_SESSION['bag']))
		{
			foreach($_SESSION['bag'] as $key => $article)
			{
				echo "	<tr>\n";
				echo "	<th class='th_bag'>\n";

				echo "	<div class=div_bag_picture> <a href=article.php?article=" . $article[0]['id'] . "> <img class='bag_picture' src='" . $article[0]['img'] . "' alt='" . $article[0]['name'] . "' title='" . $article[0]['name'] . "' /></a> </div>\n";
				echo "	<form class=form_remove method='get' action='shopping_bag_remove.php'> \n";
				echo "		<input type='submit' name='remove' value='x' /> \n";
				echo "		<input type='hidden' name='id' value=" . $article[0]['id'] . " /> \n";
				echo "	</form> \n";
				echo "	<div class='bag_name'>" . $article[0]['name'] . "</div>\n";
				echo "	<div class='bag_price'> " . $article[0]['price'] ."€ </div>\n";
				echo "	<form method='get' action='shopping_bag_modify_quantity.php'> \n";
				echo "		<input type='number' min='0' name='quantity' value='$article[1]' /> \n";
				echo "		<input type='hidden' name='id' value=" . $article[0]['id'] . " /> \n";
				echo "		<input type='submit' name='submit' value='modify' /> \n";
				echo "	</form> \n";
				if ($article[1] > 1)
					echo "	<div class='bag_price_total'> Item total price:" . $article[0]['price'] * $article[1] ."€ </div>\n";
				echo "	</th>\n";
				echo "	</tr>\n";
			}
		}
		?>
		</table>
	</div>
	<div class='bag_right'>
		<?php
		if (isset($_GET['error']) && $_GET['error'] === "empty")
			echo "Error : your shopping bag is empty\n";
		?>
		<p> total panier <br />	<?php echo "$total_price"; ?> €</p>

		<form method='post' action='verif_user_signed.php'>
			<input type='submit' name='submit' value='valider le panier' />
			<input type='hidden' name='nb_item' value='<?php echo $nb_item; ?>' />
		</form>
	</div>
</div>
		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
