<?php
session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['passwd']))
{
	header ('location: index.php');
	exit;
}
require_once('database.php');
$user=get_user_details($_SESSION['login']);

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
		<!-- ***HEADER*** -->


<body>
		<!-- ***HEADER*** -->
	<?php include ("header.php"); ?>


	<h1 align='center'> ORDER LIST </h1>

<?php
$order_history = get_user_orders($user['id']);
?>

	<div class='recap'>

		<?php
		if (isset($order_history))
		{
			foreach($order_history as $key => $order)
			{
				$total_price = 0;
				foreach($order['items'] as $key => $article)
				{
					$total_price += ($article['item']['price'] * $article['quantity']);
				}

			echo "<hr style='height: 1px; color: grey; background-color: grey; width: 80%;'>\n";
			echo "<p class=recap_price> Order number : " . $key . " made the " .  $order['date'] . " </p> \n";
			echo "<p class=recap_price> Total:" . $total_price . " </p> \n";

				foreach($order['items'] as $key => $article)
			{
				echo "	<table class='bag_table' cellspacing='15'> \n";
				echo "	<tr>\n";
				echo "	<th class='th_bag'>\n";

				echo "	<div class=div_bag_picture> <a href=article.php?article=" . $article['item']['id'] . "> <img class='bag_picture' src='" . $article['item']['img'] . "' alt='" . $article['item']['name'] . "' title='" . $article['item']['name'] . "' /></a> </div>\n";
				echo "	<div class='bag_name'>" . $article['item']['name'] . "</div>\n";
				echo "	<div class='bag_price'> " . $article['item']['price'] ."€ </div>\n";
				echo "	<div class='bag_price'> <p> Quantity : " . $article['quantity'] ."</p> </div>\n";
					echo "	<div class='bag_price_total'> Items total price:" . $article['item']['price'] * $article['quantity'] ."€ </div>\n";
				echo "	</th>\n";
				echo "	</tr>\n";
				echo "	</table>\n";
			}
			}
		}
		else
			echo "	<div class='bag_price'> <p> No order yet.</p> </div>\n";

		?>
	</div>
	<?php include ("footer.php"); ?>
</body>
</html>
