<?php
session_start();
require_once('database.php');
$article = get_item_details($_GET["article"]);
if ($article === NULL)
{
	header('location: index.php');
	exit;
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


		<!-- ***nav*** -->
	<section class=content_article>
		<?php
			echo "	<a href=#> <img class='picture' src='$article[img]' alt='$article[name]' title='$article[name]' /></a>\n";
			echo "	<div class='article_right'>\n";
			echo "	<div class='article_name'> $article[name] </div>\n";
			echo "	<div class='article_price'> $article[price]€ </div>\n";
			echo "<hr style='height: 1px; color: grey; background-color: grey; width: 28%'> \n";
		 ?>
		<form class=article_form method="get" action="shopping_bag_add.php">
		<pa> Quantity </pa>
		<input type="number" width="20" name="quantity" value="1" min="1" />
			<input type="submit" name="submit" value="Add" />
			<input type="hidden" name="id" value="<?php echo "$article[id]"; ?>" />
		</form>
		</div>
	</section>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
