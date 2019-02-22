<?php
session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['passwd']))
{
	header ('location: index.php');
	exit;
}
require_once('database.php');

$total_price = calcul_total_price();

function calcul_total_price()
{
	$total_price = 0;
	foreach($_SESSION['bag'] as $key => $article)
	{
		$total_price += $article[0]['price'];
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


	<h1 align='center'> ORDER RECAP </h1>


	<div class='recap'>
		<div>
			<p class=recap_price> Total:	<?php echo "$total_price"; ?> </p>

			<form method="post" action="order_archive.php">
				<input type="submit" name="submit" value="Valider le panier" />
			</form>
	<hr style="height: 1px; color: grey; background-color: grey; width: 80%;">

		</div>
		<table class='bag_table' cellspacing='15'>
		<?php
		if (isset($_SESSION['bag']))
		{
			foreach($_SESSION['bag'] as $key => $article)
			{
				echo "	<tr>\n";
				echo "	<th class='th_bag'>\n";

				echo "	<div class=div_bag_picture> <a href=article.php?article=" . $article[0]['id'] . "> <img class='bag_picture' src='" . $article[0]['img'] . "' alt='" . $article[0]['name'] . "' title='" . $article[0]['name'] . "' /></a> </div>\n";
				echo "	<div class='bag_name'>" . $article[0]['name'] . "</div>\n";
				echo "	<div class='bag_price'> " . $article[0]['price'] ."€ </div>\n";
				echo "	<div class='bag_price'> <p> Quantity : " . $article[1]['price'] ."</p> </div>\n";
					echo "	<div class='bag_price_total'> Items total price:" . $article[0]['price'] * $article[1] ."€ </div>\n";
				echo "	</th>\n";
				echo "	</tr>\n";
			}
		}
		?>
		</table>
	</div>
	<?php include ("footer.php"); ?>
</body>
</html>
