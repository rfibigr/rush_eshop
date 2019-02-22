<?php
session_start();
require_once('database.php');
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


		<!-- ***INDEX*** -->
	<div class=image_index>
		<?php
		$category = get_categories();
		print_r($categery);
		foreach($category as $key => $value)
		{
			echo "<div>\n";
			echo "<p style='font-size: 18px;'> $value[name] </p>\n";
			echo "<hr style='height: 1px; color: grey; background-color: grey; width: 28%'> \n";
			echo "</div>\n";
			echo "<div class='category'>\n";
			echo "	<a href='category.php?category=$key'> <img class=image_frontpage src='$value[img]' alt='$value[name]' title='$value[name]'/></a>\n";
			echo "</div>\n";
		}
		?>
	</div>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
