<?php
session_start();
if (isset($_SESSION['login']) && isset($_SESSION['passwd']))
{
	header ('location: index.php');
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

	<div class='sign_in'>

	<p style="font-size: 20px; text-decoration: underline;"> Sign in </p>
		<form method="post" action="verif_sign_in.php">
			Email: <input type="text" name="login" />
			<br />
			<br />
			Password: <input type="password" name="passwd" />
			<input type="submit" name="submit" value="OK" />
		</form>

	</div>

		<!-- ***FOOTER*** -->
	<?php include ("footer.php"); ?>

</body>
</html>
