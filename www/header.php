<?php
require_once('database.php');
$nb_item = 0;
if (isset($_SESSION['bag']))
	$nb_item=count_nb_item($_SESSION['bag']);
$category = get_categories();

function count_nb_item($shopping_bag)
{
	$nb_item = 0;
	foreach($shopping_bag as $element)
		$nb_item++;
	return($nb_item);
}
?>
<header>
	<div class="logo">
		<a href=index.php> <img src="./img/logo.png" alt="logo" title="logo" width="100px"> </a>
	</div>
		<div class="shopping_bag">
			<a href="shopping_bag.php"> Shopping bag(<?php echo"$nb_item"; ?>)</a>
		</div>
		<?php
		if (isset($_SESSION['login']) && isset($_SESSION['passwd']))
		{
			echo "<div class='sign'>\n";
			echo "<a href='account.php'>\"$_SESSION[login]\"</a>\n";
			echo "/";
			echo "<a href='sign_out.php'>sign out</a>\n";
			echo "</div>";
		}
		else
		{
			echo "<div class='sign'>\n";
			echo "<a href='sign_in.php'>sign in</a>\n";
			echo "/";
			echo "<a href='sign_up.php'>sign up</a>\n";
			echo "</div>";
		}
		?>
		<div>
			<p style="font-size: 18px;"> The Best Place on Internet to Buy the Space </p>
			<hr style="height: 1px; color: grey; background-color: grey; width: 37%;">
		</div>

		<nav id="category">
			<ul>
			<?php
			foreach($category as $key => $value)
			{
				echo "<li><a href='category.php?category=" . $key . "'>" .$value['name'] . "</a></li>\n";
			}
			?>

		</nav>
		<hr style="height: 1px; color: grey; background-color: grey; width: 80%;">
</header>
