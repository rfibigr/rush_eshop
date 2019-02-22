<?php
session_start();
require_once('database.php');
$item = get_items($_GET["category"]);
// ($item === NULL)
// {
// 	header('location: index.php');
// 	exit;
// }
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
	<div class=content_item>

			<?php
			foreach($item as $key => $article)
			{
				echo "<div class='item'>\n";
				echo "	<a href='article.php?article=$key'> <img class=item_picture src='$article[img]' alt='$article[name]' title='$article[name]' /></a>\n";
				echo "	<div class='item_name'> $article[name] </div>\n";
				echo "	<div class='item_price'> $article[price]€ </div>\n";
				echo "<hr style='height: 1px; color: grey; background-color: grey; width: 28%'> \n";
				echo "</div>\n";
			}
			?>

	</div>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
